<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 18/04/2017
 * Time: 11:47
 */

namespace App\Http\Controllers\Backend\Application;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\TecnicoRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;
use Maatwebsite\Excel\Facades\Excel;
use Zizaco\Entrust\EntrustFacade as Entrust;
use App\Enum\FilesTipos;

class TecnicoController extends Controller
{

    /**
     * @var TecnicoRepository
     */
    protected $tecnico;

    /**
     * @var CasaRepository
     */
    protected $casa;

    private $file;


    /**
     * TecnicoController constructor.
     * @param TecnicoRepository $pagina
     */
    public function __construct(
        TecnicoRepository $tecnicoRepository,
        CasaRepository $casaRepository
    )
    {
        $this->middleware('auth');
        $this->tecnico = $tecnicoRepository;
        $this->casa = $casaRepository;
    }

    /**
     * Pagina inicial do módulo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (!Entrust::can('manage-rh')){
            return redirect()->route('admin.restrito');
        }

        return view('backend.modules.tecnicos.index')
            ->withTecnicos($this->tecnico->paginate(5))
            ->withCasas($this->casa->all());
    }

    /**
     * Armazena registro no DB
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try{
            if ($this->tecnico->create($request->all())){
                Log::write('event', 'Tecnico ' . $request->nome . ' foi cadastrado por ' . auth()->user()->name);
            }
            notify('Registro Cadastrado com sucesso!', 'success');
            return redirect()->route('admin.tecnicos.index');
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.tecnicos.index');
        }
    }

    /**
     * Localiza registro para edição
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        try{

            if (!Entrust::can('manage-rh')){
                return redirect()->route('admin.restrito');
            }

            return view('backend.modules.tecnicos.edit')
                ->withTecnico($this->tecnico->findById($id))
                ->withCasas($this->casa->all());
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.tecnicos.index');
        }
    }

    /**
     * Atualiza registro no DB
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            if ($this->tecnico->update($request->all(), $id)) {
                Log::write('event', 'Tecnico ' . $request->nome . ' foi alterado por ' . auth()->user()->name);
            }
            notify('Registro alterado com sucesso!', 'success');
            return redirect()->route('admin.tecnicos.index');
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.tecnicos.index');
        }
    }

    /**
     * Remove registro do DB
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        try{

            if (!Entrust::can('manage-rh')){
                return redirect()->route('admin.restrito');
            }

            $tecnico = $this->tecnico->find($id)->nome;
            if($this->tecnico->delete($id)){
                Log::write('event', 'Tecnico ' . $tecnico . ' foi removido por ' . auth()->user()->name);
            }
            notify('Registro removido com sucesso!', 'success');
            return redirect(url()->previous());
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.tecnicos.index');
        }
    }

    /**
     * Localiza registro no banco de dados
     *
     * @param $casa
     * @return mixed
     */
    public function viewNota($casa)
    {
        if (!Entrust::can('manage-rh')){
            return redirect()->route('admin.restrito');
        }

        return view('backend.modules.tecnicos.notas')
            ->with('nota', $this->tecnico->getNote($casa));
    }

    /**
     * Grava Nota no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeNota(Request $request)
    {
        try{
            if($this->tecnico->createNote($request->all())){
                Log::write('event', 'Uma Nota  foi atualizada por ' . auth()->user()->name);
            }
            notify('Registro gravado com sucesso!', 'success');
            return redirect()->route('admin.tecnicos.index');
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.tecnicos.index');
        }
    }

    /**
     *  Localiza registros e renderiza
     *
     * @param $casa
     * @return mixed
     */
    public function viewFile($casa)
    {
        if (!Entrust::can('manage-rh')){
            return redirect()->route('admin.restrito');
        }

        return view('backend.modules.tecnicos.files')
            ->with('files',$this->tecnico->getFiles($casa))
            ->with('types',FilesTipos::getConstants());
    }

    /**
     * Armezena os arquivos no DB
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeFile(Request $request)
    {
        try {

            if ($this->file = $request->file('files')->store('ldo','files')){
                //adicionar o nome do arquivo no array de dados
                $data = array_add($request->all(),'file',$this->file);
                //Criar registro no DB
                if ($this->tecnico->createFile($data)) {
                    Log::write('event', 'Arquivo Tipo ' . $this->getTipos()[$request->type] . ' foi cadastrado por ' . auth()->user()->name);
                }
            }
            notify()->flash('Registro cadastrado com sucesso!', 'success');
            return redirect()->route('admin.tecnicos.index');

        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.tecnicos.index');
        }
    }

    /**
     * Exibe a view de importação de dados
     *
     * @return mixed
     */
    public function viewImport()
    {
        if (!Entrust::can('manage-rh')){
            return redirect()->route('admin.restrito');
        }

        return view('backend.modules.tecnicos.import');
    }

    /**
     * Importa Dados para o banco de dados a partir de arquivo do excel
     *
     * @param Request $request
     * @return mixed
     */
    public function storeImport(Request $request)
    {
        try {
            if ($request->hasFile('arquivo')){
                $this->tecnico->cleanDatabase();
                Excel::load($request->file('arquivo'), function($reader){
                    $reader->each(function($sheet){
                        $this->tecnico->importRecords($sheet->toArray());
                    });
                });
                Log::write('event', 'Lista de Tecnicos foram importados por ' . auth()->user()->name);
            }
            notify('Arquivos importados com sucesso!', 'success');
            return redirect()->route('admin.tecnicos.index');

        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.tecnicos.index');
        }
    }

    private function getTipos()
    {
        return FilesTipos::getConstants();
    }
    
}
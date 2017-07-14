<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 18/04/2017
 * Time: 11:47
 */

namespace App\Http\Controllers\Backend\Application;

use App\Enum\FilesTipos;
use App\Exceptions\Access\GeneralException;
use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\DirigenteRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;
use Maatwebsite\Excel\Facades\Excel;
use Zizaco\Entrust\EntrustFacade as Entrust;

class DirigenteController extends Controller
{

    /**
     * @var DirigenteRepository
     */
    protected $dirigente;

    /**
     * @var CasaRepository
     */
    protected $casa;

    /**
     * @var $file
     */
    private $file;


    /**
     * PaginaController constructor.
     * @param DirigenteRepository $pagina
     */
    public function __construct(
        DirigenteRepository $dirigenteRepository,
        CasaRepository $casaRepository
    )
    {
        $this->middleware('auth');
        $this->dirigente = $dirigenteRepository;
        $this->casa = $casaRepository;
    }

    /**
     * Página inicial do módulo
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (!Entrust::can('manage-rh')){
            return redirect()->route('admin.restrito');
        }

        return view('backend.modules.dirigentes.index')
            ->withDirigentes($this->dirigente->paginate(5))
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
        try {
            if ($this->dirigente->create($request->all())) {
                Log::write('event', 'Dirigente ' . $request->nome . ' foi cadastrado por ' . auth()->user()->name);
            }
            notify('Registro Cadastrado com sucesso!', 'success');
            return redirect()->route('admin.dirigentes.index');
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.dirigentes.index');
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
        if (!Entrust::can('manage-rh')){
            return redirect()->route('admin.restrito');
        }

        try {
            return view('backend.modules.dirigentes.edit')
                ->withDirigente($this->dirigente->findById($id))
                ->withCasas($this->casa->all());
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.dirigentes.index');
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
            if ($this->dirigente->update($request->all(), $id)) {
                Log::write('event', 'Dirigente ' . $request->nome . ' foi alterado por ' . auth()->user()->name);
            }
            notify('Registro alterado com sucesso!', 'success');
            return redirect()->route('admin.dirigentes.index');
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.dirigentes.index');
        }
    }

    /**
     * Deleta registro do DB
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        if (!Entrust::can('manage-rh')){
            return redirect()->route('admin.restrito');
        }

        try{
            $dirigente = $this->dirigente->find($id)->nome;
            if ($this->dirigente->delete($id)) {
                Log::write('event', 'Dirigente ' . $dirigente . ' foi removido por ' . auth()->user()->name);
            }
            notify('Registro removido com sucesso!', 'success');
            return redirect(url()->previous());
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.dirigentes.index');
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
        return view('backend.modules.dirigentes.notas')
            ->with('nota', $this->dirigente->getNote($casa));
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
            if($this->dirigente->createNote($request->all())){
                Log::write('event', 'Uma Nota  foi atualizada por ' . auth()->user()->name);
            }
            notify('Registro gravado com sucesso!', 'success');
            return redirect()->route('admin.dirigentes.index');
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.dirigentes.index');
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
        return view('backend.modules.dirigentes.files')
            ->with('files',$this->dirigente->getFiles($casa))
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
                if ($this->dirigente->createFile($data)) {
                    Log::write('event', 'Arquivo Tipo ' . $this->getTipos()[$request->type] . ' foi cadastrado por ' . auth()->user()->name);
                }
            }
            notify()->flash('Registro cadastrado com sucesso!', 'success');
            return redirect()->route('admin.dirigentes.index');

        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.dirigentes.index');
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

        return view('backend.modules.dirigentes.import');
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
            if ($request->hasFile('arquivo')) {
                $this->dirigente->cleanDatabase();
                Excel::load($request->file('arquivo'), function ($reader) {
                    $reader->each(function ($sheet) {
                        $this->dirigente->importRecords($sheet->toArray());
                    });
                });
                Log::write('event', 'Lista de Dirigentes foram importados por ' . auth()->user()->name);
            }
            notify('Arquivos importados com sucesso!', 'success');
            return redirect()->route('admin.dirigentes.index');

        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.dirigentes.index');
        }
    }

    private function getTipos()
    {
        return FilesTipos::getConstants();
    }

}
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
use App\Repositories\Backend\Application\Contracts\RemuneratoriaRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;
use Maatwebsite\Excel\Facades\Excel;

class RemuneratoriaController extends Controller
{

    /**
     * @var RemuneratoriaRepository
     */
    protected $remuneratoria;

    /**
     * @var CasaRepository
     */
    protected $casa;


    /**
     * RemuneratoriaController constructor.
     * @param RemuneratoriaRepository $remuneratoria
     */
    public function __construct(
        RemuneratoriaRepository $remuneratoriaRepository,
        CasaRepository $casaRepository
    )
    {
        $this->middleware('auth');
        $this->remuneratoria = $remuneratoriaRepository;
        $this->casa = $casaRepository;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return view('backend.modules.remunera.index')
            ->withRemuneracoes($this->remuneratoria->with('casa')->paginate(5))
            ->withCasas($this->casa->all());
    }

    /**
     * Armazena informações no banco
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
            if ($this->remuneratoria->create($request->all())) {
                Log::write('event', 'Estrutura Remuneratoria ' . $request->cargo . ' foi cadastrado por ' . auth()->user()->name);
                notify('Registro Cadastrado com sucesso!', 'success');
                return redirect()->route('admin.remunera.index');
            }
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.remunera.index');
        }
    }


    /**
     * Localiza registro para edição
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        try {
            return view('backend.modules.remunera.edit')
                ->withRemunera($this->remuneratoria->findById($id))
                ->withCasas($this->casa->all());
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.remunera.index');
        }
    }

    /**
     * Atualiza registro no banco de dados
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        try {
            if ($this->remuneratoria->update($request->all(), $id)) {
                Log::write('event', 'Estrutura Remuneratoria ' . $request->cargo . ' foi alterado por ' . auth()->user()->name);
                notify('Registro alterado com sucesso!', 'success');
                return redirect()->route('admin.remunera.index');
            }
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.remunera.index');
        }
    }

    public function delete($id)
    {
        try{
            $cargo = $this->remuneratoria->find($id)->cargo;
            if($this->remuneratoria->delete($id)){
                Log::write('event', 'Estrutura Remuneratoria ' . $cargo . ' foi removida por ' . auth()->user()->name);
                notify('Registro removido com sucesso!', 'success');
                return redirect()->route('admin.remunera.index');
            }
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.remunera.index');
        }
    }


    /**
     * Exibe a view de importação de dados
     *
     * @return mixed
     */
    public function viewImport()
    {
        return view('backend.modules.remunera.import');
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
                $this->remuneratoria->cleanDatabase();
                Excel::load($request->file('arquivo'), function($reader){
                    $reader->each(function($sheet){
                        $this->remuneratoria->importRecords($sheet->toArray());
                    });
                });
                Log::write('event', 'Lista de Remunerações foram importadas por ' . auth()->user()->name);
                notify('Arquivos importados com sucesso!', 'success');
                return redirect()->route('admin.remunera.index');
            }

        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.remunera.index');
        }
    }

}
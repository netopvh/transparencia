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
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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


    /**
     * PaginaController constructor.
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
     * @return mixed
     */
    public function index()
    {
        return view('backend.modules.tecnicos.index')
            ->withTecnicos($this->tecnico->paginate(5))
            ->withCasas($this->casa->all());
    }

    public function store(Request $request)
    {
        try{
            if ($this->tecnico->create($request->all())){
                notify('Registro Cadastrado com sucesso!', 'success');
                return redirect()->route('admin.tecnicos.index');
            }
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.tecnicos.index');
        }
    }

    public function edit($id)
    {
        try{
            return view('backend.modules.tecnicos.edit')
                ->withTecnico($this->tecnico->findById($id))
                ->withCasas($this->casa->all());
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.tecnicos.index');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if ($this->tecnico->update($request->all(), $id)) {
                notify('Registro alterado com sucesso!', 'success');
                return redirect()->route('admin.tecnicos.index');
            }
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.tecnicos.index');
        }
    }

    public function delete($id)
    {
        if($this->tecnico->delete($id)){
            notify('Registro removido com sucesso!', 'success');
            return redirect(url()->previous());
        }
    }

    /**
     * Exibe a view de importação de dados
     *
     * @return mixed
     */
    public function viewImport()
    {
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
                notify('Arquivos importados com sucesso!', 'success');
                return redirect()->route('admin.tecnicos.index');
            }

        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.tecnicos.index');
        }
    }
    
}
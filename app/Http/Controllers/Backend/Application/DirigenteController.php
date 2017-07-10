<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 18/04/2017
 * Time: 11:47
 */

namespace App\Http\Controllers\Backend\Application;

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
     * @return mixed
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

    public function store(Request $request)
    {
        try {
            if ($this->dirigente->create($request->all())) {
                Log::write('event', 'Dirigente ' . $request->nome . ' foi cadastrado por ' . auth()->user()->name);
                notify('Registro Cadastrado com sucesso!', 'success');
                return redirect()->route('admin.dirigentes.index');
            }
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.dirigentes.index');
        }
    }

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

    public function update(Request $request, $id)
    {
        try {
            if ($this->dirigente->update($request->all(), $id)) {
                Log::write('event', 'Dirigente ' . $request->nome . ' foi alterado por ' . auth()->user()->name);
                notify('Registro alterado com sucesso!', 'success');
                return redirect()->route('admin.dirigentes.index');
            }
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.dirigentes.index');
        }
    }

    public function delete($id)
    {
        if (!Entrust::can('manage-rh')){
            return redirect()->route('admin.restrito');
        }

        try{
            $dirigente = $this->dirigente->find($id)->nome;
            if ($this->dirigente->delete($id)) {
                Log::write('event', 'Dirigente ' . $dirigente . ' foi removido por ' . auth()->user()->name);
                notify('Registro removido com sucesso!', 'success');
                return redirect(url()->previous());
            }
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.dirigentes.index');
        }
    }

    public function filesImporter(Request $request)
    {
        $return = $this->importFilesType($request->file('ods'), $request->file('pdf'), $request->file('xlsx'));

        dd($return);
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
                notify('Arquivos importados com sucesso!', 'success');
                return redirect()->route('admin.dirigentes.index');
            }

        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.dirigentes.index');
        }
    }

    private function importFilesType($ods, $pdf, $xlsx)
    {
        $files = [];
        $files['ods'] = uniqid() . '.' . $ods->getClientOriginalExtension();
        $files['pdf'] = uniqid() . '.' . $pdf->getClientOriginalExtension();
        $files['xslx'] = uniqid() . '.' . $xlsx->getClientOriginalExtension();
        UploadHelper::UploadFile($ods, "files/diversos", uniqid() . "_" . $ods->getClientOriginalName());
        UploadHelper::UploadFile($ods, "files/diversos", uniqid() . "_" . $pdf->getClientOriginalName());
        UploadHelper::UploadFile($ods, "files/diversos", uniqid() . "_" . $xlsx->getClientOriginalName());

        return $files;
    }

}
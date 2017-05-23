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
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

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
        return view('backend.modules.dirigentes.index')
            ->withDirigentes($this->dirigente->paginate(5))
            ->withCasas($this->casa->all());
    }

    public function store(Request $request)
    {
        try {
            if ($this->dirigente->create($request->all())) {
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
        if ($this->dirigente->delete($id)) {
            notify('Registro removido com sucesso!', 'success');
            return redirect(url()->previous());
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
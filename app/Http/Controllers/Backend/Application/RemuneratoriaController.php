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
use App\Importer\RemuneratoriaImport;
use App\Contracts\Facades\ChannelLog as Log;
use Maatwebsite\Excel\Facades\Excel;
use DB;

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
     * PaginaController constructor.
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
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
            if ($this->remuneratoria->create($request->all())) {
                notify('Registro Cadastrado com sucesso!', 'success');
                return redirect()->route('admin.remunera.index');
            }
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.remunera.index');
        }
    }

    /**
     * @return mixed
     */
    public function viewImport()
    {
        return view('backend.modules.remunera.import')
            ->withcasas($this->casa->all());
    }

    public function storeImport(Request $request)
    {
        try {
            $insert = [];
            if ($request->hasFile('arquivo')) {
                $path = $request->file('arquivo')->getRealPath();

                $data = Excel::load($path, function ($reader) {
                })->get();

                if (!empty($data) && $data->count()) {
                    foreach ($data->toArray() as $key => $value) {
                        if (!empty($value)) {
                            foreach ($value as $v) {
                                $insert[] = [
                                    'casa_id' => $v['casa_id'],
                                    'cargo' => $v['cargo'],
                                    'ponto_ini' => $v['ponto_ini'],
                                    'ponto_fin' => $v['ponto_fin'],
                                    'empregados' => $v['empregados']
                                ];
                            }
                        }
                    }
                    dd($insert);

                    if (!empty($insert)) {
                        DB::table('estrutura_remuneratoria')->insert($insert);
                        return back()->with('success', 'Insert Record successfully.');
                    }

                }

            }

        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.remunera.index');
        }
    }

    /**
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
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        try {
            if ($this->remuneratoria->update($request->all(), $id)) {
                notify('Registro alterado com sucesso!', 'success');
                return redirect()->route('admin.remunera.index');
            }
        } catch (GeneralException $e) {
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.remunera.index');
        }
    }

}
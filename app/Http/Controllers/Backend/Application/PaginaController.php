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
use App\Repositories\Backend\Application\Contracts\PaginaRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;

class PaginaController extends Controller
{

    /**
     * @var PaginaRepository
     */
    protected $pagina;

    /**
     * @var CasaRepository
     */
    protected $casa;


    /**
     * PaginaController constructor.
     * @param PaginaRepository $pagina
     */
    public function __construct(
        PaginaRepository $pagina,
        CasaRepository $casa
    )
    {
        $this->middleware('auth');
        $this->pagina = $pagina;
        $this->casa = $casa;
    }

    /**
     * @return mixed
     */
    public function indexDinamica()
    {
        return view('backend.modules.paginas.dinamica.index')
            ->withPgSesi($this->pagina->getPageByCasa('SESI'))
            ->withPgSenai($this->pagina->getPageByCasa('SENAI'));
    }

    /**
     * Ação para página estática
     *
     * @return mixed
     */
    public function indexEstatica()
    {
        return view('backend.modules.paginas.estatica.index');
    }

    /**
     * @return mixed
     */
    public function createDinamica()
    {
        return view('backend.modules.paginas.dinamica.create')
            ->withCasas($this->casa->all());
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeDinamica(Request $request)
    {
        try{
            if ($this->pagina->create($request->all())){
                notify('Registro Cadastrado com sucesso!', 'success');
                return redirect()->route('admin.paginas.dinamica');
            }
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.paginas.dinamica');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function editDinamica($id)
    {
        try{
            return view('backend.modules.paginas.dinamica.edit')
                ->withPagina($this->pagina->findById($id))
                ->withCasas($this->casa->all());
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.paginas.dinamica.index');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function updateDinamica(Request $request, $id)
    {
        try{
            if($this->pagina->update($request->all(), $id)){
                notify('Registro Cadastrado com sucesso!', 'success');
                return redirect()->route('admin.paginas.dinamica.index');
            }
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.paginas.dinamica
            ');
        }
    }
    
}
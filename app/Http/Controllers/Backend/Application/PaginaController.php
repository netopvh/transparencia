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
    public function index()
    {
        return view('backend.modules.paginas.index')
            ->withPaginas($this->pagina->with('casa')->paginate(5));
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.modules.paginas.create')
            ->withCasas($this->casa->all());
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try{
            if ($this->pagina->create($request->all())){
                notify('Registro Cadastrado com sucesso!', 'success');
                return redirect()->route('admin.paginas.index');
            }
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.paginas.index');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        try{
            return view('backend.modules.paginas.edit')
                ->withPagina($this->pagina->findById($id))
                ->withCasas($this->casa->all());
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.paginas.index');
        }
    }

    public function update(Request $request, $id)
    {
        try{
            if($this->pagina->update($request->all(), $id)){
                notify('Registro Cadastrado com sucesso!', 'success');
                return redirect()->route('admin.paginas.index');
            }
        }catch (GeneralException $e){
            notify('Erro:' . $e->getMessage(), 'danger');
            return redirect()->route('admin.paginas.index');
        }
    }
    
}
<?php
namespace App\Http\Controllers\Backend\Application;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;

class CasaController extends Controller
{

    /**
     * Variável instancia do repositório
     *
     * @var $casa
     */
    private $casa;

    /**
     * CasaController constructor.
     * @param CasaRepository $casa
     */
    public function __construct(CasaRepository $casa)
    {
        $this->middleware('auth');
        $this->casa = $casa;
    }

    /**
     * Método de exibição de dados principais
     *
     * @return mixed
     */
    public function index()
    {
        return view('backend.modules.casas.index')
            ->withCasas($this->casa->all());
    }

    /**
     * Método para inserir novo registro no banco de dados
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.modules.casas.create');
    }

    /**
     * Efetua a inserção de registro no DB
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try{
            if($this->casa->create($request->all())){
                Log::write('event','Casa '. $request->name .' foi cadastrada por '. auth()->user()->name);
            }
            return redirect()->route('admin.casas.index');

        }catch (GeneralException $e){
            notify()->flash($e->getMessage(),'danger');
            return redirect()->route('admin.casas.index');
        }
    }

    /**
     * Método de alteração de registro
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        try{
            $casa = $this->casa->findCasa($id);

            return view('backend.modules.casas.edit')
                ->withCasa($casa);
        }catch (GeneralException $e){
            notify()->flash($e->getMessage(),'danger');
            return redirect()->route('admin.casas.index');
        }
    }

    /**
     * Salva alterações no banco de dados
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        try{
            if($this->casa->update($request->all(), $id)){
                Log::write('event','Casa '. $request->name .' alterada por '. auth()->user()->name);
            }
            return redirect()->route('admin.casas.index');
        }catch (GeneralException $e){
            notify()->flash($e->getMessage(),'danger');
            return redirect()->route('admin.casas.index');
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        try{
            $casa = $this->casa->find($id)->name;
            if ($this->casa->delete($id)){
                Log::write('event','Casa '. $casa .' removida por '. auth()->user()->name);
            }
            return redirect()->route('admin.casas.index');
        }catch (GeneralException $e) {
            notify()->flash($e->getMessage(),'danger');
            return redirect()->route('admin.casas.index');
        }
    }

}
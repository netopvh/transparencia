<?php

namespace App\Http\Controllers\Backend\Application;

use App\Enum\Bloco;
use App\Enum\IntegridadeTipos;
use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\IntegridadeRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;
use Zizaco\Entrust\EntrustFacade as Entrust;

class IntegridadeController extends Controller
{

    /**
     * Variável instancia do repositório
     *
     * @var $integridade
     */
    protected $integridade;

    /**
     * Variável instancia do repositório
     *
     * @var $casa
     */
    protected $casa;

    /**
     * IntegridadeController constructor.
     * @param IntegridadeRepository $integridadeRepository
     */
    public function __construct(
        CasaRepository $casa,
        IntegridadeRepository $integridadeRepository
    )
    {
        $this->middleware('auth');
        $this->casa = $casa;
        $this->integridade = $integridadeRepository;
    }

    /**
     * Método de exibição de dados principais
     *
     * @return mixed
     */
    public function index()
    {
        if (!Entrust::can('manage-integri')){
            return redirect()->route('admin.restrito');
        }

        return view('backend.modules.integridade.index')
            ->withTipos(IntegridadeTipos::getConstants())
            ->withDados($this->integridade->getAll());
    }

    public function create()
    {
        if (!Entrust::can('manage-integri')){
            return redirect()->route('admin.restrito');
        }

        return view('backend.modules.integridade.create')
            ->with('casas',$this->casa->all())
            ->with('tipos',IntegridadeTipos::getConstants());
    }

    /**
     * Efetua a inserção de registro no DB
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        try {
            if ($file = $request->file('files')->store('integridade','files')){
                //adicionar o nome do arquivo no array de dados
                $data = array_add($request->all(),'file',$file);
                //Criar registro no DB
                if ($this->integridade->create($data)) {
                    Log::write('event', 'Integridade ' . $this->getTipos()[$request->type] . ' foi cadastrada por ' . auth()->user()->name);
                }
            }
            notify()->flash('Registro inserido com sucesso!','success');
            return redirect()->route('admin.integridade.index');

        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.integridade.index');
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
        if (!Entrust::can('manage-integri')){
            return redirect()->route('admin.restrito');
        }

        try {
            return view('backend.modules.integridade.edit')
                ->withIntegridade($this->integridade->find($id))
                ->withTipos(IntegridadeTipos::getConstants())
                ->withCasas($this->casa->all());
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.integridade.index');
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
        try {
            if ($request->file('files')){
                if ($file = $request->file('files')->store('integridade','integridade')){
                    //adicionar o nome do arquivo no array de dados
                    $data = array_add($request->all(),'file',$file);
                    //Criar registro no DB
                    if ($this->integridade->update($data, $id)) {
                        Log::write('event', 'Integridade ' . $this->getTipos()[$request->type] . ' foi alterado por ' . auth()->user()->name);
                    }
                }
            }else{
                if ($this->integridade->update($request->all(), $id)) {
                    Log::write('event', 'Integridade ' . $this->getTipos()[$request->type] . ' alterado por ' . auth()->user()->name);
                }
            }
            notify()->flash('Registro alteado com sucesso!','success');
            return redirect()->route('admin.integridade.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.integridade.index');
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        try {

            if (!Entrust::can('manage-integri')){
                return redirect()->route('admin.restrito');
            }

            $tipo = $this->integridade->find($id)->type;
            if ($this->integridade->delete($id)) {
                Log::write('event', 'Integridade ' . $this->getTipos()[$tipo] . ' removido por ' . auth()->user()->name);
            }
            notify()->flash('Registro removido com sucesso!','success');
            return redirect()->route('admin.integridade.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.integridade.index');
        }
    }

    public function publish($id)
    {
        try{
            $this->integridade->publish($id);

            notify()->flash('Registro publicado com sucesso!','success');
            return redirect(url()->previous());
        }catch (GeneralException $e){
            notify()->flash($e->getMessage(), 'danger');
            return redirect(url()->previous());
        }
    }

    public function unpublish($id)
    {
        try{
            $this->integridade->unpublish($id);

            notify()->flash('Registro despublicado com sucesso!','success');
            return redirect(url()->previous());
        }catch (GeneralException $e){
            notify()->flash($e->getMessage(), 'danger');
            return redirect(url()->previous());
        }
    }

    private function getTipos()
    {
        return $this->tipos = IntegridadeTipos::getConstants();
    }

}
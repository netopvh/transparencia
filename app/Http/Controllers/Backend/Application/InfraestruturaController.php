<?php

namespace App\Http\Controllers\Backend\Application;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\InfraestruturaRepository;
use App\Repositories\Backend\Application\Contracts\IntegridadeRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;
use Zizaco\Entrust\EntrustFacade as Entrust;

class InfraestruturaController extends Controller
{

    /**
     * Variável instancia do repositório
     *
     * @var $unidade
     */
    protected $infra;

    /**
     * Variável instancia do repositório
     *
     * @var $casa
     */
    protected $casa;

    /**
     * MenuController constructor.
     * @param IntegridadeRepository $menu
     */
    public function __construct(
        CasaRepository $casa,
        InfraestruturaRepository $infraestruturaRepository
    )
    {
        $this->middleware('auth');
        $this->casa = $casa;
        $this->infra = $infraestruturaRepository;
    }

    /**
     * Método de exibição de dados principais
     *
     * @return mixed
     */
    public function index()
    {

        if (!Entrust::can('manage-infra')){
            return redirect()->route('admin.restrito');
        }

        return view('backend.modules.infraestrutura.index')
            ->with('dados', $this->infra->getAll(8));
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

            //dd($request->all());
            if ($this->infra->create($request->all())) {
                Log::write('event', 'Registro ' . $request->name . ' foi cadastrado por ' . auth()->user()->name);
            }
            return redirect()->route('admin.orcamento.index');

        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.orcamento.index');
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
        if (!Entrust::can('manage-infra')){
            return redirect()->route('admin.restrito');
        }

        try {
            return view('backend.modules.menu.edit')
                ->withInfra($this->infra->find($id))
                ->withCasas($this->casa->all());
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.menus.index');
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
            if ($this->infra->update($request->all(), $id)) {
                Log::write('event', 'Registro ' . $request->name . ' alterado por ' . auth()->user()->name);
            }
            return redirect()->route('admin.menus.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.menus.index');
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        if (!Entrust::can('manage-infra')){
            return redirect()->route('admin.restrito');
        }

        try {
            $tipo = $this->infra->find($id)->type;
            if ($this->infra->delete($id)) {
                Log::write('event', 'Registro ' . $tipo . ' removido por ' . auth()->user()->name);
            }
            notify()->flash('Registro removido com sucesso!', 'success');
            return redirect()->route('admin.orcamento.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.orcamento.index');
        }
    }

    public function viewImport()
    {
        if (!Entrust::can('manage-infra')){
            return redirect()->route('admin.restrito');
        }

        return view('backend.modules.infraestrutura.import');
    }

    public function postImport(Request $request)
    {
        try{
            $this->infra->import($request->all());
            notify()->flash('Registros importados com sucesso!', 'success');
            return redirect()->route('admin.infra.index');
        }catch (GeneralException $e){
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.infra.index');
        }
    }

}
<?php

namespace App\Http\Controllers\Backend\Application;

use App\Enum\OrcamentoTipos;
use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\MenuRepository;
use App\Repositories\Backend\Application\Contracts\OrcamentoRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;
use Zizaco\Entrust\EntrustFacade as Entrust;

class OrcamentoController extends Controller
{

    /**
     * Variável instancia do repositório
     *
     * @var $casa
     */
    protected $orcamento;

    /**
     * Variável instancia do repositório
     *
     * @var $casa
     */
    protected $casa;

    /**
     * @var $file
     */
    private $file;

    /**
     * @var $tipos
     */
    private $tipos;

    /**
     * MenuController constructor.
     * @param MenuRepository $menu
     */
    public function __construct(
        CasaRepository $casa,
        OrcamentoRepository $orcamentoRepository
    )
    {
        $this->middleware('auth');
        $this->casa = $casa;
        $this->orcamento = $orcamentoRepository;
    }

    /**
     * Método de exibição de dados principais
     *
     * @return mixed
     */
    public function index()
    {
        if (!Entrust::can('manage-orc')){
            return redirect()->route('admin.restrito');
        }

        return view('backend.modules.orcamento.index')
            ->withTipos(OrcamentoTipos::getConstants())
            ->withCasas($this->casa->all())
            ->withSesi($this->orcamento->getAllOrder('SESI'))
            ->withSenai($this->orcamento->getAllOrder('SENAI'));
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

            if ($this->file = $request->file('files')->store('orcamento','files')){
                //adicionar o nome do arquivo no array de dados
                $data = array_add($request->all(),'file',$this->file);
                //Criar registro no DB
                if ($this->orcamento->create($data)) {
                    Log::write('event', 'Orçamento ' . $this->getTipos()[$request->type] . ' foi cadastrado por ' . auth()->user()->name);
                }
            }
            notify()->flash('Registro cadastrado com sucesso!', 'success');
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
        try {

            if (!Entrust::can('manage-orc')){
                return redirect()->route('admin.restrito');
            }

            return view('backend.modules.orcamento.edit')
                ->withOrcamento($this->orcamento->find($id))
                ->withTipos(OrcamentoTipos::getConstants())
                ->withCasas($this->casa->all());
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.orcamento.index');
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
                if ($file = $request->file('files')->store('orcamento','files')){
                    //adicionar o nome do arquivo no array de dados
                    $data = array_add($request->all(),'file',$file);
                    //Altera registro no DB
                    if ($this->orcamento->update($data, $id)) {
                        Log::write('event', 'Orçamento ' . $this->getTipos()[$request->type] . ' foi alterado por ' . auth()->user()->name);
                    }
                }
            }else{
                if ($this->orcamento->update($request->all(), $id)) {
                    Log::write('event', 'Orçamento ' . $this->getTipos()[$request->type] . ' foi alterado por ' . auth()->user()->name);
                }
            }
            notify()->flash('Registro alterado com sucesso!', 'success');
            return redirect()->route('admin.orcamento.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.orcamento.index');
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        try {

            if (!Entrust::can('manage-orc')){
                return redirect()->route('admin.restrito');
            }

            $tipo = $this->orcamento->find($id)->type;
            if ($this->orcamento->delete($id)) {
                Log::write('event', 'Orçamento ' . $this->getTipos()[$tipo] . ' removido por ' . auth()->user()->name);
            }
            notify()->flash('Registro removido com sucesso!','success');
            return redirect()->route('admin.orcamento.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.orcamento.index');
        }
    }

    private function getTipos()
    {
        return $this->tipos = OrcamentoTipos::getConstants();
    }

}
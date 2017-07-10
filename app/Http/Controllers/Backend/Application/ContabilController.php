<?php

namespace App\Http\Controllers\Backend\Application;

use App\Enum\ContabilTipos;
use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\ContabilRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;
use Zizaco\Entrust\EntrustFacade as Entrust;

class ContabilController extends Controller
{

    /**
     * Variável instancia do repositório
     *
     * @var $contabil
     */
    protected $contabil;

    /**
     * Variável instancia do repositório
     *
     * @var $casa
     */
    protected $casa;

    /**
     * ContabilController constructor.
     * @param ContabilRepository $contabilRepository
     */
    public function __construct(
        CasaRepository $casa,
        ContabilRepository $contabilRepository
    )
    {
        $this->middleware('auth');
        $this->casa = $casa;
        $this->contabil = $contabilRepository;
    }

    /**
     * Método de exibição de dados principais
     *
     * @return mixed
     */
    public function index()
    {
        if (!Entrust::can('manage-cont')){
            return redirect()->route('admin.restrito');
        }

        return view('backend.modules.contabil.index')
            ->withTipos($this->getTipos())
            ->withCasas($this->casa->all())
            ->withContaSesi($this->contabil->findWhere(['casa_id' => getCasaId('SESI')]))
            ->withContaSenai($this->contabil->findWhere(['casa_id' => getCasaId('SENAI')]));
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
            if ($file = $request->file('files')->store('contabil','files')){
                //adicionar o nome do arquivo no array de dados
                $data = array_add($request->all(),'file',$file);
                //Criar registro no DB
                if ($this->contabil->create($data)) {
                    Log::write('event', 'Demonstração Contábil ' . $this->getTipos()[$request->type] . ' foi cadastrado por ' . auth()->user()->name);
                }
            }
            notify()->flash('Registro cadastrado com sucesso!','success');
            return redirect()->route('admin.contabil.index');

        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.contabil.index');
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

        if (!Entrust::can('manage-cont')){
            return redirect()->route('admin.restrito');
        }

        try {
            return view('backend.modules.contabil.edit')
                ->withConta($this->contabil->find($id))
                ->withTipos($this->getTipos())
                ->withCasas($this->casa->all());
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.contabil.index');
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
                if ($file = $request->file('files')->store('contabil','files')){
                    //adicionar o nome do arquivo no array de dados
                    $data = array_add($request->all(),'file',$file);
                    //Altera registro no DB
                    if ($this->contabil->update($data, $id)) {
                        Log::write('event', 'Demonstração Contabil ' . $this->getTipos()[$request->type] . ' foi alterado por ' . auth()->user()->name);
                    }
                }
            }else{
                if ($this->contabil->update($request->all(), $id)) {
                    Log::write('event', 'Demonstração Contabil ' . $this->getTipos()[$request->type] . ' alterado por ' . auth()->user()->name);
                }
            }

            notify()->flash('Registro alterado com sucesso!','success');
            return redirect()->route('admin.contabil.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.contabil.index');
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        if (!Entrust::can('manage-cont')){
            return redirect()->route('admin.restrito');
        }

        try {
            $conta = $this->contabil->find($id)->type;
            if ($this->contabil->delete($id)) {
                Log::write('event', 'Demonstração Contábil ' . $this->getTipos()[$conta] . ' removida por ' . auth()->user()->name);
            }
            notify()->flash('Registro removido com sucesso!','success');
            return redirect()->route('admin.contabil.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.contabil.index');
        }
    }

    public function getTipos()
    {
        return ContabilTipos::getConstants();
    }

}
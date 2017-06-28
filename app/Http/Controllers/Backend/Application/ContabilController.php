<?php

namespace App\Http\Controllers\Backend\Application;

use App\Enum\Bloco;
use App\Enum\ContabilTipos;
use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\ContabilRepository;
use App\Repositories\Backend\Application\Contracts\MenuRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;
use App\Enum\Tipos;
use Illuminate\Support\Facades\Storage;

class ContabilController extends Controller
{

    /**
     * Variável instancia do repositório
     *
     * @var $casa
     */
    protected $contabil;

    /**
     * Variável instancia do repositório
     *
     * @var $casa
     */
    protected $casa;

    /**
     * MenuController constructor.
     * @param MenuRepository $menu
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
        return view('backend.modules.contabil.index')
            ->withTipos($this->getTipos())
            ->withFiles(Storage::disk('contas')->files())
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
            if ($this->contabil->create($request->all())) {
                Log::write('event', 'Demonstração Contábil ' . $this->getTipos()[$request->type] . ' foi cadastrada por ' . auth()->user()->name);
            }
            notify()->flash('Cadastrado com sucesso!','success');
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
        try {
            return view('backend.modules.contabil.edit')
                ->withConta($this->contabil->find($id))
                ->withTipos($this->getTipos())
                ->withFiles(Storage::disk('contas')->files())
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
            if ($this->contabil->update($request->all(), $id)) {
                Log::write('event', 'Demonstração Contábil ' . $this->getTipos()[$request->type] . ' alterado por ' . auth()->user()->name);
            }
            notify()->flash('Registro alterado','success');
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
        try {
            $conta = $this->contabil->find($id)->type;
            if ($this->contabil->delete($id)) {
                Log::write('event', 'Demonstração Contábil ' . $this->getTipos()[$conta] . ' removida por ' . auth()->user()->name);
            }
            notify()->flash('Removido com sucesso!','success');
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
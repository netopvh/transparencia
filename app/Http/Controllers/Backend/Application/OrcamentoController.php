<?php

namespace App\Http\Controllers\Backend\Application;

use App\Enum\Bloco;
use App\Enum\OrcamentoTipos;
use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\MenuRepository;
use App\Repositories\Backend\Application\Contracts\OrcamentoRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;
use App\Enum\Tipos;
use Illuminate\Support\Facades\Storage;

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
        return view('backend.modules.orcamento.index')
            ->withTipos(OrcamentoTipos::getConstants())
            ->withFiles(Storage::disk('orcamento')->files())
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

            //dd($request->all());
            if ($this->orcamento->create($request->all())) {
                Log::write('event', 'Orçamento ' . $request->name . ' foi cadastrado por ' . auth()->user()->name);
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
        try {
            return view('backend.modules.menu.edit')
                ->withMenu($this->menu->find($id))
                ->withBlocos(Bloco::getConstants())
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
            if ($this->menu->update($request->all(), $id)) {
                Log::write('event', 'Menu ' . $request->name . ' alterado por ' . auth()->user()->name);
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
        try {
            $tipo = $this->orcamento->find($id)->type;
            if ($this->orcamento->delete($id)) {
                Log::write('event', 'Orçamento ' . $tipo . ' removido por ' . auth()->user()->name);
            }
            notify()->flash('Registro removido com sucesso!','success');
            return redirect()->route('admin.orcamento.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.orcamento.index');
        }
    }

}
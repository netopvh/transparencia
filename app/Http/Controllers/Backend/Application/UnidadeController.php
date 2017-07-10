<?php

namespace App\Http\Controllers\Backend\Application;

use App\Enum\Bloco;
use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\MenuRepository;
use App\Repositories\Backend\Application\Contracts\UnidadeRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;

class UnidadeController extends Controller
{

    /**
     * Variável instancia do repositório
     *
     * @var $unidade
     */
    protected $unidade;

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
        UnidadeRepository $unidadeRepository
    )
    {
        $this->middleware('auth');
        $this->casa = $casa;
        $this->unidade = $unidadeRepository;
    }

    /**
     * Método de exibição de dados principais
     *
     * @return mixed
     */
    public function index()
    {
        return view('backend.modules.orcamento.index');
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
            if ($this->unidade->create($request->all())) {
                Log::write('event', 'Unidade ' . $request->name . ' foi cadastrado por ' . auth()->user()->name);
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
                ->withMenu($this->unidade->find($id))
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
            if ($this->unidade->update($request->all(), $id)) {
                Log::write('event', 'Unidade ' . $request->name . ' alterado por ' . auth()->user()->name);
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
            $tipo = $this->unidade->find($id)->type;
            if ($this->unidade->delete($id)) {
                Log::write('event', 'Unidade ' . $tipo . ' removido por ' . auth()->user()->name);
            }
            notify()->flash('Registro removido com sucesso!','success');
            return redirect()->route('admin.orcamento.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.orcamento.index');
        }
    }

}
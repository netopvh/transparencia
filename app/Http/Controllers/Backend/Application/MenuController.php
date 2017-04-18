<?php
namespace App\Http\Controllers\Backend\Application;

use App\Enum\Bloco;
use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\MenuRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;

class MenuController extends Controller
{

    /**
     * Variável instancia do repositório
     *
     * @var $menu
     */
    protected $menu;

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
        MenuRepository $menu,
        CasaRepository $casa
    )
    {
        $this->middleware('auth');
        $this->menu = $menu;
        $this->casa = $casa;
    }

    /**
     * Método de exibição de dados principais
     *
     * @return mixed
     */
    public function index()
    {
        return view('backend.modules.menu.index')
            ->withMenus($this->menu->with('casa')->all());
    }

    /**
     * Método para inserir novo registro no banco de dados
     *
     * @return mixed
     */
    public function create()
    {
        return view('backend.modules.menu.create')
            ->withBlocos(Bloco::getConstants())
            ->withCasas($this->casa->all());
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
            if ($this->menu->create($request->all())) {
                Log::write('event', 'Menu ' . $request->name . ' foi cadastrado por ' . auth()->user()->name);
            }
            return redirect()->route('admin.menus.index');

        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.menus.index');
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
            $casa = $this->casa->find($id)->name;
            if ($this->casa->delete($id)) {
                Log::write('event', 'Casa ' . $casa . ' removida por ' . auth()->user()->name);
            }
            return redirect()->route('admin.casas.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.casas.index');
        }
    }

}
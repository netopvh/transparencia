<?php

namespace App\Http\Controllers\Backend\Application;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\ConvenioRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;

class ConvenioController extends Controller
{

    /**
     * Variável instancia do repositório
     *
     * @var $convenio
     */
    protected $convenio;

    /**
     * Variável instancia do repositório
     *
     * @var $casa
     */
    protected $casa;

    /**
     * ConvenioController constructor.
     * @param  $menu
     */
    public function __construct(
        CasaRepository $casa,
        ConvenioRepository $convenioRepository
    )
    {
        $this->middleware('auth');
        $this->casa = $casa;
        $this->convenio = $convenioRepository;
    }

    /**
     * Método de exibição de dados principais
     *
     * @return mixed
     */
    public function index()
    {
        return view('backend.modules.convenios.index')
            ->with('convenios',$this->convenio->with('casa')->paginate(8));
    }


    public function create()
    {
        return view('backend.modules.convenios.create')
            ->with('casas',$this->casa->all());
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

            if ($this->convenio->create($request->all())) {
                Log::write('event', 'Convenio ' . $request->name . ' foi cadastrado por ' . auth()->user()->name);
            }
            notify()->flash('Registro inserido com sucesso!','success');
            return redirect()->route('admin.convenio.index');

        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.convenio.index');
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
            return view('backend.modules.convenios.edit')
                ->withConvenio($this->convenio->find($id))
                ->withCasas($this->casa->all());
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.convenio.index');
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
            if ($this->convenio->update($request->all(), $id)) {
                Log::write('event', 'Convenio ' . $request->name . ' alterado por ' . auth()->user()->name);
            }
            notify()->flash('Registro atualizado com sucesso!','success');
            return redirect()->route('admin.convenio.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.convenio.index');
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        try {
            $tipo = $this->convenio->find($id)->type;
            if ($this->convenio->delete($id)) {
                Log::write('event', 'Convenio ' . $tipo . ' removido por ' . auth()->user()->name);
            }
            notify()->flash('Registro removido com sucesso!','success');
            return redirect(url()->previous());
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect(url()->previous());
        }
    }

}
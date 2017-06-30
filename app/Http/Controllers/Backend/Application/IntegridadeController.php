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
use Illuminate\Support\Facades\Storage;

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
        //dd($this->integridade->getAll('SESI'));
        return view('backend.modules.integridade.index')
            ->withTipos(IntegridadeTipos::getConstants())
            ->withSesi($this->integridade->getAll('SESI'))
            ->withSenai($this->integridade->getAll('SENAI'));
    }

    public function create()
    {
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
            if ($file = $request->file('files')->store('integridade','integridade')){
                //adicionar o nome do arquivo no array de dados
                $data = array_add($request->all(),'file',$file);
                //Criar registro no DB
                if ($this->integridade->create($data)) {
                    Log::write('event', 'Integridade ' . $request->name . ' foi cadastrado por ' . auth()->user()->name);
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
        try {
            return view('backend.modules.integridade.edit')
                ->withMenu($this->integridade->find($id))
                ->withBlocos(Bloco::getConstants())
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
            if ($this->integridade->update($request->all(), $id)) {
                Log::write('event', 'Integridade ' . $request->name . ' alterado por ' . auth()->user()->name);
            }
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
            $tipo = $this->integridade->find($id)->type;
            if ($this->integridade->delete($id)) {
                Log::write('event', 'Integridade ' . $tipo . ' removido por ' . auth()->user()->name);
            }
            notify()->flash('Registro removido com sucesso!','success');
            return redirect()->route('admin.integridade.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.integridade.index');
        }
    }

}
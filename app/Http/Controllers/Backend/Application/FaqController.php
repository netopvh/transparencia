<?php

namespace App\Http\Controllers\Backend\Application;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\FaqRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;

class FaqController extends Controller
{

    /**
     * Variável instancia do repositório
     *
     * @var $faq
     */
    protected $faq;

    /**
     * Variável instancia do repositório
     *
     * @var $casa
     */
    protected $casa;

    /**
     * FaqController constructor.
     * @param FaqRepository $menu
     */
    public function __construct(
        CasaRepository $casa,
        FaqRepository $faqRepository
    )
    {
        $this->middleware('auth');
        $this->casa = $casa;
        $this->faq = $faqRepository;
    }

    /**
     * Método de exibição de dados principais
     *
     * @return mixed
     */
    public function index()
    {

        return view('backend.modules.faq.index')
            ->withSesi($this->faq->getAllCasa(getCasaId('SESI')))
            ->withSenai($this->faq->getAllCasa(getCasaId('SENAI')));
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.modules.faq.create')
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
            if ($this->faq->create($request->all())) {
                Log::write('event', 'Faq ' . $request->name . ' foi cadastrado por ' . auth()->user()->name);
            }
            notify()->flash('Cadastrado com sucesso!','success');
            return redirect()->route('admin.faq.index');

        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.faq.index');
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
            return view('backend.modules.faq.edit')
                ->withFaq($this->faq->with('casa')->find($id))
                ->withCasas($this->casa->all());
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.faq.index');
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
            if ($this->faq->update($request->all(), $id)) {
                Log::write('event', 'Faq ' . $request->name . ' alterado por ' . auth()->user()->name);
            }
            notify()->flash('Alterado com sucesso!','success');
            return redirect()->route('admin.faq.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.faq.index');
        }

    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        try {
            $faq = $this->faq->find($id)->question;
            if ($this->faq->delete($id)) {
                Log::write('event', 'Faq ' . $faq . ' removida por ' . auth()->user()->name);
            }
            notify()->flash('Removido com sucesso!','success');
            return redirect()->route('admin.faq.index');
        } catch (GeneralException $e) {
            notify()->flash($e->getMessage(), 'danger');
            return redirect()->route('admin.faq.index');
        }
    }

}
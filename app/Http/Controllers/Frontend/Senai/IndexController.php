<?php

namespace App\Http\Controllers\Frontend\Senai;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Repositories\Backend\Application\Contracts\DirigenteRepository;
use App\Repositories\Backend\Application\Contracts\MenuRepository;
use App\Repositories\Backend\Application\Contracts\EstadoRepository;
use App\Repositories\Backend\Application\Contracts\PaginaRepository;
use App\Repositories\Backend\Application\Contracts\RemuneratoriaRepository;
use App\Repositories\Backend\Application\Contracts\TecnicoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    /**
     * @var $menu
     */
    private $menu;

    /**
     * @var $pagina
     */
    private $pagina;

    /**
     * @var $remunera
     */
    private $remunera;

    /**
     * @var $dirigente
     */
    private $dirigente;

    /**
     * @var $tecnico
     */
    private $tecnico;

    /**
     * @var $estado
     */
    private $estado;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        MenuRepository $menu,
        PaginaRepository $paginaRepository,
        RemuneratoriaRepository $remuneratoriaRepository,
        DirigenteRepository $dirigenteRepository,
        TecnicoRepository $tecnicoRepository,
        EstadoRepository $estadoRepository
    )
    {
        $this->menu = $menu;
        $this->pagina = $paginaRepository;
        $this->remunera = $remuneratoriaRepository;
        $this->dirigente = $dirigenteRepository;
        $this->tecnico = $tecnicoRepository;
        $this->estado = $estadoRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.senai.home')
            ->withMenuCentro($this->menu->getMenuCentro('SENAI'))
            ->withDescritivo($this->menu->getDescritivo('SENAI'));
    }

    public function getPage($slug)
    {
        try {
            return view('frontend.senai.modules.pagina')
                ->withPagina($this->pagina->findBySlug($slug, getCasaId('SENAI')));
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getRemuneratoria()
    {
        try {
            return view('frontend.senai.modules.estrutura')
                ->withRemunera($this->remunera->getAll(getCasaId('SENAI')));
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getDirigentes()
    {
        try {
            return view('frontend.senai.modules.dirigentes')
                ->withDirigentes($this->dirigente->getAll(getCasaId('SENAI')));
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getTecnicos()
    {
        try {
            return view('frontend.senai.modules.tecnicos')
                ->withTecnicos($this->tecnico->getAll(getCasaId('SENAI')));
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getSac()
    {
        return view('frontend.senai.modules.sac')
            ->withEstados($this->estado->all());
    }

    public function postSac(Request $request)
    {
        //$estado = $this->estado->find($request->all());
        //$mensagem = $this->setMessage($request->all());


        Mail::to(env('MAIL_TO'))->send(new ContactMail($request->all()));

        alert()->success('Sucesso!', 'Sua mensagem foi enviada!');
        return redirect()->route('senai.sac');
    }

    public function getGratuidade()
    {
        return view('frontend.senai.modules.gratuidade');
    }

    /**
    public function setMessage($message)
    {
        $data = [
            'casa' => $message->casa,
            'nome' => $message->nome,
            'email' => $message->email,
            'empresa' => $message->empresa,
            'telefone' => $message->telefone,
            //'estado' => $estado->name,
            'cidade' => $message->cidade,
            'assunto' => $message->assunto,
            'categoria' => $message->categoria,
            'mensagem' => $message->mensagem
        ];

        return $data;
    }*/
}

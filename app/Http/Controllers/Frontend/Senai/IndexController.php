<?php

namespace App\Http\Controllers\Frontend\Senai;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\DirigenteRepository;
use App\Repositories\Backend\Application\Contracts\MenuRepository;
use App\Repositories\Backend\Application\Contracts\PaginaRepository;
use App\Repositories\Backend\Application\Contracts\RemuneratoriaRepository;
use App\Repositories\Backend\Application\Contracts\TecnicoRepository;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        MenuRepository $menu,
        PaginaRepository $paginaRepository,
        RemuneratoriaRepository $remuneratoriaRepository,
        DirigenteRepository $dirigenteRepository,
        TecnicoRepository $tecnicoRepository
    )
    {
        $this->menu = $menu;
        $this->pagina = $paginaRepository;
        $this->remunera = $remuneratoriaRepository;
        $this->dirigente = $dirigenteRepository;
        $this->tecnico = $tecnicoRepository;
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
}

<?php

namespace App\Http\Controllers\Frontend\Sesi;

use App\Enum\ContabilTipos;
use App\Enum\OrcamentoTipos;
use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\ContabilRepository;
use App\Repositories\Backend\Application\Contracts\DirigenteRepository;
use App\Repositories\Backend\Application\Contracts\EstadoRepository;
use App\Repositories\Backend\Application\Contracts\FaqRepository;
use App\Repositories\Backend\Application\Contracts\OrcamentoRepository;
use App\Repositories\Backend\Application\Contracts\PaginaRepository;
use App\Repositories\Backend\Application\Contracts\RemuneratoriaRepository;
use App\Repositories\Backend\Application\Contracts\TecnicoRepository;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
Use Illuminate\Http\Request;

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
     * @var $faq
     */
    private $faq;

    /**
     * @var
     */
    private $contabil;

    /**
     * @var $orcamento
     */
    private $orcamento;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        PaginaRepository $paginaRepository,
        RemuneratoriaRepository $remuneratoriaRepository,
        DirigenteRepository $dirigenteRepository,
        TecnicoRepository $tecnicoRepository,
        EstadoRepository $estadoRepository,
        FaqRepository $faqRepository,
        ContabilRepository $contabilRepository,
        OrcamentoRepository $orcamentoRepository
    )
    {
        $this->pagina = $paginaRepository;
        $this->remunera = $remuneratoriaRepository;
        $this->dirigente = $dirigenteRepository;
        $this->tecnico = $tecnicoRepository;
        $this->estado = $estadoRepository;
        $this->faq = $faqRepository;
        $this->contabil = $contabilRepository;
        $this->orcamento = $orcamentoRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('frontend.sesi.home');
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getPage($slug)
    {
        try {
            return view('frontend.sesi.modules.pagina')
                ->withPagina($this->pagina->findBySlug($slug, getCasaId('SESI')));
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getLdo()
    {
        try {
            return view('frontend.sesi.modules.ldo')
                ->withTipos(OrcamentoTipos::getConstants())
                ->withOrcAtual($this->orcamento->getOrcamentoActualYear('SESI'))
                ->withYears($this->orcamento->getOrcamentoThreeYear('SESI'));
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getContabeis()
    {
        try {
            return view('frontend.sesi.modules.contabeis')
                ->withContas($this->contabil->findWhere(['casa_id' => getCasaId('SESI')]))
                ->withTipos(ContabilTipos::getConstants());
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getExecucao()
    {
        try {
            return view('frontend.sesi.modules.execucao');
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getRemuneratoria()
    {
        try {
            return view('frontend.sesi.modules.estrutura')
                ->withRemunera($this->remunera->getAll(getCasaId('SESI')));
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getDirigentes()
    {
        try {
            return view('frontend.sesi.modules.dirigentes')
                ->withDirigentes($this->dirigente->getAll(getCasaId('SESI')));
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getTecnicos()
    {
        try {
            return view('frontend.sesi.modules.tecnicos')
                ->withTecnicos($this->tecnico->getAll(getCasaId('SESI')));
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getSac()
    {
        return view('frontend.sesi.modules.sac')
            ->withEstados($this->estado->all());
    }

    public function postSac(Request $request)
    {
        Mail::to(config('mail.recipient'))->send(new ContactMail($request->all()));

        alert()->success('Sucesso!', 'Sua mensagem foi enviada!');
        return redirect()->route('sesi.sac');
    }

    public function getGratuidade()
    {
        return view('frontend.sesi.modules.gratuidade');
    }

    public function getFaq()
    {
        return view('frontend.sesi.modules.faq')
            ->withFaqs($this->faq->findWhere(['casa_id' => getCasaId('SESI')]));
    }
}

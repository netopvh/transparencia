<?php

namespace App\Http\Controllers\Frontend\Senai;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Mail\ConfirmSent;
use App\Mail\ContactMail;
use App\Repositories\Backend\Application\Contracts\DirigenteRepository;
use App\Repositories\Backend\Application\Contracts\OrcamentoRepository;
use App\Repositories\Backend\Application\Contracts\EstadoRepository;
use App\Repositories\Backend\Application\Contracts\PaginaRepository;
use App\Repositories\Backend\Application\Contracts\RemuneratoriaRepository;
use App\Repositories\Backend\Application\Contracts\TecnicoRepository;
use App\Repositories\Backend\Application\Contracts\FaqRepository;
use App\Repositories\Backend\Application\Contracts\ContabilRepository;
use App\Repositories\Backend\Application\Contracts\IntegridadeRepository;
use App\Repositories\Backend\Application\Contracts\InfraestruturaRepository;
use App\Repositories\Backend\Application\Contracts\ConvenioRepository;
use App\Enum\ContabilTipos;
use App\Enum\OrcamentoTipos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Enum\IntegridadeTipos;

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
     * @var $orcamento
     */
    private $integridade;

    /**
     * @var $infra
     */
    private $infra;

    /**
     * @var $convenio
     */
    private $convenio;

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
        OrcamentoRepository $orcamentoRepository,
        IntegridadeRepository $integridadeRepository,
        InfraestruturaRepository $infraestruturaRepository,
        ConvenioRepository $convenioRepository
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
        $this->integridade = $integridadeRepository;
        $this->infra = $infraestruturaRepository;
        $this->convenio = $convenioRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('frontend.senai.home');
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
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

    public function getLdo()
    {
        try {
            return view('frontend.senai.modules.ldo')
                ->withTipos(OrcamentoTipos::getConstants())
                ->withOrcAtual($this->orcamento->getOrcamentoActualYear('SENAI'))
                ->withYears($this->orcamento->getOrcamentoThreeYear('SENAI'));
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getContabeis()
    {
        try {
            return view('frontend.senai.modules.contabeis')
                ->withContas($this->contabil->findWhere(['casa_id' => getCasaId('SENAI')]))
                ->withTipos(ContabilTipos::getConstants());
        } catch (GeneralException $e) {
            abort(404, $e->getMessage());
        }
    }

    public function getExecucao()
    {
        try {
            return view('frontend.senai.modules.execucao');
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
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);

        if ($validator->fails()) {
            alert()->error('Erro!', 'Faltou marcar o captcha');
            return redirect()->route('senai.sac');
        }

        Mail::to(config('mail.recipient'))->queue(new ContactMail($request->all()));
        Mail::to($request->get('email'))->queue(new ConfirmSent($request->all()));

        alert()->success('Sucesso!', 'Sua mensagem foi enviada!');
        return redirect()->route('senai.sac');
    }

    public function getGratuidade()
    {
        return view('frontend.senai.modules.gratuidade');
    }

    public function getFaq()
    {
        return view('frontend.senai.modules.faq')
            ->withFaqs($this->faq->findWhere(['casa_id' => getCasaId('SENAI')]));
    }

    public function getIntegridade()
    {
        return view('frontend.senai.modules.integridade')
            ->withTipos(IntegridadeTipos::getConstants())
            ->withIntegridades($this->integridade->getAllCasa('SENAI'));
    }

    public function getInfraestrutura()
    {
        // 1 Unidades Fixas
        // 2 Unidades Móveis
        return view('frontend.senai.modules.infraestrutura')
            ->with('fixas', $this->infra->getAllCasa('SENAI', 1))
            ->with('moveis', $this->infra->getAllCasa('SENAI', 2))
            ->with('profissional', $this->infra->getAllCasaAtuacao('SENAI', 'Centro de Formação Profissional'))
            ->with('inovacao', $this->infra->getAllCasaAtuacao('SENAI', 'Instituto de Inovação'))
            ->with('tecnologia', $this->infra->getAllCasaAtuacao('SENAI', 'Instituto de Tecnologia'))
            ->with('faculdade', $this->infra->getAllCasaAtuacao('SENAI', 'Faculdade de Tecnologia'))
            ->with('conjunta', $this->infra->getAllCasaAtuacao('SENAI', 'Atuação Conjunta'));
    }

    public function getConvenios()
    {
        return view('frontend.senai.modules.convenios')
            ->with('convenios',$this->convenio->findWhere(['casa_id' => getCasaId('SENAI')]));
    }
}

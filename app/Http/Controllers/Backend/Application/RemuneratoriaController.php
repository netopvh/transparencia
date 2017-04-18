<?php
/**
 * Created by PhpStorm.
 * User: angelo.neto
 * Date: 18/04/2017
 * Time: 11:47
 */

namespace App\Http\Controllers\Backend\Application;

use App\Exceptions\Access\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\CasaRepository;
use App\Repositories\Backend\Application\Contracts\RemuneratoriaRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;

class RemuneratoriaController extends Controller
{

    /**
     * @var RemuneratoriaRepository
     */
    protected $remuneratoria;

    /**
     * @var CasaRepository
     */
    protected $casa;


    /**
     * PaginaController constructor.
     * @param RemuneratoriaRepository $remuneratoria
     */
    public function __construct(
        RemuneratoriaRepository $remuneratoriaRepository,
        CasaRepository $casaRepository
    )
    {
        $this->middleware('auth');
        $this->remuneratoria = $remuneratoriaRepository;
        $this->casa = $casaRepository;
    }

    public function index()
    {
        return view('backend.modules.paginas.index')
            ->withPaginas($this->pagina->all());
    }
    
}
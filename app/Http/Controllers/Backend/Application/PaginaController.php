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
use App\Repositories\Backend\Application\Contracts\PaginaRepository;
use Illuminate\Http\Request;
use App\Contracts\Facades\ChannelLog as Log;

class PaginaController extends Controller
{

    /**
     * @var PaginaRepository
     */
    protected $pagina;

    /**
     * @var CasaRepository
     */
    protected $casa;


    /**
     * PaginaController constructor.
     * @param PaginaRepository $pagina
     */
    public function __construct(
        PaginaRepository $pagina,
        CasaRepository $casa
    )
    {
        $this->middleware('auth');
        $this->pagina = $pagina;
        $this->casa = $casa;
    }

    public function index()
    {
        return view('backend.modules.paginas.index')
            ->withPaginas($this->pagina->all());
    }
    
}
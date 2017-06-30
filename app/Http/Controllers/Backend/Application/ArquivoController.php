<?php
namespace App\Http\Controllers\Backend\Application;

use App\Repositories\Backend\Application\Contracts\MenuRepository;
use Barryvdh\Elfinder\ElfinderController;
use Illuminate\Foundation\Application;

class ArquivoController extends ElfinderController
{

    /**
     * CasaController constructor.
     * @param MenuRepository $menu
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);
        parent::middleware('auth');
    }

    /**
     * Método de exibição de dados principais
     *
     * @return mixed
     */
    public function index()
    {
        return view('backend.modules.arquivos.index')
            ->with($this->getViewVars());
    }

}
<?php

namespace App\Http\Controllers\Frontend\Sesi;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\MenuRepository;

class IndexController extends Controller
{
    /**
     * @var $menu
     */
    private $menu;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MenuRepository $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.sesi.home')
            ->withMenuCentro($this->menu->getMenuCentroSesi())
            ->withDescritivo($this->menu->getDescritivoSesi());
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Application\Contracts\MenuRepository;

class HomeController extends Controller
{

    /**
     * @var
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
        return view('frontend.home');
    }
}

<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\Backend\Application\Contracts\MenuRepository;

class MenuSesiComposer
{
    /**
     * The user repository implementation.
     *
     * @var MenuRepository
     */
    protected $menus;

    /**
     * Create a new profile composer.
     *
     * @param  MenuRepository  $users
     * @return void
     */
    public function __construct(MenuRepository $menuRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->menus = $menuRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        //$view->with('menus', $this->menus->getMenuLateral('SESI'));
    }
}
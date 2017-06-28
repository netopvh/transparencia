<?php

namespace App\Providers;

use App\Repositories\Backend\Application\Contracts\MenuRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'frontend.sesi.layouts.master','App\Http\ViewComposers\MenuSesiComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

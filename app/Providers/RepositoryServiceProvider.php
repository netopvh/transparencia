<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Backend\Access\Contracts\PermissionRepository','App\Repositories\Backend\Access\PermissionRepositoryEloquent');
        $this->app->bind('App\Repositories\Backend\Access\Contracts\RoleRepository','App\Repositories\Backend\Access\RoleRepositoryEloquent');
        $this->app->bind('App\Repositories\Backend\Access\Contracts\UserRepository','App\Repositories\Backend\Access\UserRepositoryEloquent');

        $this->app->bind('App\Repositories\Backend\Application\Contracts\CasaRepository','App\Repositories\Backend\Application\CasaRepositoryEloquent');
        $this->app->bind('App\Repositories\Backend\Application\Contracts\MenuRepository','App\Repositories\Backend\Application\MenuRepositoryEloquent');
        $this->app->bind('App\Repositories\Backend\Application\Contracts\PaginaRepository','App\Repositories\Backend\Application\PaginaRepositoryEloquent');
        $this->app->bind('App\Repositories\Backend\Application\Contracts\DirigenteRepository','App\Repositories\Backend\Application\DirigenteRepositoryEloquent');
        $this->app->bind('App\Repositories\Backend\Application\Contracts\RemuneratoriaRepository','App\Repositories\Backend\Application\RemuneratoriaRepositoryEloquent');
        $this->app->bind('App\Repositories\Backend\Application\Contracts\TecnicoRepository','App\Repositories\Backend\Application\TecnicoRepositoryEloquent');

    }
}

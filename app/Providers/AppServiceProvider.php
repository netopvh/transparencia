<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Monolog\Logger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Facade to Object binding
        $this->app->bind('chanellog', 'App\Helpers\ChannelWriter');

        $this->app->bind('eventlog', function () {
            return new Logger('event');
        });
    }
}

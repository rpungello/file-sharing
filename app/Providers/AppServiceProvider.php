<?php

namespace App\Providers;

use Illuminate\Foundation\Events\DiagnosingHealth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Laravel\Nightwatch\Facades\Nightwatch;
use Lorisleiva\Actions\Facades\Actions;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            Actions::registerCommands();
        }

        Event::listen(function (DiagnosingHealth $event) {
            Nightwatch::dontSample();
        });
    }
}

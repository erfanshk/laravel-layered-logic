<?php

namespace Erfanshk\LaravelLayeredLogic\Providers;

use Erfanshk\LaravelLayeredLogic\LayeredLogic;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LayeredLogicServiceProvider extends ServiceProvider
{
    public array $bindingsArray = [

    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Route::pattern('id', '[0-9]+');
        LayeredLogic::registerBindingsArray($this->bindingsArray,$this->app);
    }
}

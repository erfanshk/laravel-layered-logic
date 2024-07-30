<?php

namespace Erfanshk\LaravelLayeredLogic\Providers;

use Erfanshk\LaravelLayeredLogic\Console\Commands\MakeCommand;
use Illuminate\Support\ServiceProvider;

class LayeredLogicInitServiceProvider extends ServiceProvider
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
        $this->commands(
            commands: [
                MakeCommand::class,
            ],
        );

        $this->publishes([
            __DIR__ . '/../Stubs/service.provider.stub' => app_path('/Providers/LayeredLogicServiceProvider.php')
        ], 'laravel-assets');
        $this->publishes([
            __DIR__ . '/../Config/layered.php' => config_path('layered.php')
        ], 'laravel-assets');
        ServiceProvider::addProviderToBootstrapFile($this->app->getNamespace() . 'Providers\LayeredLogicServiceProvider');


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function boot(): void
    {

    }
}

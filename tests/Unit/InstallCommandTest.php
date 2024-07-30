<?php

namespace Tests\Unit;

use Erfanshk\LaravelLayeredLogic\Providers\LayeredLogicInitServiceProvider;
use Erfanshk\LaravelLayeredLogic\Providers\LayeredLogicServiceProvider;
use Illuminate\Foundation\Testing\TestCase;
use Orchestra\Testbench\Concerns\CreatesApplication;


class InstallCommandTest extends TestCase
{
    use CreatesApplication;


    protected function resolveApplicationProviders($app): array
    {
        return [
            LayeredLogicInitServiceProvider::class,
            LayeredLogicServiceProvider::class,
        ];
    }

    public function test_init_provider_loaded()
    {
        $this->assertTrue($this->app->providerIsLoaded("Erfanshk\LaravelLayeredLogic\Providers\LayeredLogicInitServiceProvider"));
    }

    public function test_logic_provider_loaded()
    {
        $this->assertTrue($this->app->providerIsLoaded("Erfanshk\LaravelLayeredLogic\Providers\LayeredLogicServiceProvider"));
    }
}

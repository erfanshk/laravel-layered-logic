<?php

namespace Erfanshk\LaravelLayeredLogic\Console\Commands;

use Erfanshk\LaravelLayeredLogic\Enums\DirectoriesEnum;
use Erfanshk\LaravelLayeredLogic\Traits\MakableTrait;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;

class MakeServiceInterface extends GeneratorCommand
{
    use MakableTrait;

    const STUB_PATH = __DIR__ . '/../../Stubs/service.interface.stub';
    protected $type = 'ServiceInterface';
    protected $path = DirectoriesEnum::SERVICES_INTERFACES->value;

    protected $signature = 'layered:service_interface {name : Name of the model} {--force}';

    protected $description = 'Make a service interface layer for the given model';


    public function handle()
    {
        $this->make(fn($name) => $this->buildClassFile($name));
        $this->info($this->getNameInput() . $this->type . ' created successfully.');

    }


}

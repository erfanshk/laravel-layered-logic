<?php

namespace Erfanshk\LaravelLayeredLogic\Console\Commands;

use Erfanshk\LaravelLayeredLogic\Enums\DirectoriesEnum;
use Erfanshk\LaravelLayeredLogic\Traits\MakableTrait;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeController extends GeneratorCommand
{
    use MakableTrait;

    const STUB_PATH = __DIR__ . '/../../Stubs/controller.stub';
    protected $type = 'Controller';
    protected string $path = DirectoriesEnum::CONTROLLERS->value;
    protected $signature = 'layered:controller {name : Name of the model} {--force}';

    protected $description = 'Make a controller layer for the given model';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->make(fn($name) => $this->customBuild($this->buildClassFile($name)));
        $this->info($this->getNameInput() . $this->type . ' created successfully.');

    }

    protected function customBuild(string $content): string
    {

        $requestName = $this->laravel->getNamespace(). Str::replaceFirst('\\','',DirectoriesEnum::REQUESTS->value) .'\\' . $this->getSingularClassName() . '\\' . $this->getSingularClassName() . 'Request';
        $content = Str::replace('{{request}}', $requestName, $content);
        $serviceName = '\\'.$this->laravel->getNamespace(). Str::replaceFirst('\\','',DirectoriesEnum::SERVICES_INTERFACES->value) .'\\' . $this->getSingularClassName() . 'ServiceInterface::class';
        return Str::replace('{{ service }}', $serviceName, $content);
    }


}

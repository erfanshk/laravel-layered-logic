<?php

namespace Erfanshk\LaravelLayeredLogic\Console\Commands;

use Erfanshk\LaravelLayeredLogic\Enums\DirectoriesEnum;
use Erfanshk\LaravelLayeredLogic\Traits\MakableTrait;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeService extends GeneratorCommand
{
    use MakableTrait;

    const STUB_PATH = __DIR__ . '/../../Stubs/service.stub';
    protected $type = 'Service';
    protected string $path = DirectoriesEnum::SERVICES->value;
    protected $signature = 'layered:service {name : Name of the model} {--force}';

    protected $description = 'Make a service layer for the given model';


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

        $repositoryName = '\\'.$this->laravel->getNamespace(). Str::replaceFirst('\\','',DirectoriesEnum::REPOSITORIES_INTERFACES->value) .'\\' . $this->getSingularClassName() . 'RepositoryInterface::class';
        return Str::replace('{{ repository }}', $repositoryName, $content);
    }

}

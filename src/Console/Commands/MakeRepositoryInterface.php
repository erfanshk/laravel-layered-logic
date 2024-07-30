<?php

namespace Erfanshk\LaravelLayeredLogic\Console\Commands;

use Erfanshk\LaravelLayeredLogic\Enums\DirectoriesEnum;
use Erfanshk\LaravelLayeredLogic\Traits\MakableTrait;
use Illuminate\Console\GeneratorCommand;

class MakeRepositoryInterface extends GeneratorCommand
{
    use MakableTrait;
    const STUB_PATH = __DIR__ . '/../../Stubs/repository.interface.stub';
    protected $type = 'RepositoryInterface';
    protected string $path = DirectoriesEnum::REPOSITORIES_INTERFACES->value;
    protected $signature = 'layered:repository_interface {name : Name of the model} {--force}';
    protected $description = 'Make a repository interface layer for the given model';

    public function handle()
    {
        $this->make(fn($name) => $this->buildClassFile($name));
        $this->info($this->getNameInput() . $this->type . ' created successfully.');

    }

}

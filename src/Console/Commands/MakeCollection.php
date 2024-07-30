<?php

namespace Erfanshk\LaravelLayeredLogic\Console\Commands;

use Erfanshk\LaravelLayeredLogic\Enums\DirectoriesEnum;
use Erfanshk\LaravelLayeredLogic\Traits\MakableTrait;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeCollection extends GeneratorCommand
{
    use MakableTrait;

    const STUB_PATH = __DIR__ . '/../../Stubs/collection.stub';
    protected $type = 'Collection';
    protected string $path = DirectoriesEnum::COLLECTIONS->value;
    protected $signature = 'layered:collection {name : Name of the model} {--force}';

    protected $description = 'Make a collection layer for the given model';


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

        $resourceName = '\\'.$this->laravel->getNamespace(). Str::replaceFirst('\\','',DirectoriesEnum::RESOURCES->value) .'\\' . $this->getSingularClassName() . 'Resource::class';
        return Str::replace('{{resource}}', $resourceName, $content);
    }

}

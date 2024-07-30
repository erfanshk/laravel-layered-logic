<?php

namespace Erfanshk\LaravelLayeredLogic\Console\Commands;

use Erfanshk\LaravelLayeredLogic\Enums\DirectoriesEnum;
use Erfanshk\LaravelLayeredLogic\Traits\MakableTrait;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeResource extends GeneratorCommand
{
    use MakableTrait;

    const STUB_PATH = __DIR__ . '/../../Stubs/resource.stub';
    protected $type = 'Resource';
    protected string $path = DirectoriesEnum::RESOURCES->value;
    protected $signature = 'layered:resource {name : Name of the model} {--force}';

    protected $description = 'Make a resource layer for the given model';


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
        return $this->replaceInterface($content);
    }

}

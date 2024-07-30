<?php

namespace Erfanshk\LaravelLayeredLogic\Console\Commands;

use Erfanshk\LaravelLayeredLogic\Enums\DirectoriesEnum;
use Erfanshk\LaravelLayeredLogic\Traits\MakableTrait;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeRepository extends GeneratorCommand
{
    use MakableTrait;

    const STUB_PATH = __DIR__ . '/../../Stubs/repository.stub';
    protected $type = 'Repository';
    protected string $path = DirectoriesEnum::REPOSITORIES->value;
    protected $signature = 'layered:repository {name : Name of the model} {--force}';
    protected $description = 'Make a repository layer for the given model';


    public function handle()
    {
        $this->make(fn($name) => $this->customBuild($this->buildClassFile($name)));
        $this->info($this->getNameInput() . $this->type . ' created successfully.');

    }

    protected function customBuild(string $content): string
    {
        $modelName = '\\App\\Models\\' . $this->getSingularClassName() . '::class';
        $content = Str::replace('{{model}}', $modelName, $content);
        $content = $this->replaceInterface($content);
        $content = $this->replaceResource($content);
        $content = $this->replaceCollection($content);
        return $content;
    }


}

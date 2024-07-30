<?php

namespace Erfanshk\LaravelLayeredLogic\Traits;

use Erfanshk\LaravelLayeredLogic\Enums\DirectoriesEnum;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;

trait MakableTrait
{

    protected function replaceCollection(string $content): string
    {
        return Str::replace('{{collection}}', '\\' . $this->laravel->getNamespace() . Str::replaceFirst('\\', '', DirectoriesEnum::COLLECTIONS->value) . '\\' . $this->getSingularClassName() . 'Collection::class', $content);
    }
    protected function replaceResource(string $content): string
    {
        return Str::replace('{{resource}}', '\\' . $this->laravel->getNamespace() . Str::replaceFirst('\\', '', DirectoriesEnum::RESOURCES->value) . '\\' . $this->getSingularClassName() . 'Resource::class', $content);
    }

    protected function replaceInterface(string $content): string
    {
        return Str::replace('{{interface}}', $this->getSingularClassName() . $this->type . 'Interface', $content);
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "{$rootNamespace}" . $this->path;
    }

    public function getSingularClassName(): string
    {
        return ucwords(Pluralizer::singular($this->getNameInput()));
    }

    public function make(\Closure $closure) : bool
    {
        $generatedName = $this->getSingularClassName() . $this->type;
        if ($this->isReservedName($generatedName)) {
            $this->error('The name "' . $generatedName . '" is reserved by PHP.');
            return false;
        }
        $name = $this->qualifyClass($generatedName);
        $path = $this->getPath($name);
        if ((!$this->hasOption('force') ||
                !$this->option('force')) &&
            $this->alreadyExists($generatedName)) {
            $this->error($this->type . ' already exists!');

            return false;
        }
        $this->makeDirectory($path);
        $this->files->put(
            $path,
            $this->sortImports(
                $closure($name)
            )
        );
        return true;
    }

    public function buildClassFile(string $name): string
    {
        $stub = $this->files->get(
            $this->getStub()
        );
        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);

    }

    protected function getStub(): string
    {
        return self::STUB_PATH;

    }
}

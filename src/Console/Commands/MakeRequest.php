<?php

namespace Erfanshk\LaravelLayeredLogic\Console\Commands;

use Erfanshk\LaravelLayeredLogic\Enums\DirectoriesEnum;
use Erfanshk\LaravelLayeredLogic\Traits\MakableTrait;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeRequest extends GeneratorCommand
{
    use MakableTrait;

    const STUB_PATH = __DIR__ . '/../../Stubs/request.stub';
    protected $type = 'Request';
    protected string $path = DirectoriesEnum::REQUESTS->value;
    protected $signature = 'layered:request {name : Name of the model} {--force}';

    protected $description = 'Make a request layer for the given model';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->path .= '\\'.$this->getNameInput();
        $this->make(fn($name) => $this->buildClassFile($name));
        $this->info($this->getNameInput() . $this->type . ' created successfully.');

    }

}

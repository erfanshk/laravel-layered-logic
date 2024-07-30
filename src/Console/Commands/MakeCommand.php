<?php

namespace Erfanshk\LaravelLayeredLogic\Console\Commands;

use Erfanshk\LaravelLayeredLogic\LayeredLogic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Pluralizer;

class MakeCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:layered {model : Name of the model} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make layers for the given model';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $commands = [
            MakeRepositoryInterface::class,
            MakeRepository::class,
            MakeServiceInterface::class,
            MakeService::class,
            MakeResource::class,
            MakeController::class,
            MakeRequest::class,
            MakeCollection::class,
        ];
        $arguments = ['name' => $this->argument('model'), '--force' => $this->option('force')];
        foreach ($commands as $command) {
            $this->call($command, $arguments);
        }

        Artisan::call('make:model', ['name' => $this->argument('model')]);
        $modelName = ucwords(Pluralizer::singular($this->argument('model')));
        LayeredLogic::mergeModelToBindings($modelName);
        $this->info($modelName . ' Bound to application successfully');

    }

}

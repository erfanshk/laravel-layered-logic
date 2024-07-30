<?php

namespace Erfanshk\LaravelLayeredLogic;


use Erfanshk\LaravelLayeredLogic\Enums\DirectoriesEnum;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;

class LayeredLogic
{

    public static function mergeModelToBindings(string $model): void
    {
        $models = collect(require config_path('layered.php'))
            ->merge([$model])
            ->unique()
            ->sort()
            ->toArray();
        $export = var_export($models, true);
        $content = '<?php
return ' . $export . ';
';
        file_put_contents(config_path('layered.php'), $content);
    }

    public static function registerBindingsArray(array $bindings, Application $application): void
    {
        $appNamespace = $application->getNamespace();


        foreach ($bindings as $model) {
            $array = [];
            $array[] = array(
                'abstract' => $appNamespace . Str::replaceFirst('\\', '', DirectoriesEnum::REPOSITORIES_INTERFACES->value) . '\\' . $model . 'RepositoryInterface',
                'concrete' => $appNamespace . Str::replaceFirst('\\', '', DirectoriesEnum::REPOSITORIES->value) . '\\' . $model . 'Repository'
            );
            $array[] = array(
                'abstract' => $appNamespace . Str::replaceFirst('\\', '', DirectoriesEnum::SERVICES_INTERFACES->value) . '\\' . $model . 'ServiceInterface',
                'concrete' => $appNamespace . Str::replaceFirst('\\', '', DirectoriesEnum::SERVICES->value) . '\\' . $model . 'Service'
            );
            foreach ($array as $item) {
                $application->singleton(
                    abstract: $item['abstract'],
                    concrete: $item['concrete']);
            }
        }

    }
}

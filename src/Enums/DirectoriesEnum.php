<?php

namespace Erfanshk\LaravelLayeredLogic\Enums;


enum DirectoriesEnum: string
{
    case REPOSITORIES_INTERFACES = '\\Layers\\Repositories\\Interfaces';
    case REPOSITORIES = '\\Layers\\Repositories';
    case SERVICES_INTERFACES = '\\Layers\\Services\\Interfaces';
    case SERVICES = '\\Layers\\Services';
    case RESOURCES_INTERFACES = '\\Layers\\Resources\\Interfaces';
    case RESOURCES = '\\Layers\\Resources';
    case CONTROLLERS = '\\Layers\\Controllers';
    case REQUESTS = '\\Layers\\Controllers\\Requests';
    case COLLECTIONS = '\\Layers\\Resources\\Collections';
}

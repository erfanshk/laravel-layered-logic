<?php

namespace Erfanshk\LaravelLayeredLogic\Contracts;


use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Responsable;

interface BaseResourceInterface extends \ArrayAccess, \JsonSerializable,Responsable,UrlRoutable
{

}

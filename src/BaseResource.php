<?php

namespace Erfanshk\LaravelLayeredLogic;


use Erfanshk\LaravelLayeredLogic\Contracts\BaseResourceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource implements BaseResourceInterface
{

}

<?php

namespace Erfanshk\LaravelLayeredLogic;


use App\Http\Controllers\Controller;
use Erfanshk\LaravelLayeredLogic\Contracts\BaseServiceInterface;
use Erfanshk\LaravelLayeredLogic\Traits\BaseControllerTrait;

abstract class BaseController extends Controller
{
    use BaseControllerTrait;
    public BaseServiceInterface $service;

    public function __construct()
    {
        $this->service = app()->make($this->service());
    }

    abstract public function service(): string;
}

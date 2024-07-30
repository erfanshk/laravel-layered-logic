<?php

namespace Erfanshk\LaravelLayeredLogic;


use Erfanshk\LaravelLayeredLogic\Contracts\BaseRepositoryInterface;
use Erfanshk\LaravelLayeredLogic\Contracts\BaseServiceInterface;

abstract class BaseService implements BaseServiceInterface
{
    public BaseRepositoryInterface $repository;

    public function __construct()
    {
        $this->repository = app()->make($this->repository());
    }

    abstract public function repository(): string;
}

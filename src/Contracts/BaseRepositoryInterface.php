<?php

namespace Erfanshk\LaravelLayeredLogic\Contracts;


use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function model(): string;
    public function resource(): string;
    public function collection(): string;
    public function setRetrieved(Model $model) : self;
    public function toResource() : array;
}

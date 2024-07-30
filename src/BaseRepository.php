<?php

namespace Erfanshk\LaravelLayeredLogic;


use Erfanshk\LaravelLayeredLogic\Contracts\BaseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    public ?Builder $query;
    public ?Model $model;
    public ?Model $retrievedModel = null;
    public string $resource;
    public string $collection;
    public null|LengthAwarePaginator|Collection $retrievedCollection = null;

    public function __construct()
    {
        $this->model = new ($this->model());
        $this->query = $this->model->newQuery();
        $this->resource = $this->resource();
        $this->collection = $this->collection();
    }

    abstract public function model(): string;
    abstract public function resource(): string;
    abstract public function collection(): string;

    public function all() : self
    {
        $this->setCollection(collection: $this->query->paginate(1));
        return $this;
    }
    public function find(int $id) : self
    {
        $this->setRetrieved($this->query->find($id));
        return $this;
    }

    public function setRetrieved(Model $model) : self
    {
        $this->retrievedModel = $model;
        return $this;
    }
    public function setCollection(LengthAwarePaginator|Collection $collection) : self
    {
        $this->retrievedCollection = $collection;
        return $this;
    }
    public function toResource() : array
    {
        return $this->resource::make($this->retrievedModel)->resolve();
    }
    public function toCollection() : array
    {
        return $this->collection::make($this->retrievedCollection)->resolve();
    }

}

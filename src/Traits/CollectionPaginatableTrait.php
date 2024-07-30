<?php

namespace Erfanshk\LaravelLayeredLogic\Traits;
use Illuminate\Pagination\LengthAwarePaginator;

trait CollectionPaginatableTrait
{
    private string $paginationResource;
    private string $resourceClass;

    private function setPaginatable(string $resourceClass): self
    {
        $this->paginationResource = \Erfanshk\LaravelLayeredLogic\Helpers\PaginationResource::class;
        $this->resourceClass = $resourceClass;
        return $this;
    }

    private function isPaginated(): bool
    {
        return $this->resource instanceof LengthAwarePaginator;
    }

    private function paginate(): array
    {
        if($this->isPaginated()) {
            return [
                'data' => $this->resourceClass::collection($this->collection)->resolve(),
                'pagination' => (new $this->paginationResource($this))->resolve(),
            ];
        }
        return $this->resourceClass::collection($this->collection)->resolve();
    }
}

<?php
namespace Erfanshk\LaravelLayeredLogic\Helpers;


use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource {

    public static $wrap = 'pagination';


    public function toArray($request) : array
    {
        $array = $this->resource->resource->toArray();

        return [
            'currentPage'=>$array['current_page'],
            'lastPage'=>$array['last_page'],
            'firstPageUrl'=>$array['first_page_url'],
            'prevPageUrl'=>$array['prev_page_url'],
            'nextPageUrl'=>$array['next_page_url'],
            'lastPageUrl'=>$array['last_page_url'],
            'perPage'=>$array['per_page'],
            'total'=>$array['total'],
        ];
    }
}

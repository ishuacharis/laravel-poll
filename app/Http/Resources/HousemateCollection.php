<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\HousemateResource;
use App\Http\Resources\CollectionInterface;

class HousemateCollection extends ResourceCollection implements CollectionInterface
{
       
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return HousemateResource::collection($this->collection);
    }
}

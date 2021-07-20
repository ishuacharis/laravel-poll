<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\UserResource;

class UserCollection extends ResourceCollection
{


    //public static $wrap = "users";
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'users' => UserResource::collection($this->collection),
            'count' => $this->collection->count()
        ];
        //return parent::toArray($request);
    }
}

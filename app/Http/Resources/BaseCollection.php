<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Database\Eloquent\Model;

class BaseCollection extends ResourceCollection
{
    
    public function toArray($request)
    {
        return [];
    }
}

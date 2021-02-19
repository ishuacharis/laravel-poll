<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Housemate;
use App\Http\Resources\HousemateCollection;

class EvictionController extends Controller
{
    //

    public function eviction()
    {
        $housemateUpForEviction = new HousemateCollection(Housemate::all());

        if (count($housemateUpForEviction) > 0)
        {

            $reponse = [
                'response' => [
                    'data' => $housemateUpForEviction
                ]
            ];
            return response($reponse,200);
        }

        $reponse = [
            'response' => [
                'message' => 'no eviction'
            ]
        ];
        return response($reponse,500);
    }
}

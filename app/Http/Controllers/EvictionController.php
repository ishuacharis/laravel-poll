<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Housemate;
use App\Http\Resources\HousemateCollection;

class EvictionController extends Controller
{
    /**
     * Get List of housemates up for eviction
     * 
     * @param void
     * 
     * @return JsonResponse 
     * 
     */
    public function eviction()
    {
        $housemateUpForEviction = new HousemateCollection(Housemate::all());

        if (count($housemateUpForEviction) > 0)
        {

            $response = [
                'response' => [
                    'data' => $housemateUpForEviction
                ]
            ];
            return response($response,200);
        }

        $response = [
            'response' => [
                'message' => 'no eviction'
            ]
        ];
        return response($response,500);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Housemate;
use App\Repositories\HousemateRepositoryInterface;

class EvictionController extends Controller
{
    protected $collection;

    public function __construct(HousemateRepositoryInterface $housemateRepositoryInterface)
    {
        $this->housemate =  $housemateRepositoryInterface;
    }

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
        $housemateUpForEviction =  $this->housemate->collection($this->housemate->all());

        if (count($housemateUpForEviction) > 0)
        {

            $response = [
                'response' => [
                    'data' => $housemateUpForEviction,
                    "success" => true,
                    "message" => "Eviction list successfully retrieved"
                ]
            ];
            return response($response,200);
        }

        $response = [
            'response' => [
                'message' => 'No eviction list available',
                "success" => false
            ]
        ];
        return response($response,500);
    }
}

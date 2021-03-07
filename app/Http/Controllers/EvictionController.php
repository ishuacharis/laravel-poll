<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HousemateRepositoryInterface;

class EvictionController extends Controller
{
    protected $housemate;

    /**
     *  Create instance of the controller
     * 
     * @param \App\Repositories\HousemateRepositoryInterface
     * 
     * @return void
     * 
     */

    public function __construct(HousemateRepositoryInterface $housemateInterface)
    {
        $this->housemate =  $housemateInterface;
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

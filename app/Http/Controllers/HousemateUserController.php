<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VoteRequestForm;
use App\Models\HousemateUser;
use App\Repositories\VoteRepositoryInterface;

class HousemateUserController extends Controller
{
    //
    protected $vote;
    public function __construct(VoteRepositoryInterface $vote)
    {
        $this->vote  = $vote;
    }


    /**
     * create new vote record
     * @param \App\Http\Requests\VoteRequestForm|request
     * 
     * @return JsonRespnse 
     * 
     */
    public function vote(VoteRequestForm $request)
    {
        $validated = $request->validated();
        $vote = $this->createVote(['request' => $validated]);

        if ($vote) {
            $response = [
                'response' => [
                    "success" => true,
                    "message" => "Your vote was successful"
                ]
            ];
            return response($response, 200);
        }

        $response = [
            'response' => [
                "success" => false,
                "message" => "Internal server error"
            ]
        ];
        return response($response,500);
    } 

    private function createVote($args)
    {
        $request =  $args['request'];

        return $this->vote->create([
            "user_id" => $request['user_id'],
            "housemate_id" => $request['housemate_id'],
            "platform_id" => $request['platform_id'],
            "amount" => $request['amount'],
        ]);
    }
}

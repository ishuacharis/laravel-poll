<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VoteRequestForm;
use App\Models\HousemateUser;

class HousemateUserController extends Controller
{
    //


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
        $vote =  $this->createVote(['request' => $validated]);

        if ($vote) {
            $response = [
                'response' => [
                    'message' => "Your vote was successful"
                ]
            ];
            return response($vote, 200);
        }

        $response = [
            'response' => [
                'error' => "Internal server error"
            ]
        ];
        return response($vote,500);
    } 

    private function createVote($args)
    {
        $request =  $args['request'];

        return HousemateUser::create([
            "user_id" => $request['user_id'],
            "housemate_id" => $request['housemate_id'],
            "platform_id" => $request['platform_id'],
            "amount" => $request['amount'],
        ]);
    }
}

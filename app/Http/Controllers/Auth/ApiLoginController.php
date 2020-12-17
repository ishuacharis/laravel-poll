<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class ApiLoginController extends Controller
{
    //

    public function logout(Request $request) 
    {
        $token  = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function login(Request $request) {        
        
        $validator = $this->validate_credentials(['request' => $request]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all(), 422]);
        }

        $user = $this->user(['request' => $request]);

        if ($user) {
            if ($this->checkPassword(['request' => $request, 'user' => $user])) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } 
            
            $response = ["message" => "Password mismatch"];
            return response($response, 422);
            
        } 
        $response = ["message" =>'User does not exist'];
        return response($response, 422);
                 

    }
    
    private function user($args) {
        $request = $args['request'];

        return User::where('email', $request->email)->first();
    }

    private function checkPassword($args) {
        $request = $args['request'];
        $user = $args['user'];
        return Hash::check($request->password, $user->password);
    }


    private function validate_credentials($args) {
       $request =  $args['request'];
        return Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required",
        ]);
    }
    
    
























    // try {
        //$http = new \GuzzleHttp\Client;
        //     $reponse  = $http->post(config('services.passport.login_endpoint'),[
        //         'form_params' => [
        //             'grant_type' => 'passport',
        //             'client_id' => config('services.passport.client_id'),
        //             'client_secret' => config('services.passport.client_secret'),
        //             'email' => $request->email,
        //             'password' => $request->password,
        //         ]
        //     ]);
            
        //     return $response->getBody();

        // } catch (\GuzzleHttp\Exception\BadResponseException $e) {
        //     if($e->getCode() === 400) {
        //         return response('Invalid Request', $e->getCode());
        //     } elseif ($e->getCode() === 401) {
        //         return response('Your credentials are not correct', $e->getCode());
        //     }
        //     return response('Internal server error', $e->getCode());
        // } 

}

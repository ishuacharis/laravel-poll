<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Log;
use App\Repositories\UserRepositoryInterface;
use App\Interfaces\IPassword;
use App\Http\Requests\LoginFormRequest;


class ApiLoginController extends Controller
{
    //

    protected $user;
    protected $hash;

    public function __construct(UserRepositoryInterface $user, IPassword $hash) {

        $this->user = $user;
        $this->hash = $hash;

    }

    public function logout(Request $request) 
    {
        $token  = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }

    public function login(LoginFormRequest $request) {       
        //Log::debug($request); 
        
        $validated = $request->validated();

        $user = $this->findUser(['request' => $validated]);

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
  
    private function findUser($args) {
        $request = $args['request'];
        return $this->user->where('email', $request['email'])->first();
    }

    private function checkPassword($args) {
        $request = $args['request'];
        $user = $args['user'];
        return $this->hash->check($request['password'], $user->password);
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

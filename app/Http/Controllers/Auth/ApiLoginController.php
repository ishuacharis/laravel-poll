<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Repositories\UserRepositoryInterface;
use App\Contacts\Password\PasswordContract;
use App\Http\Requests\LoginFormRequest;
use Log;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Events\LoginEvent;
use Illuminate\Support\Facades\Redis;

class ApiLoginController extends Controller
{
    //

    protected $user;
    protected $hash;

    /**
     * Create instance of controller
     * 
     * @param \App\Repositories\UserRepositoryInterface
     * @param \App\Contacts\Password\PasswordContract
     * 
     */

    public function __construct(UserRepositoryInterface $user, PasswordContract $hash) {

        $this->user = $user;
        $this->hash = $hash;

    }

    public function logout(Request $request) 
    {

        try {
            $token  = $request->user()->token();
            $token->revoke();
            $response = ['response' => 'You have been successfully logged out!'];
            return response($response, 200);
        } catch (\Throwable $th) {
            Log::error("wahala");
            
        }

        
    }

    /**
     * Login user
     * 
     * @param \App\Http\Requests\LoginFormRequest|request;
     * 
     * @return JsonResponse
     * 
     */

    public function login(LoginFormRequest $request) {
        
       
        return $this->loginUser($request);
    }

    /**
     * Login User
     * 
     * @param array
     * 
     * @return JsonResponse
     * 
     */
    private function loginUser($request)
    { 

        $validated = $request->validated();

        $user = $this->findUser(['request' => $validated]);

        if ($user) {
            if ($this->checkPassword(['request' => $request, 'user' => $user])) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['response' => [
                    'user' => new UserResource($user),
                    'token' => $token
                ]];
                //LoginEvent::dispatch($user);
                event(new LoginEvent($user));
                return response($response, 200);
            } 
            
            $response = ["response" => [
                "message" => "Password mismatch"
            ]];
            return response($response, 422);
            
        } 
        $response = ['response' => [
            "message" =>'User does not exist'
        ]];
        return response($response, 404);  
    }

    /**
     * Check user
     * 
     * @param array
     * 
     * @return \App\Models\User
     * 
     */
  
    private function findUser($args) {
        $request = $args['request'];
        return $this->user->where('email', $request['email'])->first();
    }

    /**
     * Check password
     * 
     * @param array
     * 
     * @return boolean
     * 
     */
    private function checkPassword($args) {
        $request = $args['request'];
        $user = $args['user'];
        $args = ['password' => $request['password'], 'hash_password' => $user->password];
        return $this->hash->check($args);
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

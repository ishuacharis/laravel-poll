<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Repositories\UserRepositoryInterface;
use App\Contracts\Password\PasswordContract;
use App\Http\Requests\CreateUserFormRequest;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\UserResource;

class ApiRegisterController extends Controller
{

    protected $user;
    protected $hash;

    /**
     * Create instance of controller
     * 
     * @param \App\Repositories\UserRepositoryInterface
     * @param \App\Contracts\Password\PasswordContract
     * 
     */

    public function __construct(UserRepositoryInterface $user, PasswordContract $hash) 
    {
        $this->user  = $user;
        $this->hash  = $hash;

    }
    
    /**
     * Register user
     * 
     * @param \App\Http\Requests\CreateUserFormRequest;
     * 
     * @return JsonResponse
     * 
     * 
     */
    public function register(CreateUserFormRequest $request) 
    {
        
        return $this->registerUser($request);
    }

     /**
     * Register user
     * 
     * @param array
     * 
     * @return JsonResponse
     * 
     * 
     */
    private function registerUser($request) {

        //validate request;
        $validated =   $request->validated();

        $user  = $this->save_user(['request' => $validated]);

        if ($user) {
            $graceTimeInMinutes = 300;
            $expires  = time() + $graceTimeInMinutes;

            $token = $user->createToken('Laravel password Grant Client')->accessToken;
           
            $response  = [
                'response' => [
                    'user' => new UserResource($user),
                    'token' => $token,
                    'expires' => $expires
                ]
            ];          
            event(new Registered($user));
            return response($response,200);
        }

        $response =  [
            'response' => ['error' => 'Internal server error']
        ];
        return response($response, 500);
    }

    /**
     * Create new user
     * 
     * @param array
     * 
     * @return \App\Models\User
     * 
     * 
     */

    private function save_user($args)
    {
        //hash password and add other attributes before saving
        $request =  $args['request'];
        $args = ['password' => $request["password"] ];
        $request['password'] = $this->hash->make($args);
        $request['remember_token'] = Str::random(10);
        
        //save user to database
        return $this->user->create([
            "name" => $request['name'],
            "email" => $request['email'],
            "phone_no" => $request['phone_no'],
            "password" => $request['password'],
            "remember_token" => $request['remember_token'],
        ]);

    }


}

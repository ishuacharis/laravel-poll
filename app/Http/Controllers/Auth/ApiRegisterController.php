<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Repositories\UserRepositoryInterface;
use App\Interfaces\IPassword;
use Log;
use App\Http\Requests\CreateUserFormRequest;

class ApiRegisterController extends Controller
{

    protected $user;
    protected $hash;
    public function __construct(UserRepositoryInterface $user, IPassword $hash) 
    {
        $this->user  = $user;
        $this->hash  = $hash;

    }
    
    //
    public function register(CreateUserFormRequest $request) 
    {
        
        //validate request;
        $validated =   $request->validated();

        $user  = $this->save_user(['request' => $validated]);

        if ($user) {

            $token = $user->createToken('Laravel password Grant Client')->accessToken;
            $response  = ['token' => $token];

            return response($response,200);
        }

        $response =  ['message' => 'Internal server error'];
        return response($response, 500);
    }


    private function save_user($args) {
        //hash password and add other attributes before saving
        $request =  $args['request'];
        $request['password'] = $this->hash->make($request["password"]);
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

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class ApiRegisterController extends Controller
{
    //

    public function register(Request $request) 
    {
        
        //validate request;
        $validator =  $this->validate_credentials([ 'request' => $request]);
    
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all(), 422]);
        }

        $user  = $this->save_user(['request' => $request]);

        if ($user) {

            $token = $user->createToken('Laravel password Grant Client')->accessToken;
            $response  = ['token' => $token];

            return response($response,200);
        }
        print($user);

        $response =  ['message' => 'Internal server error'];
        return response($response, 500);
    }

    private function validate_credentials($args) {
        $request =  $args['request'];
        return Validator::make($request->all(), [
            "name" => "required|unique:users",
            "email" => "required|email|unique:users",
            "phone_no" => "required|unique:users",
            "password" => "required",
        ]);
    } 

    private function save_user($args) {
        //hash password and add other attribute before saving
        $request =  $args['request'];
        $request['password'] = Hash::make($request->password);
        $request['remember_token'] = Str::random(10);
        
        //save user to database
        return User::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone_no" => $request->phone_no,
            "password" => $request->phone_no,
            "remember_token" => $request->remember_token,

        ]);

    }


}

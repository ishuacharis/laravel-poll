<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\ProfileFormRequest;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfileController extends Controller
{
    //
  protected $user;

  public function __construct(UserRepositoryInterface $user) {
    $this->user = $user;
  }

  public function updateProfile(ProfileFormRequest $request, $id) {

    try {
      $validated = $request->validated();
    
      $user = $this->user->findOrFail($id);
      // OPTION ONE
      $user->update($validated);
      
      // OPTION TWO
      // forceFill([
      //   'name' => $validated['name'],
      //   'email' => $validated['email'],
      //   'phone_no' => $validated['phone_no']
      // ]);

      // OPTION THREE
      // $user->name = $validated['name'];
      // $user->email = $validated['email'];
      // $user->phone_no = $validated['phone_no'];
      //$user->save();

      $response  = [
        'response' => [
            'message' =>  'You have successfully updated profile',
            'success' => true,
            'user' => new UserResource($user)
        ]
      ];
    
      return response($response, 200);

    } catch (\Throwable $th) {
      if ($th instanceof ModelNotFoundException) {
        $response  = [
          'response' => [
              'message' =>  'Please register to update profile',
              'success' => false,
          ]
        ];
       return response($response, 404);
      }
    }
  }
}

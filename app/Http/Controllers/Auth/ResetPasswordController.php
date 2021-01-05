<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Interfaces\IPassword;
use App\Http\Requests\PasswordResetFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    private $hash;


    public function __construct(IPassword $hash){
        $this->hash = $hash;
    }


    protected function resetPassword(PasswordResetFormRequest $request)
    {
        $validated = $request->validated();
        $email = $validated['email'];
        $status =  Password::reset(
            $validated,
            function($user, $password) use ($request) {
                $user->forceFill([
                    'password' => $this->hash->make(['password' => $password])
                ]);
                $user->setRememberToken(Str::random(10));
                $user->save();
                event(new PasswordReset($user));   
            }
        );
        
        if($status ===  Password::PASSWORD_RESET){
            $response = ['message' => "password successfully updated" ];
            return response($response, 200);
        }
        $response = ['message' => __($status, ['email' => $email])];
        return response($response, 500);
 
       
    }

    protected function sendResetResponse(Request $request, $response ) {

        $response =  ['message' => 'Password reset successfully'];
        return response($response,200);

    }

    protected function sendResetFailedResponse(Request $request, $response ) {

        $response =  ['message' => 'Token invalid'];
        return response($response, 401);
        
    }
}

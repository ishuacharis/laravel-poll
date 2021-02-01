<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordFormRequest;
use Illuminate\Support\Facades\Password;
use Str;
use Log;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * 
     * @param \App\Http\Requests\PasswordFormRequest
     * 
     * @return JsonResponse
     */

    public function forgotPassword(PasswordFormRequest $request)
    {

        return $this->forgotUserPassword($request);

    }

    /**
     * 
     * @param array
     * 
     * @return JsonResponse
     */

    private function forgotUserPassword($request)
    {
        $validated =  $request->validated();
        $email = $validated['email'];
        $token = Str::random(10);
        $status  = Password::sendResetLink($validated);

        if($status === Password::RESET_LINK_SENT) {
            $response = [
                'response' => ['message' =>  __($status, ['email' => $email]) ]
            ];
            return response($response,200);
        }
        $response = [
            'response' => ['message' =>  __($status, ['email' => $email]) ]
        ];
        return response($response,422);
    }

    protected function sendResetLinkResponse(Request $request, $response ) {

        $response =  ['message' => 'Password reset email sent'];
        return response($response,200);

    }

    protected function sendResetLinkFailedResponse(Request $request, $response ) {

        $response =  ['message' => 'Email could not be sent to this email'];
        return response($response, 500);
        
    }
}

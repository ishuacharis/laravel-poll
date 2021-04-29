<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    
    protected $user;
    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\UserRepositoryInterface
     * 
     * @return void
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
        // $this->middleware('auth');
        // $this->middleware('signed')->only('verify');
        // $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Create a new controller instance.
     *
     * @param \App\Http\Request
     * 
     * @return JsonResponse
     */
    public function notice(Request $request)
    {
        $response  = [
            'response' => [
                'message' =>  'A verification link has been sent to your email'
            ]
        ];

        return response($response, 200);
    }

    /**
     * Create a new controller instance.
     *
     * @param \App\Http\Request
     * @param int
     * 
     * @return JsonResponse
     */

    public function verify($id,  Request $request)
    {   
        $expires  = $request->expires;
        $isTokenValid  = time() > $expires;
        if (!$expires) {
            $response = [
                'response' => [
                    'message' => 'You are not authorized to be here',
                    'success' => false
                ]
            ];
            return response($response, 401);
        }
        if ($isTokenValid) {

            $response = [
                'response' => [
                    'message' => 'Please provide a valid token for verification',
                    'success' => false
                ],
            ];
            return response($response, 401);
        }
        $user  =  $this->user->findOrFail($id);
        if (!$user->hasVerifiedEmail()) {

            $user->markEmailAsVerified();

            $response  = [
                'response' => [
                    'message' =>  'You have successfully being verified',
                    'success' => true
                ]
            ];
    
            return response($response, 200);
        }

        $response  = [
            'response' => [
                'message' =>  'Internal Server error',
                'success' => false
            ]
        ];

        return response($response, 500);
        
    }

    
}

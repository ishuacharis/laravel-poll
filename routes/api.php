<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiLoginController;
use App\Http\Controllers\Auth\ApiRegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



//public routes
//'json.response' middle
Route::group(['middleware' => ['cors', ]], function() {
    Route::post('register', [ApiRegisterController::class, 'register']);
    Route::post('login', [ApiLoginController::class, 'login']);
    Route::post('forgot_password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('reset_password', [ResetPasswordController::class, 'resetPassword']);
    Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
    
    
    
    //protected routes 
    Route::middleware('auth:api')->group(function() {
        Route::get('email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
        Route::post('logout', [ApiLoginController::class, 'logout'])->middleware(['verified']);
        //vote routes
    });

    
});




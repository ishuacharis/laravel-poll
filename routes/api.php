<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiLoginController;
use App\Http\Controllers\Auth\ApiRegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HousemateUserController;
use App\Http\Controllers\EvictionController;
use App\Http\Controllers\ProfileController;
use App\Events\LoginEvent;
use App\Events\MessageEvent;
use App\Models\User;

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
    //broadcast(new MessageEvent("Thank God it is working in api route"));
    Route::post('login', [ApiLoginController::class, 'login']);
    Route::post('forgot_password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('reset_password', [ResetPasswordController::class, 'resetPassword']);
    Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');
    //Route::put('profile/{id}', [ProfileController::class, 'updateProfile']);
    
    
    //protected routes 
    Route::middleware(['auth:api'])->group(function() {
        Route::get('email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
        Route::get('eviction', [EvictionController::class, 'eviction'])->middleware('verified');
        Route::post('logout', [ApiLoginController::class, 'logout']);
        Route::post('vote', [HousemateUserController::class, 'vote'])->middleware('verified');
        Route::get('notifications/{id}', [NotificationController::class, 'index'] )->middleware('verified');
        Route::put('profile/{id}', [ProfileController::class, 'updateProfile'])->middleware('verified');
        
        //vote routes
    });

    
});






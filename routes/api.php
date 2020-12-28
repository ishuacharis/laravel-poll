<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiLoginController;
use App\Http\Controllers\Auth\ApiRegisterController;

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
});

//protected routes 

Route::middleware('auth:api')->group(function() {
    Route::post('logout', [ApiLoginController::class, 'logout']);
    //vote route
});


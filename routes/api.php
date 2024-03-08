<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [AuthenticationController::class,'Register']);
Route::get('getall', [AuthenticationController::class,'getall']);
Route::post('login', [AuthenticationController::class,'Login']);
Route::get('redirectgoolge', [AuthenticationController::class,'redirectgoolge']);
Route::get('auth/google/callbackgoogle', [AuthenticationController::class,'callbackgoogle']);
Route::group([
    "middleware" => ["auth:api"]
], function(){
    Route::get("profile", [AuthenticationController::class, "profile"]);
    Route::get("refresh", [AuthenticationController::class, "refreshToken"]);
    Route::get("logout", [AuthenticationController::class, "logout"]);

});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\OffreController;

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
Route::get('produit', [ProduitController::class,'getallProduit']);
Route::post('produit', [ProduitController::class,'saveProduit']);
Route::post('produitu/{id}', [ProduitController::class,'updateProduit']);
Route::get('produit/{id}', [ProduitController::class,'getProduit']);
Route::delete('produit/{id}', [ProduitController::class,'deleteProduit']);
Route::get('valide', [ProduitController::class,'validerProduit']);
Route::get('cat', [CategorieController::class,'index']);
Route::post('cat', [CategorieController::class,'saveorupdate']);
Route::get('cat/{id}', [CategorieController::class,'show']);
Route::delete('cat/{id}', [CategorieController::class,'delete']);
Route::post('offre', [OffreController::class,'createOffre']);
Route::get('offre', [OffreController::class,'getallOffre']);
Route::get('offre/{id}', [OffreController::class,'getOffre']);
Route::put('offre/{id}', [OffreController::class,'updateOffre']);
Route::delete('offre/{id}', [OffreController::class,'deleteOffre']);

Route::group([
    "middleware" => ["auth:api"]
], function(){
    Route::get("profile", [AuthenticationController::class, "profile"]);
    Route::get("refresh", [AuthenticationController::class, "refreshToken"]);
    Route::get("logout", [AuthenticationController::class, "logout"]);

});

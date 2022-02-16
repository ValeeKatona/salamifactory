<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::post('/logout', [AuthController::class, "signOut"]);

    Route::post('/salamiproducts', [ProductsController::class, 'create']);
    Route::put('/salamiproducts/{salamiproducts}', [ProductsController::class, 'update']);
    Route::delete('/salamiproducts/{salamiproducts}', [ProductsController::class, 'delete']);

    Route::post('/salamiproducts', [IngredientsController::class, 'create']);
    Route::put('/salamiproducts/{salamis}', [IngredientsController::class, 'update']);
    Route::delete('/salamiproducts/{salamis}', [IngredientsController::class, 'delete']);
});
Route::post('/login', [AuthController::class, "signIn"]);
Route::post('/register', [AuthController::class, "signUp"]);

Route::get('/salamiproducts', [ProductsController::class, 'index']);
Route::get('/salamiproducts/{salamis}', [ProductsController::class, 'show']);
Route::post('/salamiproducts/search/{salamis}', [ProductsController::class, 'search']);

Route::get('/salamiproducts', [IngredientsController::class, 'index']);
Route::get('/salamiproducts/{salamis}', [IngredientsController::class, 'show']);


Route::post('/salamiproducts/search/{salamis}', [IngredientsController::class, 'search']);

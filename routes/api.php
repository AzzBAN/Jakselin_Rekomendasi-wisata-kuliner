<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\APIUserController;
use App\Http\Controllers\APILoginController;

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


Route::group(['middleware' => ['web']], function () {
    Route::get('/token', function (Request $request) {
        $token = $request->session()->token();

        $token = csrf_token();
        return response()->json($token, 200);

        // ...
    });
    Route::get('/user/token', [APILoginController::class, 'getUserbyToken'])->middleware('auth:sanctum');
    Route::post('/login/auth', [APILoginController::class, 'authenticate']);
    Route::post('/logout', [APILoginController::class, 'logout'])->middleware('auth:sanctum');
    //User
    Route::apiResource('user', APIUserController::class);
    Route::post('/user/update/{id}', [APIUserController::class, 'update']);
    Route::apiResource('kuliner', \App\Http\Controllers\APIKulinerController::class);
});


<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MovieCommentController;
use App\Http\Controllers\API\MovieController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('movies', [MovieController::class, 'index']);
Route::get('movies/{movie}', [MovieController::class, 'show']);

Route::get('users/public_profile/{id}',[UserController::class,'getPublicProfile']);

Route::post('movies/{movie}/comments', [MovieCommentController::class, 'store']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('movies', MovieController::class)->except(['index', 'show']);
});

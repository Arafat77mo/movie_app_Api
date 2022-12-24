<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;
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

 Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::get('/users', [AuthController::class, 'index']);
    Route::post('/creat_user', [AuthController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);  
    //movie
    Route::get('/movies', [MovieController::class, 'index']);
    Route::post('/store', [MovieController::class, 'store']);
    Route::post('/update/{id}', [MovieController::class, 'update']);
    Route::post('/destroy/{id}', [MovieController::class, 'destroy']);

//category   
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/store_cat', [CategoryController::class, 'store']);
    Route::post('/update_cat/{id}', [CategoryController::class, 'update']);
    Route::get('/show_cat/{id}', [CategoryController::class, 'show']);
    Route::post('/destroy_cat/{id}', [CategoryController::class, 'destroy']);
   
}); 

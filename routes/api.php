<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'users'], function () {

        Route::post('/', [UserController::class, 'createUser']);

        Route::get('/', [UserController::class, 'getAllUsers']);

        Route::group(['prefix' => '{id}'], function () {

            Route::put('/', [UserController::class, 'updateUser']);

            Route::delete('/', [UserController::class, 'deleteUser']);
        });

        Route::group(['prefix' => 'actions'], function () {

            Route::post('auth',  [UserController::class, 'authenticateUser']);

            Route::get('me', [UserController::class, 'getLoggedInUser'])->middleware('jwt.auth');
        });
    });

    Route::group(['prefix' => 'stores'], function () {

        Route::post('/', [StoreController::class, 'createStore'])->middleware('jwt.auth');
    });

    Route::group(['prefix' => 'products'], function () {

        Route::post('/', [ProductController::class, 'createProduct'])->middleware('jwt.auth');
    });

    Route::group(['prefix' => 'carts'], function () {

        Route::post('/', [CartController::class, 'createCart'])->middleware('jwt.auth');
    });
});

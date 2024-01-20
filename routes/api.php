<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\DiscountController;
use App\Http\Controllers\V1\ItemController;
use App\Http\Controllers\V1\MenuController;
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


Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');;
        Route::post('register', [AuthController::class, 'register']);

        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::get('logout', [AuthController::class, 'logout']);
            Route::get('user', [AuthController::class, 'user']);
        });

    });

    Route::group(['namespace' => 'V1', 'middleware' => 'auth:sanctum'], function () {

        Route::group(['prefix' => 'category'], function () {
            Route::get('list', [CategoryController::class, 'index']);
            Route::post('store', [CategoryController::class, 'store']);
        });

        Route::group(['prefix' => 'item'], function () {
            Route::get('list', [ItemController::class, 'index']);
            Route::post('store', [ItemController::class, 'store']);
        });

        Route::group(['prefix' => 'discount'], function () {
            Route::get('list', [DiscountController::class, 'index']);
            Route::post('store', [DiscountController::class, 'store']);
            Route::post('update', [DiscountController::class, 'update']);
        });

        Route::group(['prefix' => 'menu'], function () {
            Route::get('', [MenuController::class, 'index'])->withoutMiddleware('auth:sanctum');
        });

    });

});

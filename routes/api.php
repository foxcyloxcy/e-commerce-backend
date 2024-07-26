<?php

use Illuminate\Http\Request;
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

// test api
Route::get('/test', function () {
    return 'Api works!';
});

// test notification
Route::group(['prefix' => 'notification'], function () {
    Route::group(['prefix' => 'test'], function () {
        Route::post('', [\App\Http\Controllers\AuthController::class, 'testEmail']);
    });
});

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('sign-up', [\App\Http\Controllers\AuthController::class, 'signUp']);

// with auth api to access
Route::group(['middleware' => 'auth:auth-api'], function () {

    Route::group(['prefix' => 'auth'], function () {

        #Items
        Route::group(['prefix' => 'items'], function () {
            Route::get('', [\App\Http\Controllers\ItemController::class, 'index']);
            Route::post('', [\App\Http\Controllers\ItemController::class, 'store']);
            Route::get('{item}', [\App\Http\Controllers\ItemController::class, 'show']);
        });

        #Bidding
        Route::group(['prefix' => 'item-bid'], function () {
            Route::get('', [\App\Http\Controllers\ItemBiddingController::class, 'index']);
            Route::post('', [\App\Http\Controllers\ItemBiddingController::class, 'store']);
            Route::patch('{bid}', [\App\Http\Controllers\ItemBiddingController::class, 'status']);
        });

        #Bidding
        Route::group(['prefix' => 'item-comment'], function () {
            Route::get('', [\App\Http\Controllers\ItemCommentController::class, 'index']);
            Route::post('', [\App\Http\Controllers\ItemCommentController::class, 'store']);
        });

        #Transaction
        Route::group(['prefix' => 'transaction'], function () {
            Route::get('', [\App\Http\Controllers\TransactionController::class, 'index']);
            Route::post('', [\App\Http\Controllers\TransactionController::class, 'store']);
        });

        #Me
        Route::group(['prefix' => 'me'], function () {
            Route::get('profile', [\App\Http\Controllers\MeController::class, 'profile']);
        });


    });
});

// for non auth api
Route::group(['prefix' => 'global'], function () {

    Route::group(['prefix' => 'category'], function () {
        Route::get('', [\App\Http\Controllers\CategoryController::class, 'index']);
    });
    Route::group(['prefix' => 'sub-category'], function () {
        Route::get('', [\App\Http\Controllers\SubCategoryController::class, 'index']);
        Route::get('properties', [\App\Http\Controllers\SubCategoryController::class, 'properties']);
    });

    Route::group(['prefix' => 'items'], function () {
        Route::get('', [\App\Http\Controllers\ItemController::class, 'index']);
        Route::get('{item}', [\App\Http\Controllers\ItemController::class, 'show']);
    });
 });




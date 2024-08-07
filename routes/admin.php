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


Route::post('login', [\App\Http\Controllers\AdminAuthController::class, 'login']);

// with auth api to access
Route::group(['middleware' => 'auth:admin-api'], function () {

    #Items
    Route::group(['prefix' => 'items'], function () {
        Route::get('', [\App\Http\Controllers\AdminItemController::class, 'index']);
        Route::patch('approve/{item}', [\App\Http\Controllers\AdminItemController::class, 'approveItem']);
        Route::patch('decline/{item}', [\App\Http\Controllers\AdminItemController::class, 'declineItem']);
        Route::get('{item}', [\App\Http\Controllers\AdminItemController::class, 'show']);
        Route::get('status/pending', [\App\Http\Controllers\AdminItemController::class, 'pending']);
    });
   
});



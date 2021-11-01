<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\{
    UserAuthManager
};

// ProductsController
use App\Http\Controllers\Product\{
    ProductsController,
};

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

Route::group(['prefix'=>'v1','middleware'=>['json.response','cors']], function() {

    Route::get('/products', [ProductsController::class, 'index']);

    Route::group(['prefix'=>'user'], function(){

        // get products
    });

});

<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api', 'middleware' => 'cors'], function() {
	Route::post('/clientLogin', 'ClientApiController@postLogin');
    Route::post('/clientRegister', 'ClientApiController@postRegister');

    Route::get('about', 'AboutApiController@index');
    Route::get('/product_type', 'ProductTypeApiController@index');
    Route::get('/new_products', 'ProductApiController@getNewProducts');
    Route::get('/top_products', 'ProductApiController@getTopProducts');
    Route::get('/discount_products', 'ProductApiController@getDiscountProducts');
    Route::get('/related_products/{type_id}', 'ProductApiController@getRelatedProducts');
    Route::get('/detail_product/{slug}', 'ProductApiController@getDetailProduct');

    Route::post('/order', 'OrderApiController@create');
    
});



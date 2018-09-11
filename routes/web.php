<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('index', ['as' => 'trang-chu', 'uses' => 'PageController@getIndex']);

Route::get('product_type', function() {
    return view('forntend.product_type');
});

Route::get('product', function() {
    return view('forntend.product');
});

Route::get('contact', function() {
    return view('forntend.contact');
});

Route::group(['prefix' => 'admin'], function () {
	Route::group(['namespace' => 'Admin'], function() {
    	Route::get('dang-nhap', ['as' => 'login', 'uses' => 'LoginController@showLogin']);
    	Route::post('dang-nhap', ['as' => 'admin.login', 'uses' => 'LoginController@postLogin']);

    	Route::get('logout', ['as' => 'admin.logout', 'uses' => 'LoginController@logout']);
	});
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function () {
	Route::get('dashboard', 'Dashboard@index')->name('admin.dashboard');
	Route::get('/', 'Dashboard@index')->name('admin.dashboard');

    //route About
	Route::get('about', 'AboutController@index');
    Route::get('about/edit', 'AboutController@edit')->name('about.edit');
    Route::post('about/update/{id}', 'AboutController@update')->name('about.update');

    //route Teams
    Route::resource('teams', 'TeamsController');
    Route::post('teams/update/{id}', 'TeamsController@update')->name('teams.update');

    //route Product Type
    Route::get('product_type/remove/{id}', 'ProductTypeController@remove')->name('product_type.remove');
    Route::resource('product_type', 'ProductTypeController');
    Route::post('product_type/update/{id}', 'ProductTypeController@update')->name('product_type.update');

    //route Product
    Route::get('product/remove/{id}', 'ProductController@remove')->name('product.remove');
    Route::resource('product', 'ProductController');
    Route::get('product/fetchByTemplate/{template_id}', 'ProductController@fetchByTemplate');
    Route::post('product/update/{id}', 'ProductController@update')->name('product.update');

    //route Template
    Route::get('template/remove/{id}', 'TemplateController@remove')->name('template.remove');
    Route::resource('template', 'TemplateController');
    Route::post('template/update/{id}', 'TemplateController@update')->name('template.update');

    // route Banner
    Route::resource('banner', 'BannerController');
});


// Route Frontend

Route::get('dang-ky', function() {
    return view('register');
});

Route::get('dang-nhap', 'ClientController@showLogin')->name('client.showLogin');

Route::post('dang-ky', 'ClientController@store')->name('client.store');
Route::post('dang-nhap', 'ClientController@postLogin')->name('client.postLogin');
Route::get('dang-xuat', 'ClientController@logout');


Route::get('gioi-thieu', 'AboutController@index');

Route::get('danh-muc/{slug}', 'ProductTypeController@index');

Route::get('san-pham/{slug}', 'ProductController@index');

Route::get('add-to-cart', 'ProductController@addToCart');



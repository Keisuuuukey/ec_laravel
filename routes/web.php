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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ec_form','EcController@ec_action')->middleware('admin');
    
Route::post('/ec_form/store','EcController@store')->middleware('admin');

Route::post('/ec_form/destroy','EcController@destroy')->middleware('admin');

Route::post('/ec_form/status','EcController@status')->middleware('admin');

Route::post('/ec_form/stock','EcController@stock')->middleware('admin');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product_list','EcGuestController@product_list');


Route::post('/product_list/{item_id}','EcGuestController@add');

Route::get('/cart','CartsController@index');

Route::post('/cart/purchase','CartsController@purchase');

Route::post('/cart/amount','CartsController@store');

Route::get('purchasepast','CartsController@purchasepast');

Route::get('/purchasedetail/{purchasepast_id}','PurchaseController@purchaseDetail');






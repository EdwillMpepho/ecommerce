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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('truck','TruckController');
//get all items on the cart
Route::get('/cart', 'CartController@index')->name('cart.index');
// add items to cart
Route::get('/cart/add/{id}', 'CartController@create')->name('cart.create');
// store items to cart
Route::post('/cart', 'CartController@store')->name('cart.store');
// remove selected item from cart
Route::delete('/cart/{id}','CartController@removeCart')->name('cart.delete');
// check out
Route::get('/checkout/{id}', 'CheckOutController@index')->name('checkout.index');
// check out store
Route::post('/checkout','CheckOutController@store')->name('checkout.store');
// thank you
Route::get('/thankyou', 'ThankYouController@index')->name('thankyou.index');

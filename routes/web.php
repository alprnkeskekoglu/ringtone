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


Route::get('/', "HomeController@index")->name('home');
Route::get('/ringtones', "RingtoneController@index")->name('ringtone');
Route::post('/ringtone-filter', "RingtoneController@filter")->name('ringtone.filter');


Route::get('/search', "SearchController@index")->name('search');

Route::get('/contact', function() {
    return view('web.contact');
})->name('contact');


Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout_get');

Route::middleware('auth')->group(function() {
    Route::get('/profile', "ProfileController@index")->name('profile');
    Route::post('/cart', "CartController@index")->name('cart');

    Route::get('/purchase', "PurchaseController@index")->name('purchase');
    Route::post('/purchase', "PurchaseController@purchase")->name('purchase');
    Route::post('/download', "RingtoneController@download")->name('ringtone.download');


    Route::get('/credit', "CreditController@index")->name('credit');
    Route::post('/credit', "CreditController@credit")->name('credit');

});


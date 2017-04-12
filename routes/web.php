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

Route::get('/home', 'HomeController@index');

Route::resource('tax', 'TaxController');
Route::resource('unitOfMeasure', 'UnitOfMeasureController');
Route::resource('unitConversion', 'UnitConversionController');
Route::resource('price-list-name', 'PriceListNameController');
Route::resource('stockItem', 'StockItemController');

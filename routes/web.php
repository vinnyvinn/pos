<?php

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@dashboard');
    Route::get('/home', 'HomeController@index');

    Route::resource('tax', 'TaxController');
    Route::resource('unitOfMeasure', 'UnitOfMeasureController');
    Route::resource('unitConversion', 'UnitConversionController');
    Route::resource('price-list-name', 'PriceListNameController');
    Route::resource('stockItem', 'StockItemController');
    Route::resource('customer', 'CustomerController');
    Route::resource('stock', 'StockController');
    Route::resource('supplier', 'SupplierController');
    Route::resource('stall', 'StallController');
    Route::resource('setting', 'SettingController', ['except' => 'create', 'store']);
    Route::resource('purchaseOrder', 'PurchaseOrderController');
    Route::resource('users', 'UserController');
    Route::resource('sale', 'SaleController');
    Route::get('goodsReceived/{id}/receive', 'GoodsReceivedController@receive')->name('goodsReceived.receive');
    Route::resource('goodsReceived', 'GoodsReceivedController');
});

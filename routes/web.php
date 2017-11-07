<?php

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('checkIn', 'CheckInController@index')->name('checkIn');
    Route::post('checkIn', 'CheckInController@store')->name('checkIn.store');
});
Route::group(['middleware' => ['auth', 'checkedIn']], function () {
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
    Route::resource('user-group', 'UserGroupController');
    Route::resource('sale', 'SaleController');
    Route::get('goodsReceived/{id}/receive', 'GoodsReceivedController@receive')->name('goodsReceived.receive');
    Route::get('sale/receipt/{id}', 'SaleController@receipt')->name('receipt');
    Route::get('credit', 'SaleController@credit');
    Route::resource('goodsReceived', 'GoodsReceivedController');
    Route::resource('pettyCashType', 'pettyCashTypeController');
    Route::resource('pettyCash', 'PettyCashController');
});

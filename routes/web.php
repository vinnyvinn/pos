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

    Route::resource('daily','DailyReportController');
    Route::get('dailySummary','DailyReportController@dailySummary');
    Route::resource('weekly','WeeklyReportController');
    Route::get('weeklySummary','WeeklyReportController@weeklySummary');
    Route::resource('monthly','MonthtlyReportController');
    Route::get('monthlySummary','MonthtlyReportController@monthlySummary');
    Route::resource('custom','CustomReportController');
    Route::get('customSummary','CustomReportController@customSummary');
    Route::resource('notify','SalesNotificationController');
    Route::get('dailyInventory','SalesNotificationController@dailyInventory');
    Route::get('dailySales','SalesNotificationController@dailySales');
    Route::get('lowStock','SalesNotificationController@lowStock');
    Route::get('sendEmail','SalesNotificationController@sendEmail');



    Route::resource('pettyCashType', 'pettyCashTypeController');
    Route::resource('pettyCash', 'PettyCashController');
});
use App\Mail\SendEmail;

Route::get('sendnow', function () {
    // send an email to "batman@batcave.io"
    Mail::to('kituyiv@gmail.com')->send(new SendEmail);

    return view('emails.contact');
});
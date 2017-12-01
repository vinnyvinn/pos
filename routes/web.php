<?php
Route::get('fileopen', 'SaleController@fileopen');

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('checkIn', 'CheckInController@index')->name('checkIn');
    Route::post('checkIn', 'CheckInController@store')->name('checkIn.store');
    Route::get('openStall', 'OpenStallController@create')->name('openStall');
    Route::post('openStall', 'OpenStallController@store')->name('openStall.store');

    Route::get('/', 'HomeController@dashboard');
    Route::get('/home', 'HomeController@index');
    Route::resource('tax', 'TaxController');
    Route::resource('unitOfMeasure', 'UnitOfMeasureController');
    Route::resource('unitConversion', 'UnitConversionController');
    Route::resource('price-list-name', 'PriceListNameController');
    Route::resource('stockItem', 'StockItemController');
    Route::resource('customer', 'CustomerController');
    Route::resource('supplier', 'SupplierController');
    Route::resource('stall', 'StallController');
    Route::resource('setting', 'SettingController', ['except' => 'create', 'store']);
    Route::resource('users', 'UserController');
    Route::resource('user-group', 'UserGroupController');
    Route::get('goodsReceived/{id}/receive', 'GoodsReceivedController@receive')->name('goodsReceived.receive');
    Route::get('sale/receipt/{id}', 'SaleController@receipt')->name('receipt');
    Route::get('credit', 'SaleController@credit');
    Route::resource('goodsReceived', 'GoodsReceivedController');

    Route::resource('daily','DailyReportController');
    Route::get('dailySummary','DailyReportController@dailySummary');
    Route::get('dailySummaryType/{id}','DailyReportController@dailySummaryType');
    Route::get('dailySummaryProduct/{id}','DailyReportController@dailySummaryProduct');
    Route::post('storeDailyProduct','DailyReportController@storeDailyProduct');
    Route::resource('weekly','WeeklyReportController');
    Route::get('weeklySummary','WeeklyReportController@weeklySummary');
    Route::get('LoadWeekly','WeeklyReportController@LoadWeekly');
    Route::post('storeWeeklyProduct','WeeklyReportController@storeWeeklyProduct');
    Route::get('weeklySummaryType/{id}','WeeklyReportController@weeklySummaryType');
    Route::get('weeklySummaryProduct/{id}','WeeklyReportController@weeklySummaryProduct');
    Route::resource('monthly','MonthtlyReportController');
    Route::get('monthlySummary','MonthtlyReportController@monthlySummary');
    Route::post('storeMonthlyProduct','MonthtlyReportController@storeMonthlyProduct');
    Route::get('monthlySummaryType/{id}','MonthtlyReportController@monthlySummaryType');
    Route::get('monthlySummaryProduct/{id}','MonthtlyReportController@monthlySummaryProduct');
    Route::resource('custom','CustomReportController');
    Route::get('customSummary','CustomReportController@customSummary');
    Route::get('customSummaryType/{id}','CustomReportController@customSummaryType');
    Route::get('customSummaryProduct/{id}','CustomReportController@customSummaryProduct');
    Route::resource('notify','SalesNotificationController');
    Route::get('dailyInventory','SalesNotificationController@dailyInventory');
    Route::get('dailySales','SalesNotificationController@dailySales');
    Route::get('lowStock','SalesNotificationController@lowStock');
    Route::get('sendEmail','SalesNotificationController@sendEmail');
    Route::resource('transactionType','TransactionTypesController');
    Route::post('storeProduct','TransactionTypesController@storeProduct');
    Route::get('LoadJs','TransactionTypesController@LoadJs');

    Route::post('import', 'StockItemController@importExcel')->name('import');

    Route::resource('pettyCashType', 'pettyCashTypeController');
    Route::resource('pettyCash', 'PettyCashController');
});

Route::group(['middleware' => ['auth', 'checkedIn']], function () {
    Route::resource('stock', 'StockController');
    Route::resource('purchaseOrder', 'PurchaseOrderController');
    Route::resource('sale', 'SaleController');
});

<?php


Route::name('panel.')->group(function () {
    Auth::routes([
        'register' => false,
        'reset' => false,
        'verify' => false,
    ]);
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout_get');

    Route::middleware(['panel'])->group(function () {
        Route::get('/', 'HomeController@index')->name('index');

        Route::prefix('Category')->name('category.')->group(function () {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::get('/create', 'CategoryController@create')->name('create');
            Route::post('/store', 'CategoryController@store')->name('store');

            Route::prefix('/{id}')->group(function () {
                Route::get('/edit', 'CategoryController@edit')->name('edit');
                Route::post('/update', 'CategoryController@update')->name('update');
                Route::get('/delete', 'CategoryController@delete')->name('delete');
            });
        });


        Route::prefix('Ringtone')->name('ringtone.')->group(function () {
            Route::get('/', 'RingtoneController@index')->name('index');
            Route::get('/create', 'RingtoneController@create')->name('create');
            Route::post('/store', 'RingtoneController@store')->name('store');

            Route::prefix('/{id}')->group(function () {
                Route::get('/edit', 'RingtoneController@edit')->name('edit');
                Route::post('/update', 'RingtoneController@update')->name('update');
                Route::get('/delete', 'RingtoneController@delete')->name('delete');
            });
        });

        Route::prefix('RingtoneTransaction')->name('ringtone_transaction.')->group(function () {
            Route::get('/', 'RingtoneTransactionController@index')->name('index');
            //Route::get('/create', 'RingtoneTransactionController@create')->name('create');
            //Route::post('/store', 'RingtoneTransactionController@store')->name('store');

            Route::prefix('/{id}')->group(function () {
                Route::get('/edit', 'RingtoneTransactionController@edit')->name('edit');
                Route::post('/update', 'RingtoneTransactionController@update')->name('update');
                Route::get('/delete', 'RingtoneTransactionController@delete')->name('delete');
            });
        });

        Route::prefix('CreditTransaction')->name('credit_transaction.')->group(function () {
            Route::get('/', 'CreditTransactionController@index')->name('index');
            //Route::get('/create', 'CreditTransactionController@create')->name('create');
            //Route::post('/store', 'CreditTransactionController@store')->name('store');

            Route::prefix('/{id}')->group(function () {
                Route::get('/edit', 'CreditTransactionController@edit')->name('edit');
                Route::post('/update', 'CreditTransactionController@update')->name('update');
                Route::get('/delete', 'CreditTransactionController@delete')->name('delete');
            });
        });



        Route::prefix('User')->name('user.')->group(function () {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('/create', 'UserController@create')->name('create');
            Route::post('/store', 'UserController@store')->name('store');

            Route::prefix('/{id}')->group(function () {
                Route::get('/edit', 'UserController@edit')->name('edit');
                Route::post('/update', 'UserController@update')->name('update');
                Route::get('/delete', 'UserController@delete')->name('delete');
            });
        });


        Route::prefix('Report')->name('report.')->group(function () {
            Route::get('/', 'ReportController@index')->name('index');
            Route::get('/filter', 'ReportController@index')->name('filter');
        });
    });

});

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('/exchange_rate')
    ->group(function(){
        Route::post('/{base}/{quote}', 'ExchangeRateController@getRate');
    });

Route::namespace('Api\V1')
    ->name('api.v1.')
    ->prefix('v1')
    ->group(function() {
        Route::namespace('Auth')
        ->prefix('auth')
        ->name('auth.')
        ->group(function() {
            Route::post('register', 'RegisterController@register')->name('register');
            Route::post('me', 'UserController@getUser')->name('me')->middleware(['auth:api']);
        });

        Route::prefix('countries')
            ->name('countries.')
            //->middleware(['auth:api'])
            ->group(function() {
                Route::get('/', 'CountryController@index')->name('index');
                Route::get('/{country}', 'CountryController@show')->name('show');
            });

        Route::prefix('params')
            ->name('params.')
            ->middleware(['auth:api'])
            ->group(function() {
                Route::get('/', 'ParamsController@index')->name('index');
            });

        Route::namespace('User')
            ->prefix('user')
            ->name('user.')
            ->middleware(['verified', 'auth:api'])
            ->group(function() {
                Route::get('/', 'UserController@index')->name('index');

                Route::prefix('identity')
                    ->name('identity.')
                    ->group(function(){
                        Route::get('/', 'IdentityController@index')->name('index');
                        Route::post('/', 'IdentityController@store')->name('store');
                        Route::post('/app', 'IdentityController@storeApp')->name('storeApp');
                    });

                Route::prefix('address')
                    ->name('address.')
                    ->group(function(){
                        Route::get('/', 'AddressController@index')->name('index');
                        Route::post('/', 'AddressController@store')->name('store');
                        Route::post('/app', 'AddressController@storeApp')->name('storeApp');
                    });
            });

        Route::prefix('symbols')
            ->name('symbols.')
            ->middleware(['auth:api'])
            ->group(function() {
                Route::get('/', 'SymbolsController@index')->name('index');
            });

        Route::prefix('currencies')
            ->name('currencies.')
            ->middleware(['auth:api'])
            ->group(function() {
                Route::get('/', 'CurrencyController@index')->name('index');
                Route::get('/{currency}', 'CurrencyController@show')->name('show');
            });


        Route::prefix('recipients')
            ->name('recipients.')
            ->middleware(['auth:api', 'verified'])
            ->group(function() {
                Route::get('/', 'RecipientController@index')->name('index');
                Route::post('/', 'RecipientController@store')->name('store');
                Route::get('/{recipient}', 'RecipientController@show')->name('show');
                Route::put('/{recipient}', 'RecipientController@update')->name('update');
                // Route::delete('/{recipient}', 'RecipientController@destroy')->name('destroy');
            });

        Route::prefix('/exchange-rate')
            ->group(function(){
                Route::get('/{symbol}', 'ExchangerateController@show');
            });


        Route::prefix('orders')
            ->name('orders.')
            ->middleware(['auth:api', 'verified'])
            ->group(function() {
                Route::get('/', 'OrderController@index')->name('index');
                Route::post('/', 'OrderController@store')->name('store');
                Route::get('/{order}', 'OrderController@show')->name('show');
                Route::post('/{order}/attach-recipient', 'OrderController@attachRecipient')->name('attachRecipient');
                Route::post('/{order}/detach-recipient', 'OrderController@detachRecipient')->name('detachRecipient');
                Route::post('/{order}/fill', 'OrderController@fillOrder')->name('fillOrder');
            });

        Route::prefix('payments')
            ->name('payments.')
            ->middleware((['auth:api', 'verified']))
            ->group(function() {
                Route::get('/', 'PaymentController@index')->name('index');
                Route::post('/', 'PaymentController@store')->name('store');
                Route::post('/app', 'PaymentController@store')->name('storeApp');
                Route::get('/{payment}', 'PaymentController@show')->name('show');
            });

        Route::prefix('accounts')
            ->name('accounts.')
            ->middleware(['auth:api'])
            ->group(function() {
                Route::get('/', 'AccountController@index')->name('index');
                Route::get('/{account}', 'AccountController@show')->name('show');
            });
    });

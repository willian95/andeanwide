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

use App\Http\Controllers\ApiController;

Route::get('rate/{base}/{quote}', 'ExchangeRateController@getRate');

// Rutas Web
Route::get('/', 'HomeController@index')->name('home');
Route::get('/nosotros', 'HomeController@nosotros')->name('nosotros');
Route::get('/terminosycondiciones', 'HomeController@terminosycondiciones')->name('terminosycondiciones');
Route::get('/contacto', 'HomeController@contacto')->name('contacto');
Route::get('/faqs', 'HomeController@faqs')->name('faqs');
Route::get('/privacidad', 'HomeController@privacidad')->name('privacidad');
Route::get('/product', 'HomeController@product')->name('product');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/post', 'HomeController@post')->name('post');
Route::get('/cart', 'HomeController@cart')->name('cart');
Route::get('/checkout', 'HomeController@checkout')->name('checkout');

Route::post('/send-contact-mail', 'HomeController@mailContact')->name('mailContact');

Route::get('/test', 'ExchangeRateController@test');


Route::prefix('panel')
    ->name('panel.')
    ->middleware(['verified', 'auth'])
    ->group(function(){
        Route::get('/panel', 'PanelController@index')->name('index');
        Route::get('como_funciona', 'PanelController@howItWork')->name('how_it_work');
    });


/**
 * User routes
 */
Route::namespace('User')
    ->prefix('panel/user')
    ->middleware(['verified', 'auth'])
    ->name('panel.user.')
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('/verify', 'UserController@verify')->name('verify');
        Route::post('/create/identity', 'UserController@createIdentity')->name('create_identity');
        Route::post('/create/address', 'UserController@createAddress')->name('create_address');

    Route::prefix('orders')
        ->name('order.')
        ->middleware(['userTier1'])
        ->group(function() {
            Route::get('/', 'OrderController@index')->name('index');
            Route::post('/', 'OrderController@store')->name('store');
            Route::get('/create', 'OrderController@create')->name('create');
            Route::get('/{order}', 'OrderController@show')->name('show');
            Route::delete('/{order}', 'OrderController@destroy')->name('destroy');
            Route::post('/{order}/add-recipient', 'OrderController@addRecipient')->name('add_recipient');
            Route::post('/{order}/fill-order', 'OrderController@fillOrder')->name('fill_order');
        });

    Route::prefix('payments')
        ->name('payment.')
        ->middleware(['userTier1'])
        ->group(function() {
            Route::get('/', 'PaymentController@index')->name('index');
            Route::post('/', 'PaymentController@store')->name('store');
            // Route::get('/{order}/create', 'PaymentController@create')->name('create');
            // Route::get('/select', 'PaymentController@select')->name('select');
        });

    Route::prefix('recipients')
        ->name('recipient.')
        ->middleware(['userTier1'])
        ->group(function(){
            Route::get('/', 'RecipientController@index')->name('index');
            Route::post('/', 'RecipientController@store')->name('store');
        });

    Route::prefix('support')
        ->middleware(['auth'])
        ->name('support.')
        ->group(function(){
            Route::get('/', 'SupportController@index')->name('index');
            Route::post('/', 'SupportController@store')->name('store');
            Route::get('/create', 'SupportController@create')->name('create');
            Route::get('/{ticket}', 'SupportController@show')->name('show');
        });
});

/**
 * Admin routes
 */
Route::namespace('Admin')
    ->prefix('panel/admin')
    ->middleware(['auth', 'admin'])
    ->name('panel.admin.')
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::get('/reports', 'DashboardController@reports')->name('reports');

        Route::prefix('users')
            ->name('users.')
            ->group(function(){
                Route::get('/', 'UserController@index')->name('index');
                Route::get('/{id}', 'UserController@show')->name('show');
                Route::post('validate/identity', 'UserController@validateIdentity')->name('validate_identity');
                Route::post('unvalidate/identity', 'UserController@unvalidateIdentity')->name('unvalidate_identity');
                Route::post('validate/address', 'UserController@validateAddress')->name('validate_address');
                Route::post('unvalidate/address', 'UserController@unvalidateAddress')->name('unvalidate_address');
            });

        Route::prefix('agents')
            ->name('agents.')
            ->group(function(){
                Route::get('/', 'AgentController@index')->name('index');
                Route::get('/create', 'AgentController@create')->name('create');
                Route::post('/', 'AgentController@store')->name('store');
                // Route::get('/invite', 'AgentController@invite')->name('invite');
                // Route::post('/invite', 'AgentController@send')->name('send');
            });

        Route::prefix('invitations')
            ->name('invitations.')
            ->group(function(){
                Route::get('/', 'InvitationController@index')->name('index');
                Route::post('/', 'InvitationController@store')->name('store');
                Route::get('/create', 'InvitationController@create')->name('create');
                Route::get('/{invitation}', 'InvitationController@show')->name('show');
            });

        // Orders
        Route::prefix('orders')
            ->name('orders.')
            ->group(function(){
                Route::get('/', 'OrderController@index')->name('index');
                Route::get('/new_orders', 'OrderController@indexNew')->name('index_new');
                Route::get('/unconfirmed_orders', 'OrderController@indexUnconfirmed')->name('index_unconfirmed');
                Route::get('/confirmed_orders', 'OrderController@indexConfirmed')->name('index_confirmed');
                Route::get('/{order}', 'OrderController@show')->name('show');
                Route::post('/{order}/verify', 'OrderController@verify')->name('verify_order');
                Route::post('/{order}/complete', 'OrderController@complete')->name('complete_order');
                Route::post('/{order}/reject', 'OrderController@reject')->name('reject_order');
            });

        // Symbols
        Route::prefix('symbols')
            ->name('symbols.')
            ->group(function(){
                Route::get('/', 'SymbolController@index')->name('index');
                Route::get('/create', 'SymbolController@create')->name('create');
                Route::post('/', 'SymbolController@store')->name('store');
                Route::get('/{symbol}', 'SymbolController@show')->name('show');
                Route::put('/{symbol}', 'SymbolController@update')->name('update'); // ajax
                Route::delete('/{symbol}', 'SymbolController@destroy')->name('destroy');
            });

        Route::prefix('currencies')
            ->name('currencies.')
            ->group(function(){
                Route::get('/', 'CurrencyController@index')->name('index');
                Route::get('/create', 'CurrencyController@create')->name('create');
                Route::post('/', 'CurrencyController@store')->name('store');
                Route::get('/{currency}', 'CurrencyController@show')->name('show');
                Route::get('/{currency}/edit', 'CurrencyController@edit')->name('edit');
                Route::put('/{currency}', 'CurrencyController@update')->name('update');
                Route::delete('/{currency}', 'CurrencyController@destroy')->name('destroy');
            });

        Route::prefix('accounts')
            ->name('accounts.')
            ->group(function(){
                Route::get('/', 'AccountController@index')->name('index');
                Route::get('/create', 'AccountController@create')->name('create');
                Route::post('/', 'AccountController@store')->name('store');
                Route::get('/{account}', 'AccountController@show')->name('show');
                Route::get('/{account}/edit', 'AccountController@edit')->name('edit');
                Route::put('/{account}', 'AccountController@update')->name('update');
                Route::delete('/{account}', 'AccountController@destroy')->name('destroy');
            });

        Route::prefix('config')
            ->name('config.')
            ->group(function() {
                Route::get('/', 'ConfigController@index')->name('index');
                Route::put('/', 'ConfigController@update')->name('update');
                Route::post('/priority', 'ConfigController@storePriority')->name('storePriority');
                Route::put('/priority/{priority}', 'ConfigController@updatePriority')->name('updatePriority');
                Route::delete('/priority/{priority}', 'ConfigController@destroyPriority')->name('destroyPriority');
            });

        Route::prefix('support')
            ->name('support.')
            ->group(function() {
                Route::get('/', 'SupportController@index')->name('index');
                Route::get('/{ticket}', 'SupportController@show')->name('show');
                Route::put('/{ticket}', 'SupportController@update')->name('update');
            });
    });

/**
 * Agent routes
 */
route::namespace('Agent')
    ->prefix('panel/agent')
    ->middleware(['auth', 'agent'])
    ->name('panel.agent.')
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('dashboard');
    });

Route::prefix('/exchange_rate')
    ->middleware(['auth'])
    ->name('exchange_rate.')
    ->group(function(){
        Route::get('/', 'ExchangeRateController@index')->name('index');
        Route::post('/{base}/{quote}', 'ExchangeRateController@getRate')->name('get_rate');
        Route::post('/{base}/{quote}/test', 'ExchangeRateController@testSymbol')->name('test_symbol');
    });

// Route::prefix('panel/support')
//     ->middleware(['auth'])
//     ->name('panel.support.')
//     ->group(function(){
//         Route::get('/', 'SupportController@index')->name('index');
//         Route::post('/', 'SupportController@store')->name('store');
//         Route::get('/create', 'SupportController@create')->name('create');
//         Route::get('/{ticket}', 'SupportController@show')->name('show');
//     });

Auth::routes(['verify' => true]);
// panel ****
// Route::namespace('Panel')->prefix('panel')->name('panel.')->middleware('verified')->middleware('auth')->group(function () {
//     // admin ****
//     Route::get('/', 'AdminController@index')->name('index')->middleware('verified');
//     Route::get('/ordenes', 'AdminController@ordenes')->name('ordenes');
//     Route::get('/historialordenes', 'AdminController@historialordenes')->name('historialordenes');
//     Route::get('/ordendeposito', 'AdminController@ordendeposito')->name('ordendeposito');
//     Route::get('/sendremesa', 'AdminController@sendremesa')->name('sendremesa');

//     Route::get('/crearemesa', 'AdminController@crearemesa')->name('crearemesa');
//     Route::post('/crearemesa', 'AdminController@createRemesa')->name('create_remesa');
//     Route::post('/agregar-beneficiario-a-remesa', 'AdminController@addRecipientRemesa')->name('add_recipient_remesa');
//     Route::post('/crear-beneficiario', 'AdminController@createRecipient')->name('create_recipient');
//     Route::post('/completar-remesa', 'AdminController@completeRemesa')->name('complete_remesa');
//     Route::post('/send-payment', 'AdminController@sendPayment')->name('send_payment');

//     Route::get('/historialremesas', 'AdminController@historialremesas')->name('historialremesas');

//     Route::get('/ordenenvio', 'AdminController@ordenenvio')->name('ordenenvio');
//     Route::get('/ordenesnuevas', 'AdminController@ordenesnuevas')->name('ordenesnuevas');
//     Route::get('/tasacambio', 'AdminController@tasacambio')->name('tasacambio');
//     Route::post('/tasacambio', 'AdminController@tasacambioPost')->name('tasacambio.post');
//     Route::get('/reportes', 'AdminController@reportes')->name('reportes');
//     Route::get('/veragentes', 'AdminController@veragentes')->name('veragentes');
//     Route::get('/crearagente', 'AdminController@crearagente')->name('crearagente');
//     Route::post('/crearagente', 'AdminController@crearAgentePost')->name('crearagente.post');
//     Route::get('/editaragente', 'AdminController@editaragente')->name('editaragente');
//     Route::get('/usuario', 'AdminController@usuario')->name('usuario');
//     Route::get('/usuario/{id}/editar', 'AdminController@editarusuario')->name('editarusuario');
//     Route::get('/preguntas', 'AdminController@preguntas')->name('preguntas');
//     Route::get('/terminos', 'AdminController@terminos')->name('terminos');
//     Route::get('/politicas', 'AdminController@politicas')->name('politicas');
//     Route::get('/comofunciona', 'AdminController@comofunciona')->name('comofunciona');

//     Route::get('/verifica', 'AdminController@verifica')->name('verifica');
//     Route::post('/create/identity', 'AdminController@createIdentity')->name('createidentity');
//     Route::post('/create/address', 'AdminController@createAddress')->name('createaddress');
//     Route::post('validate/identity', 'AdminController@validateIdentity')->name('validate_identity');
//     Route::post('unvalidate/identity', 'AdminController@unvalidateIdentity')->name('unvalidate_identity');
//     Route::post('validate/address', 'AdminController@validateAddress')->name('validate_address');
//     Route::post('unvalidate/address', 'AdminController@unvalidateAddress')->name('unvalidate_address');

//     Route::prefix('usuario')->name('usuario.')->group(function () {
//         // usuario
//         Route::get('/balances', 'UserController@balances')->name('balances');
//         Route::get('/historialremesas', 'UserController@historialremesas')->name('historialremesas');
//         Route::get('/historialdepositos', 'UserController@historialdepositos')->name('historialdepositos');
//         Route::get('/perfil', 'UserController@perfil')->name('perfil');
//         Route::get('/ingresar', 'UserController@ingresar')->name('ingresar');
//         Route::get('/destinatarios', 'UserController@destinatarios')->name('destinatarios');
//         Route::get('/enviardinero', 'UserController@enviardinero')->name('enviardinero');

//         Route::get('/faq', 'UserController@faq')->name('faq');
//     });
// });


// Route::get('calculadoraAjax', 'HomeController@calculadoraAjax')->name('calculadora.ajax');
// Route::get('getTasaDias2', 'HomeController@getTasaDias2')->name('getTasaDias2.ajax');

// Route::get('/home', 'HomeController@index')->name('home');

<?php

//Rutas autenticación usuario
Auth::routes();

/*
|--------------------------------------------------------------------------
| Rutas traducidas
|--------------------------------------------------------------------------
 */
Route::group(['prefix' => LL::setLocale(), 'middleware' => ['localizationRedirect', 'web' , 'xss']], function () {
    Route::get('/', 'FrontController@home')->name('home');    
    Route::get(LL::transRoute('routes.our_company'), 'FrontController@our_company')->name('our_company');
    Route::get(LL::transRoute('routes.our_history'), 'FrontController@our_history')->name('our_history');
    Route::get(LL::transRoute('routes.articles'), 'FrontController@articles')->name('articles');
    Route::get(LL::transRoute('routes.article'), 'FrontController@article')->name('article');
    Route::get(LL::transRoute('routes.contact'), 'FrontController@contact')->name('contact');
    Route::post(LL::transRoute('routes.contact'), 'FrontController@contact')->name('contact');
    Route::get(LL::transRoute('routes.questions'), 'FrontController@questions')->name('questions');
    Route::get(LL::transRoute('routes.agencies'), 'FrontController@agencies')->name('agencies');
    Route::get(LL::transRoute('routes.pdfs'), 'FrontController@pdfs')->name('pdfs');
    Route::get(LL::transRoute('routes.responsability'), 'FrontController@responsability')->name('responsability');
    Route::get(LL::transRoute('routes.general_content'), 'FrontController@general_content')->name('general_content');
    Route::get(LL::transRoute('routes.pdfs'), 'FrontController@pdfs')->name('pdfs');
    Route::get('/send-newsletter', 'FrontController@send_newsletter')->name('sendnewsletter');
    Route::get('/saving-exportar-excel', 'SavingSimulatorController@export_excel')->name('saving.export_excel');
    Route::get('/saving-exportar-pdf', 'SavingSimulatorController@export_pdf')->name('saving.export_pdf');
    Route::get('/credit-exportar-excel', 'CreditSimulatorController@export_excel')->name('credit.export_excel');
    Route::get('/credit-exportar-pdf', 'CreditSimulatorController@export_pdf')->name('credit.export_pdf');

    /*
|--------------------------------------------------------------------------
| Rutas Cuenta de usuario
|--------------------------------------------------------------------------
*/

Route::get('/login', 'AccountController@login')->name('login');
Route::get('/crear-cuenta', 'AccountController@register')->name('account.register');    
Route::get('recuperar-contrasena', 'AccountController@forgot_password')->name('account.forgot_password');
    Route::group(['prefix' => 'mi-cuenta', 'middleware' => ['auth']], function () {
        Route::get('/perfil', 'AccountController@home')->name('account.home');
        Route::get('/pedidos', 'AccountController@orders')->name('account.orders');
        Route::get('cambiar-contrasena', 'AccountController@change_password')->name('account.change_password');
        Route::get('orden/{reference}', 'AccountController@order_items')->name('account.order_items');
    });
});

// Rutas de la tienda
Route::group(['namespace' => 'Shop'], function (){
    Route::group(['prefix' => LL::setLocale(), 'middleware' => ['localizationRedirect', 'web' , 'xss']], function () {
        Route::group(['middleware' => 'role:Customer,web'], function () {
            Route::get('productos', 'ProductController@list')->name('products.list');
            Route::get('productos/{linea}', 'ProductController@list')->name('products.list.linea');
            Route::get('productos/{linea}/{cat}', 'ProductController@list')->name('products.list.cat');
            Route::get('productos/{linea}/{cat}/{subcat}', 'ProductController@list')->name('products.list.subcat');
            Route::get('mis-favoritos', 'ProductController@favorites')->name('product.favorites');
            Route::get('producto/{codigo}', 'ProductController@view')->name('product.view');
            Route::get('test', 'ProductController@test');
        });
    });
});

//AJAX en API
Route::group(['prefix' => 'ajax', 'namespace' => 'Api'], function () {
    Route::get('cities/{dep}', 'AjaxController@cities');
    Route::post('add-to-favorite', 'FavoriteController@add_favorite');
    Route::post('remove-to-favorite', 'FavoriteController@remove_favorite');

});

// AJAX Controller AccountController
Route::group(['prefix' => 'ajax'], function () {
    Route::post('create-account', 'AccountController@create_account');
    Route::post('login', 'Auth\CustomerLoginController@login');
    Route::delete('delete-address/{id}', 'AccountController@delete_address');
    Route::post('update-account', 'AccountController@update_account');
    Route::post('update-address', 'AccountController@update_address');
    Route::post('create-address', 'AccountController@create_address');
    Route::post('change-password', 'AccountController@ax_change_password');
    Route::post('forgot-password', 'AccountController@ax_forgot_password');
    Route::post('order-item', 'AccountController@order_item');
    Route::post('create-review', 'AccountController@create_review');
    Route::post('create-devolution', 'AccountController@create_devolution');
});





//Login redes sociales
Route::get('login/{socialNetwork}', 'SocialLoginController@socialNetwork')->name('login.social')->middleware('guest');
Route::get('login/{socialNetwork}/callback', 'SocialLoginController@handleCallback')->middleware('guest');
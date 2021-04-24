<?php

//Rutas autenticación usuario
Auth::routes();


Route::group(['prefix' => LL::setLocale(), 'middleware' => ['localizationRedirect', 'web' , 'xss']], function () {
    Route::get('/', 'FrontController@home')->name('home');    
    Route::get('/login', 'FrontController@home')->name('home');    
});
//AJAX en API
Route::group(['prefix' => 'ajax', 'namespace' => 'Api'], function () {    
    Route::post('get-apilist', 'AjaxController@get_apilist'); 
});


// AJAX Controller AccountController
Route::group(['prefix' => 'ajax'], function () {
	 	Route::post('login', 'Auth\CustomerLoginController@login')->name('login');
    Route::post('create-account', 'AccountController@create_account')->name('create_account');
    Route::post('update-account', 'AccountController@update_account');
    Route::post('get-user', 'AccountController@get_user');
    Route::post('add-favorite', 'AccountController@add_favorite');
    Route::delete('delete-favorite/{id}', 'AccountController@delete_favorite');    
});




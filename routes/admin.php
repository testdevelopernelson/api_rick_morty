<?php

/*

|--------------------------------------------------------------------------

| Panel Administrativo

|--------------------------------------------------------------------------

 */

Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login')->middleware('checkip');
Route::get('/access-denied', 'Auth\AdminLoginController@admin_errors')->name('admin.ip.not.valid');
Route::post('/', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');



Route::group(['middleware' => ['admin'], 'namespace' => 'Admin'], function () {
      //Rutas para Usuarios Administradores
      Route::group(['middleware' => 'role:Admin,admin'], function () {
        Route::resource('home', 'HomeController');
        Route::resource('sections', 'SectionController');
        Route::resource('contents', 'ContentController');
        Route::resource('slider', 'SliderController');
        Route::resource('article', 'ArticleController');
        Route::resource('admins', 'AdminController');
        Route::resource('translation', 'TranslationController');
        Route::resource('translationelement', 'TranslationElementController');


        Route::resource('categories', 'CategoryController');
        Route::post('categories-manage', 'CategoryController@manage')->name('categories.manage');
        Route::get('featured/{id}', 'CategoryController@featured')->name('category.featured');
        Route::resource('attribute', 'AttributeController');
        Route::get('attribute-options/{id}', 'AttributeController@options')->name('attribute.options');
        Route::resource('product', 'ProductController');
        Route::resource('coupon', 'CouponController');

        Route::get('fields/{c}/{s}', 'ContentController@fields')->name('contents.fields');
        Route::put('fields', 'ContentController@save_fields')->name('contents.save.fields');
        Route::get('settings', 'SettingsController@index')->name('settings');
        Route::put('settings', 'SettingsController@update')->name('settings_update');
        Route::get('perfil/{id}', 'AdminController@profile')->name('admins.profile');
        Route::post('perfil/{id}', 'AdminController@profile')->name('admins.profile');
        Route::get('cambiar-password/{id}', 'AdminController@change_password')->name('admins.change_password');
        Route::post('cambiar-password/{id}', 'AdminController@change_password')->name('admins.change_password');
      });

      // Rutas para Usuarios Tienda
      Route::group(['middleware' => 'role:AdminStore,admin'], function () {         
        // Route::resource('admins', 'AdminController');
      });

      // Rutas para Usuarios Bodegas
      Route::group(['middleware' => 'role:AdminWhorehouse,admin'], function () {
         
      });      

    Route::resource('users', 'UserController');

  
    Route::get('parameters', 'SimulatorParameterController@index')->name('parameters');
    Route::put('parameters', 'SimulatorParameterController@update')->name('parameters_update');
    Route::get('featured-responsability/{id}', 'ResponsabilityController@featured')->name('responsability.featured');  
    Route::get('superfeatured-product/{id}', 'ProductController@super_featured')->name('product.superfeatured');
    Route::get('delete-pdf/{id}', 'ContentController@delete_pdf')->name('contents.delete_pdf');
    
    Route::get('export-contact', 'FormContactController@export')->name('formcontact.export');
    Route::get('export-newsletter', 'FormNewsletterController@export')->name('formnewsletter.export');

/*routes_crudy*/



     Route::group(['prefix' => 'ajax'], function () {
       // Publicar y despublicar contenido
          Route::post('active-admin', 'AdminController@active')->name('admins.active');
          Route::post('published-article', 'ArticleController@published')->name('article.published');
          Route::post('published-slider', 'SliderController@published')->name('slider.published');
          Route::post('published-coupon', 'CouponController@status')->name('coupon.published');
          Route::post('published-product', 'ProductController@published')->name('product.published');
          Route::post('/update-category-position', 'CategoryController@update_position');

          Route::post('active-ip', 'IpController@actived')->name('ips.actived');

          Route::post('/order_slider', 'SliderController@order')->name('slider.order'); 
          Route::post('/order_attribute', 'AttributeController@order')->name('attribute.order'); 
          Route::post('/order_product', 'ProductController@order')->name('product.order'); 
       

          Route::post('/delete-image-corporate', 'CorporateController@delete_image');
          Route::post('/delete-image-credit', 'CreditController@delete_image');
          Route::post('/delete-image-saving', 'SavingController@delete_image');
          Route::post('/update-interest-saving', 'SimulatorSavingController@update_interest');
          Route::post('/update-interest-credit', 'SimulatorCreditController@update_interest');
          
          Route::post('show-section', 'SectionController@show')->name('sections.show');
          Route::get('search-customer', 'CouponController@customer');

     });

    Route::group(['prefix' => 'lfmanager', 'middleware' => ['admin']], function () {

     \UniSharp\LaravelFilemanager\Lfm::routes();

   });

});
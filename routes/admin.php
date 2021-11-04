<?php

use Illuminate\Support\Facades\Route;


const PAGINATION_COUNT = 5;

Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {

    Route::get('/', 'DashboardController@index')->name('admin.home');

    ################### Begin Languages Routes #############################
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/', 'languagesController@index')->name('admin.languages');

        Route::get('create', 'languagesController@create')->name('admin.languages.create');
        Route::post('save', 'languagesController@save')->name('admin.languages.save');

        Route::get('edit/{id}', 'languagesController@edit')->name('admin.languages.edit');
        Route::post('update/{id}', 'languagesController@update')->name('admin.languages.update');
        Route::get('delete/{id}', 'languagesController@delete')->name('admin.languages.delete');
    });
    ################### End Languages Routes #############################

    ################### Begin Main Categories Routes #############################
    Route::group(['prefix' => 'mainCategories'], function () {
        Route::get('/', 'MainCategoriesController@index')->name('admin.mainCategories');

        Route::get('create', 'MainCategoriesController@create')->name('admin.mainCategories.create');
        Route::post('save', 'MainCategoriesController@save')->name('admin.mainCategories.save');

        Route::get('edit/{id}', 'MainCategoriesController@edit')->name('admin.mainCategories.edit');
        Route::post('update/{id}', 'MainCategoriesController@update')->name('admin.mainCategories.update');
        Route::get('delete/{id}', 'MainCategoriesController@delete')->name('admin.mainCategories.delete');
        Route::get('changeStatus/{id}', 'MainCategoriesController@changeStatus')->name('admin.mainCategories.changeStatus');
    });
    ################### End Main Categories Routes #############################

    ################### Begin  Vendors Routes #############################
    Route::group(['prefix' => 'vendors'], function () {
        Route::get('/', 'VendorsController@index')->name('admin.vendors');

        Route::get('create', 'VendorsController@create')->name('admin.vendors.create');
        Route::post('save', 'VendorsController@save')->name('admin.vendors.save');

        Route::get('edit/{id}', 'VendorsController@edit')->name('admin.vendors.edit');
        Route::post('update/{id}', 'VendorsController@update')->name('admin.vendors.update');
        Route::get('delete/{id}', 'VendorsController@delete')->name('admin.vendors.delete');
        Route::get('changeStatus/{id}', 'VendorsController@changeStatus')->name('admin.vendors.changeStatus');
    });
    ################### End  Vendors Routes #############################

    ################### Begin  subCategories Routes #############################
    Route::group(['prefix' => 'subCategories'], function () {
        Route::get('/', 'VendorsController@index')->name('admin.subCategories');

        Route::get('create', 'VendorsController@create')->name('admin.subCategories.create');
        Route::post('save', 'VendorsController@save')->name('admin.subCategories.save');

        Route::get('edit/{id}', 'VendorsController@edit')->name('admin.subCategories.edit');
        Route::post('update/{id}', 'VendorsController@update')->name('admin.subCategories.update');
        Route::get('delete/{id}', 'VendorsController@delete')->name('admin.subCategories.delete');
        Route::get('changeStatus/{id}', 'VendorsController@changeStatus')->name('admin.subCategories.changeStatus');
    });
    ################### End  subCategories Routes #############################


});


Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'LoginCOntroller@getLogin')->name('get.admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login');
});


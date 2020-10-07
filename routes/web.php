<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Frontend'], function() {
    Route::get('/','IndexController@getIndex');
    Route::post('search','IndexController@search')->name('search');
    Route::get('san-pham/{slug}','IndexController@details');
    Route::get('/san-pham','IndexController@product');
    Route::get('/danh-muc/{slug}','IndexController@category');
    Route::get('/chinh-sach','IndexController@policy');
    Route::group(['prefix'=>'cart'],function (){
        Route::get('add/{id}','CartController@getAddCart');
        Route::get('show','CartController@getShow');
        Route::post('delete/{id}','CartController@getDelete');
        Route::get('update','CartController@getUpdate');
        Route::get('cart-done','CartController@getCheckout');
        Route::post('cart-done','CartController@postCheckout');
        Route::get('succsess','CartController@getSusscess');
    });
    Route::resource('blog','BlogController');
    Route::get('blog/bai-viet/{slug}','BlogController@details');
    Route::get('lien-he','IndexController@contact');
    Route::post('lien-he','IndexController@mailContact');
});

Route::group(['prefix'=>'admin','namespace' => 'Backend'], function() {
    Route::group(['middleware' => 'auth'],function(){
        Route::resource('dashboard','DashboardController');
        Route::resource('user','UserController');
        Route::resource('permission','PermissionController');
        Route::resource('role','RoleController');
        Route::get('categories/destroy/{id}','CategoriesController@destroy')->name('delete_category');
        Route::resource('categories','CategoriesController');
        Route::resource('new','NewController');
        Route::post('new/search', 'NewController@Search')->name('search');
        Route::post('new/search/searchform','NewController@getSearch');
        Route::resource('language','LanguageNationController');
        Route::resource('key','LanguageKeyController');
        Route::resource('translate','TranslateController');
        Route::resource('product','ProductsController');
        Route::resource('bill', 'BillController');
        Route::resource('contribute', 'ContributeController');
        Route::post('product/search','ProductsController@getSearch');
//        Route::resource('test','TestLanguageController');
        Route::get('/{id}','RequestLanguageController@index')->name('locale.index');
        Route::post('translate/export/', 'TranslateController@export')->name('translate.export');
        Route::post('translate/import/', 'TranslateController@import')->name('translate.import');
//        Route::resource('locale','RequestLanguageController');
    });
});

Auth::routes();


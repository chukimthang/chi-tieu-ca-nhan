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
Route::get('/', ['as' => 'login', 'uses' => 'HomeController@index']);

Route::group(['middleware' => 'auth'], function() {

    Route::group(['prefix' => 'category', 'as' => 'category.'], function() {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'CategoryController@index'
        ]);

        Route::post('addAjax', [
            'as' => 'addAjax',
            'uses' => 'CategoryController@postAddAjax'
        ]);

        Route::post('updateAjax', [
            'as' => 'updateAjax',
            'uses' => 'CategoryController@postUpdateAjax'
        ]);

        Route::post('deleteAjax', [
            'as' => 'deleteAjax',
            'uses' => 'CategoryController@postDeleteAjax'
        ]);
    });

    Route::group(['prefix' => 'expense', 'as' => 'expense.'], function() {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'ExpenseController@index'
        ]);

        Route::post('addAjax', [
            'as' => 'addAjax',
            'uses' => 'ExpenseController@postAddAjax'
        ]);

        Route::post('updateAjax', [
            'as' => 'updateAjax',
            'uses' => 'ExpenseController@postUpdateAjax'
        ]);

        Route::post('deleteAjax', [
            'as' => 'deleteAjax',
            'uses' => 'ExpenseController@postDeleteAjax'
        ]);

        Route::post('filterCategory', [
            'as' => 'filterCategory',
            'uses' => 'ExpenseController@postFilterCategory'
        ]);

        Route::post('filterCategoryDate', [
            'as' => 'filterCategoryDate',
            'uses' => 'ExpenseController@postFilterCategoryDate'
        ]);
    });

    Route::group(['prefix' => 'collect', 'as' => 'collect.'], function() {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'CollectController@index'
        ]);

        Route::post('addAjax', [
            'as' => 'addAjax',
            'uses' => 'CollectController@postAddAjax'
        ]);

        Route::post('deleteAjax', [
            'as' => 'deleteAjax',
            'uses' => 'CollectController@postDeleteAjax'
        ]);

        Route::post('filterDate', [
            'as' => 'filterDate',
            'uses' => 'CollectController@postFilterDate'
        ]);
    });

    Route::resource('chart', 'ChartController', ['only' => 'index']);

    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {

        Route::get('showProfile', [
            'as' => 'showProfile',
            'uses' => 'UserController@showProfile'
        ]);

        Route::get('editProfile', [
            'as' => 'editProfile',
            'uses' => 'UserController@getEditProfile'
        ]);

        Route::post('uploadAvatar', [
            'as' => 'uploadAvatar',
            'uses' => 'UserController@postUpdateAvatar'
        ]);

        Route::post('updateProfile', [
            'as' => 'updateProfile',
            'uses' => 'UserController@postUpdateProfile'
        ]);
    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin',
    'middleware' => 'admin'], function() {

    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
        Route::get('/', [
            'as' => 'index',
            'uses' => 'UserController@index'
        ]);

        Route::post('deleteAjax', [
            'as' => 'deleteAjax',
            'uses' => 'UserController@postDeleteAjax'
        ]);
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index');

<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes...
Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout')->name('logout');

Route::get('csrf', function () {
    return ["csrf" => csrf_token()];
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('dashboard', 'ShowDashboard')->name('dashboard');
    Route::resource('users', 'UserController');
    Route::resource('pages', 'PageController');
    Route::post('pages/{page}/restore', 'PageController@restore')->name('pages.restore');

    Route::resource('product-types', 'ProductTypeController');
    Route::resource('products', 'ProductController');
    Route::resource('forms', 'FormController');
    Route::resource('applications', 'ApplicationController');
    Route::resource('attentions', 'AttentionController');
    Route::get('offices/types', 'OfficeController@allTypes');
    Route::resource('offices', 'OfficeController');
    Route::resource('subways', 'SubwayController');

    if (env('APP_ENV') !== 'production') {
        Route::group(['prefix' => 'backups', 'as' => 'backups.'], function () {
            Route::get('', 'BackupController@index')->name('index');
            Route::get('create', 'BackupController@create')->name('create');
            Route::get('restore', 'BackupController@restore')->name('restore');
            Route::get('destroy', 'BackupController@destroy')->name('destroy');
            Route::post('upload', 'BackupController@upload')->name('upload');
            Route::get('download', 'BackupController@download')->name('download');
        });
    }

    Route::prefix('pages/{page}')->group(function () {
        Route::resource('variables', 'PageVariableController')->only(['index', 'show', 'store', 'update', 'destroy']);
        Route::group(['prefix' => 'variables/list', 'as' => 'list.'], function () {
            Route::post('', 'PageVariableController@storeList')->name('store');
            Route::put('sort', 'PageVariableController@updateSort');
            Route::put('{id}', 'PageVariableController@updateList')->name('update');
            Route::delete('{id}', 'PageVariableController@destroyList')->name('destroy');
        });
    });

    Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
        Route::get('', 'MediaController@index')->name('index');

        Route::post('upload', 'MediaController@upload')->name('upload');
        Route::delete('file', 'MediaController@deleteFile')->name('delete.file');
        Route::post('folder', 'MediaController@createFolder')->name('folder');
        Route::delete('folder', 'MediaController@deleteFolder')->name('delete.folder');

        Route::post('rename', 'MediaController@rename')->name('rename');
    });

    Route::post('upload/{type}', 'UploadFile')->name('admin.upload');
});

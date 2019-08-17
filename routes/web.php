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

Route::get('/', 'IndexController@index')->name('index');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::name('admin.')
        ->middleware('auth')
        ->namespace('Admin')
        ->prefix('admin')
        ->group(function () {
            Route::get('/', 'IndexController@index')->name('index');
            Route::get('/my', 'MyController@index')->name('my.index');
            Route::resource('my/password', 'PasswordController')->only([
                'index', 'store'
            ]);
        });
        
Route::get('test', function () {
    echo strtok('my', '/');
    phpinfo();
});
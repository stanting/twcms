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
            
            Route::name('my.')
                    ->prefix('my')
                    ->namespace('My')
                    ->group(function () {
                        Route::get('/index', 'MyController@index')->name('my.index');
                        Route::resource('password', 'PasswordController')->only([
                            'index', 'store'
                        ]);
                    });
                    
            Route::name('setting.')
                    ->prefix('setting')
                    ->namespace('Setting')
                    ->group(function () {
                        Route::resource('base', 'BaseController');
                        Route::resource('seo', 'SeoController');
                        Route::resource('link', 'LinkController');
                        Route::resource('upload', 'UploadController');
                        Route::resource('image', 'ImageController');
                    });
                    
            Route::name('category.')
                    ->prefix('category')
                    ->namespace('Category')
                    ->group(function () {
                        Route::resource('category', 'CategoryController');
                        Route::resource('navigate', 'NavigateController');
                    });
                    
            Route::name('content.')
                    ->prefix('content')
                    ->namespace('Content')
                    ->group(function () {
                        Route::resource('article', 'ArticleController');
                        Route::resource('product', 'ProductController');
                        Route::resource('comment', 'CommentController');
                        Route::resource('photo', 'PhotoController');
                        Route::resource('tag', 'TagController');
                    });
                    
            Route::name('plugin.')
                    ->prefix('plugin')
                    ->namespace('Plugin')
                    ->group(function () {
                        Route::resource('link', 'LinkController');
                    });
                    
            Route::name('tool.')
                    ->prefix('tool')
                    ->namespace('Tool')
                    ->group(function () {
                        Route::resource('cache', 'CacheController');
                        Route::resource('count', 'CountController');
                    });
            
        });
        
Route::get('test', function () {
    echo strtok('my', '/');
    phpinfo();
});
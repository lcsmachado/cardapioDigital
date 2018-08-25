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
Route::get('/resetPassword', 'AdminController@showViewResetPassword')->name('resetPass');
Route::post('/resetPasswordQuestions','AdminController@showViewResetPasswordQuestions')->name('resetQuestions');
Route::post('/{email}/confirmQuestions','AdminController@confirmQuestions')->name('confirmQuestions');
Route::post('/{email}/newPassword','AdminController@saveNewPassword')->name('newPassword');

Route::prefix('painel')->group(function () {
    Route::group([
        'prefix'     => 'admin',
        'middleware' => 'auth',
        'middleware' => 'admin'
     ],function () {
            Route::post('/store', 'AdminController@store')->name('storeAdmin');
            Route::get('/painelAdmin', 'AdminController@index')->name('indexAdmin');
            Route::get('/create', 'AdminController@create')->name('createAdmin');
            Route::get('/{id}/edit', 'AdminController@edit')->name('editAdmin');
            Route::put('/{id}/update', 'AdminController@update')->name('updateAdmin');
            Route::get('/{id}/restore', 'AdminController@restore')->name('restoreAdmin');
            Route::get('/trash','AdminController@trash')->name( 'trashAdmin');
            Route::get('/{id}/show', 'AdminController@show')->name('showAdmin');
            Route::get('/{id}/showRestore', 'AdminController@show')->name('showResAdmin');
            Route::get('/{id}/restore','AdminController@restore')->name('restoreAdmin');
            Route::delete('/{id}/delete', 'AdminController@destroy')->name('destroyAdmin');
    });    
    Route::group([
        'prefix'     => 'category',
        'middleware' => 'auth',
        'middleware' => 'admin'
     ],function () {
        Route::post('/create', 'CategoryController@store')->name('storeCategory');
        Route::get('/painelCategorias', 'CategoryController@index')->name('indexCategory');
        Route::get('/create', 'CategoryController@create')->name('createCategory');
        Route::get('/{id}/edit', 'CategoryController@edit')->name('editCategory');
        Route::put('/{id}/update', 'CategoryController@update')->name('updateCategory');
        Route::get('/{id}/restore', 'CategoryController@restore')->name('restoreCategory');
        Route::get('/trash','CategoryController@trash')->name( 'trashCategory');
        Route::get('/{id}/show', 'CategoryController@show')->name('showCategory');
        Route::get('/{id}/showRestore', 'CategoryController@show')->name('showResCategory');
        Route::get('/{id}/restore','CategoryController@restore')->name('restoreCategory');
        Route::delete('/{id}/delete', 'CategoryController@destroy')->name('destroyCategory');
    });
    Route::group([
        'prefix'     => 'product',
        'middleware' => 'auth',
        'middleware' => 'admin'
     ],function () {
        Route::post('/create', 'ProductController@store')->name('storeProduct');
        Route::get('/painelProdutos', 'ProductController@index')->name('indexProduct');
        Route::get('/create', 'ProductController@create')->name('createProduct');
        Route::get('/{id}/edit', 'ProductController@edit')->name('editProduct');
        Route::put('/{id}/update', 'ProductController@update')->name('updateProduct');
        Route::get('/{id}/restore', 'ProductController@restore')->name('restoreProduct');
        Route::get('/trash','ProductController@trash')->name( 'trashProduct');
        Route::get('/{id}/show', 'ProductController@show')->name('showProduct');
        Route::get('/{id}/showRes', 'ProductController@show')->name('showResProduct');
        Route::get('/{id}/restoreProduct','ProductController@restore')->name('restoreProduct');
        Route::delete('/{id}/delete', 'ProductController@destroy')->name('destroyProduct');
    });
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

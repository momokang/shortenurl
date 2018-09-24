<?php

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/u/{hashid}', 'HomeController@url')->name('url');

Route::group(['middleware' => 'auth'], function() {
    Route::post('/', 'HomeController@index')->name('home');
    Route::get('/hash/{hashId}', 'HomeController@hash')->name('hash');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/analytic/{hashId}', 'DashboardController@analytic')->name('analytic');
});

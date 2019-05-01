<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 21.04.2019
 * Time: 14:22
 */

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('fns')->group(function () {

	Route::post('registration','FnsAuthController@registration');
	Route::post('login','FnsAuthController@login');
    Route::post('remind','FnsAuthController@remind');

});

Route::resource('check', 'CheckController');
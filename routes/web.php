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

Route::get('/', 'Admin\ReportController@index')->name('admin.report');
Route::get('/search', 'Admin\ReportController@search')->name('admin.search');
Route::delete('/delete/{id}', 'Admin\ReportController@destroy')->name('admin.destroy');
Route::get('/edit/{id}', 'Admin\ReportController@edit')->name('admin.edit');
Route::put('/update/{id}', 'Admin\ReportController@update')->name('admin.update');
Route::post('/sendemail/send', 'Admin\SendEmailController@sendEmail')->name('admin.sendemail.send');



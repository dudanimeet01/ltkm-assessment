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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'FileController@index')->name('home');
    Route::post('/get-the-count', 'FileController@get_the_count')->name('get.the.count');

    Route::get('/all-file-list', 'FileController@all_file_list')->name('all.file.list');
    Route::get('/upload-file', 'FileController@upload_file')->name('upload.file.index');
    Route::post('/upload-file', 'FileController@store_upload_file')->name('upload.file.post');
    Route::get('/delete-file/{id}', 'FileController@delete_file')->name('delete.file');
});

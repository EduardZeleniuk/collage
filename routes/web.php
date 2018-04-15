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

Auth::routes();


Route::get('/',['as'=>'image.upload','uses'=>'ImageUploadController@imageUpload']);
Route::post('/',['as'=>'image.upload.post','uses'=>'ImageUploadController@imageUploadPost']);
Route::get('image-delete/{id}','ImageUploadController@imageDelete');
Route::get('image-delete-all','ImageUploadController@imageDeleteAll');
Route::get('create/{imgId}/{collage}/{position}','ImageUploadController@collageCreate');
Route::get('collage-save/{collageId}','ImageUploadController@collageSave');
Auth::routes();


//Route::get('/', 'HomeController@index');
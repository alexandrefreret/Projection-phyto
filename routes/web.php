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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/actualites', 'NewsController@index')->name('actualites');
Route::get('/contact', 'ContactController@index')->name('contact');
Route::get('/prestations', 'HomeController@index')->name('prestations');


Route::get('/product/choose', 'ProductController@choose')->name('choose_product');
Route::post('/product/list', 'ProductController@list')->name('list_product');
Route::post('/product/add', 'ProductController@add')->name('add_product');
Route::get('/step/add', 'StepController@add')->name('add_step');
Route::post('/step/save', 'StepController@save')->name('save_step');
// Route::view('/step/add', 'step.add')->name('add_step');

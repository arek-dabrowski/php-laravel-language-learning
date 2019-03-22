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

Route::get('/', 'PagesController@index');

Route::resource('category', 'CategoriesController');
Route::put('category/{category}/{type}','CategoriesController@hideCategory')->name('category.hide');
Route::resource('subcategory', 'SubcategoriesController', ['except' => 'create']);
Route::get('subcategory/{id}/create', 'SubcategoriesController@create')->name('subcategory.create');
Route::put('subcategory/{subcategory}/{type}','SubcategoriesController@hideCategory')->name('subcategory.hide');
Route::resource('set', 'SetsController', ['except' => 'create']);
Route::post('set/create', ['uses'=>'SetsController@create','as'=>'id'])->name('set.create');
Route::put('set/{category}/{type}','SetsController@hideCategory')->name('set.hide');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('adminpanel', 'AdminPanelsController', ['except' => ['create', 'store']]);
Route::resource('auth', 'AuthorizationsController', ['except' => ['create', 'edit', 'update']]);
Route::post('auth/create', ['uses'=>'AuthorizationsController@create','as'=>'id'])->name('auth.create');
Route::post('set/learn', ['uses'=>'LearnController@mode','as'=>'mode_id'])->name('mode');
Route::post('set/result', ['uses'=>'LearnController@result','as'=>'result'])->name('result');
Route::post('set/save', ['uses'=>'ResultsController@store','as'=>'store'])->name('store');
Route::get('/results', 'ResultsController@index');
Route::get('/results/{results}', 'ResultsController@show');

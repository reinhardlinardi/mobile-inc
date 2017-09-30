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

// Web-based request (return HTML)

Route::get('/', function() { return view('home'); })->name('home');
Route::get('/home', function() { return redirect('/'); });
Route::get('/manage/user', function() { return view('manage_user'); })->middleware('auth')->name('manage_user');
Route::get('/manage/confirmation', function() { return view('manage_confirmation'); })->middleware('auth')->name('manage_confirmation');
Route::get('/manage/promotion', function() { return view('manage_promotion'); })->middleware('auth')->name('manage_promotion');

Route::post('/manage/user','AccountController@add');
Route::post('/manage/promotion','PromotionController@send');
Route::post('/manage/confirmation','OrderController@send');

// API request (return JSON)

Route::post('/api/manage/user','AccountAPIController@add');
Route::post('/api/manage/promotion','PromotionAPIController@send');
Route::post('/api/manage/confirmation','OrderAPIController@send');
Route::post('/api/manage/order','OrderAPIController@order');

// Authentication routing

Auth::routes();
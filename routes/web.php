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

Route::post('/manage/user','AccountController@add')->middleware('auth');
Route::post('/manage/promotion','PromotionController@send')->middleware('auth');
Route::post('/manage/confirmation/mark','OrderController@mark')->middleware('auth')->name('mark_order');
Route::post('/manage/confirmation/send','OrderController@send')->middleware('auth')->name('send_confirmation');

// API request (return JSON)

Route::get('/api/trend','TrendAPIController@get');

Route::post('/api/manage/user','AccountAPIController@add');
Route::post('/api/manage/promotion/send','PromotionAPIController@send');
Route::post('/api/manage/promotion/delete','PromotionAPIController@delete');
Route::post('/api/manage/promotion/validate','PromotionAPIController@validate');
Route::post('/api/manage/confirmation','OrderAPIController@send');
Route::post('/api/manage/order/order','OrderAPIController@order');
Route::post('/api/manage/order/get','OrderAPIController@get');

// Authentication routing

Auth::routes();
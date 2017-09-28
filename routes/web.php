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

Route::get('/', function() { return view('home'); })->name('home');
Route::get('/home', function() { return redirect('/'); });
Route::get('/manage/user', function() { return view('manage_user'); })->middleware('auth')->name('manage_user');
Route::get('/manage/confirmation', function() { return view('manage_confirmation'); })->middleware('auth')->name('manage_confirmation');
Route::get('/manage/promotion', function() { return view('manage_promotion'); })->middleware('auth')->name('manage_promotion');

Auth::routes();
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
Route::get('/manage', function() { return view('manage'); })->middleware('auth')->name('manage');
Route::get('/logout', function() { return redirect('home'); })->middleware('auth')->name('logout');

Auth::routes();
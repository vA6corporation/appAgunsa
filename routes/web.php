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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('customers', 'CustomerController');
Route::resource('businesses', 'BusinessController');
Route::resource('jobs', 'JobController');

Route::get('sales/betweenDates/{startDate}/{endDate}/{business_id?}', 'SaleController@betweenDates');
Route::get('sales/salesExcel/{startDate}/{endDate}/{business_id?}', 'SaleController@salesExcel');
Route::resource('sales', 'SaleController');

Route::get('{any}', function () {
  return view('home');
})->where('any','.*');

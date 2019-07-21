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

Route::get('/', 'RegisterController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('user/register', 'RegisterController@index');
Route::post('user/register', 'RegisterController@userRegister');

//product_routes

Route::get('add/product/view','productController@addProductView');
Route::post('add/product/insert','productController@addProductInsert');
Route::get('delete/product/{product_id}','productController@deleteProduct');
Route::get('force/delete/product/{product_id}','productController@forceDeleteProduct');
Route::get('edit/product/{product_id}','productController@editProduct');
Route::get('restore/product/{product_id}','productController@restoreProduct');
Route::POST('edit/product/insert','productController@editProductInsert');

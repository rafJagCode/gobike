<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');
Route::post('addproduct', 'ProductsController@addProduct');
Route::get('products', 'ProductsController@getProducts');
Route::get('product/{id}', 'ProductsController@getProduct');
Route::post('reservations', 'ReservationsController@getReservations');
Route::post('makeReservation', 'ReservationsController@makeReservation');
Route::post('deleteReservation', 'ReservationsController@deleteReservation');

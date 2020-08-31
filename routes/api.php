<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$prefix = config('app.route_prefix') . '/v1';

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

Route::group(
    ['prefix' => $prefix, 'middleware' => ['web']],
    function (): void {
        Route::post('/cart', 'v1\CartController@create');
        Route::patch('/cart/{cart}', 'v1\CartController@addProduct');
        Route::get('/cart/{cart}', 'v1\CartController@cart');
        Route::delete('/product/{product}', 'v1\CartController@deleteProductFromCart');
    }
);

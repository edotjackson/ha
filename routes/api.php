<?php
//New Code .edj


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

// *** Businesses ***
Route::group(['prefix' => 'v0'], function () 
{
    Route::post('businesses', 'BusinessController@searchBusinesses');
    Route::put('businesses', 'BusinessController@addBusiness');
});
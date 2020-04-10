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

Route::post('login', 'UsersController@login');
Route::post('register', 'UsersController@register');

/*
 * Only admin can access these routes
 * */
Route::group([
    'prefix' => 'v1', 'middleware' => [
        'auth:api', 'role:admin'
    ]], function (){
    Route::apiResources([
        'admin' => 'AdminController'
    ]);
});

/*
 * All routes that accessible for both admin and users
 * */
Route::group([
    'prefix' => 'v1', 'middleware' => [
        'auth:api', 'role:admin,user'
    ]], function (){
    Route::get('detail', 'UsersController@detail');
    Route::apiResources([
        'users' => 'UsersController'
    ]);
});

/*
 * general routes can be accessed without authentication/roles
 * */
Route::get('/token', 'ApiController@createToken');
Route::get('/refill', 'ApiController@refill');

Route::fallback('FallbackController@page404');

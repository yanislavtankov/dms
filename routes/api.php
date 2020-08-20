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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('login', 'API\AuthController@login')->name('login');
Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'API\AuthController@logout');
    Route::get('/get-user', 'API\AuthController@getUser');
    Route::post('/fileUpload','API\FileController@fileUpload');
    Route::get('/companies','API\CompaniesController@listCompanies');
    Route::post('/company','API\CompaniesController@addCompany');
    Route::post('/company/{id}','API\CompaniesController@editCompany');
    Route::delete('/company/{id}','API\CompaniesController@deleteCompany');
    Route::get('/tags','API\TagsController@listTags');
    Route::get('/files/{id}','API\FileController@listFiles');
    Route::post('/file','API\FileController@addFile');
    Route::post('/file/{id}','API\FileController@editFile');
    Route::get('/file/{id}','API\FileController@getFile');
    Route::delete('/file/{id}','API\FileController@deleteFile');
    Route::post('/import','API\ImportController@importCsv');
});



// Route::group(['prefix' => '', 'middleware' => 'cors'], function () {
//     Route::post('/logout', 'API\AuthController@logout');
//     Route::get('/get-user', 'API\AuthController@getUser');
//     Route::post('/fileUpload','API\FileController@fileUpload');
//     Route::get('/companies','API\CompaniesController@listCompanies');
// });

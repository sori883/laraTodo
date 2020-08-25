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

// Auth::Routes();

// 認証
Route::prefix('user')->name('user.')->group(function () {
    Route::post('register', 'Auth\RegisterController@register')->name('register');
    Route::post('login', 'Auth\LoginController@login')->name('login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
});

// パスワードリセット
Route::prefix('password')->name('password.')->group(function () {
    Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('email');
    Route::post('update', 'Auth\ResetPasswordController@reset')->name('update');
});

// Projects
Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('index', 'ProjectController@index')->name('index');
    Route::post('store', 'ProjectController@store')->name('store');
    Route::patch('update/{id}', 'ProjectController@update')->name('update');
    Route::delete('destroy/{id}', 'ProjectController@destroy')->name('destroy');
});

Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::get('index', 'TaskController@index')->name('index');
    Route::get('project/{id}', 'TaskController@projectIndex')->name('project');
});

// TODO PHP7.4はアロー関数で書ける
Route::get('/user', function (){
    return Auth::user();
})->name('user');

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('user', 'App\Http\Controllers\UserController');
Route::resource('task', 'App\Http\Controllers\TaskController');

// Register
Route::post('/register', 'App\Http\Controllers\UserController@register');

// Login
Route::post('/login', 'App\Http\Controllers\UserController@login');

// Logout
Route::post('/logout', 'App\Http\Controllers\UserController@logout');

Route::get('/task/user/{email}', 'App\Http\Controllers\TaskController@get_user_task');

Route::post('/sharedTasks', 'App\Http\Controllers\TaskController@get_shared_task');

Route::get('/setSharedTask/{task}', 'App\Http\Controllers\TaskController@set_shared_task');

Route::get('/setUnSharedTask/{task}', 'App\Http\Controllers\TaskController@set_unshared_task');

Route::get('/setSharedTask/{task}', 'App\Http\Controllers\TaskController@set_shared_task');

Route::get('/setUnSharedTask/{task}', 'App\Http\Controllers\TaskController@set_unshared_task');

Route::get('/setDoneTask/{task}', 'App\Http\Controllers\TaskController@set_done_task');

Route::get('/setUnDoneTask/{task}', 'App\Http\Controllers\TaskController@set_undone_task');
<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LampiranController;
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

Route::get('/', [UserController::class, 'showCorrectHomepage']);

Route::get('/login', [UserController::class, 'showLoginPage'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');

Route::get('/users/create', [UserController::class, 'showCreateForm'])->middleware('mustBeLoggedIn');
Route::post('/users/create', [UserController::class, 'store'])->middleware('mustBeLoggedIn');
Route::get('/users', [UserController::class, 'getIndex'])->middleware('mustBeLoggedIn');
Route::get('/users/{id}/update', [UserController::class, 'showUpdateForm'])->middleware('mustBeLoggedIn');
Route::delete('/users/delete', [UserController::class, 'delete'])->middleware('mustBeLoggedIn');

Route::get('/lampiran', [LampiranController::class, 'showCreateForm'])->middleware('mustBeLoggedIn');
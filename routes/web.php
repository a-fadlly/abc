<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LampiranController;
use App\Http\Controllers\PdfController;

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
Route::delete('/users/delete', [UserController::class, 'delete'])->middleware('mustBeLoggedIn')->name('user.delete');

Route::get('/lampiran', [LampiranController::class, 'index'])->middleware('mustBeLoggedIn');
Route::get('/lampiran/create', [LampiranController::class, 'showCreateForm'])->middleware('mustBeLoggedIn');
Route::get('/lampiran/in_progress', [LampiranController::class, 'inProgress'])->middleware('mustBeLoggedIn');
Route::get('/lampiran/history', [LampiranController::class, 'history'])->middleware('mustBeLoggedIn');
Route::get('/lampiran/{lampiran_nu}/view', [LampiranController::class, 'view'])->middleware('mustBeLoggedIn');
Route::get('/lampiran/{lampiran_nu}/print', [PdfController::class, 'generatePdf']);
Route::get('/lampiran/requisition', [LampiranController::class, 'requisition']);
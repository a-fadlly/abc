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

Route::get('/', [UserController::class, 'homepage']);
Route::get('/login', [UserController::class, 'loginPage'])->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');

Route::get('/users/create', [UserController::class, 'showCreateForm'])->middleware('mustBeLoggedIn');
Route::get('/users', [UserController::class, 'getIndex'])->middleware('mustBeLoggedIn');
Route::get('/users/{id}/update', [UserController::class, 'showUpdateForm'])->middleware('mustBeLoggedIn');
Route::delete('/users/delete', [UserController::class, 'delete'])->middleware('mustBeLoggedIn')->name('user.delete');

Route::get('/lampiran', [LampiranController::class, 'index'])->middleware('mustBeLoggedIn');
Route::get('/lampiran/update', [LampiranController::class, 'showUpdateForm'])->middleware('mustBeLoggedIn');

Route::get('/lampiran/in_progress', [LampiranController::class, 'inProgress'])->middleware('mustBeLoggedIn');
Route::get('/lampiran/history', [LampiranController::class, 'history'])->middleware('mustBeLoggedIn');
// Route::get('/lampiran/{lampiran_nu}/view', [LampiranController::class, 'view'])->middleware('mustBeLoggedIn');
Route::get('/lampiran/{lampiran_nu}/print', [PdfController::class, 'generateLampiranPdf']);
Route::get('/lampiran/requisition', [LampiranController::class, 'requisition']);

Route::get('/lampiran/in_progress/{lampiran_nu}', [LampiranController::class, 'inProgressView'])->middleware('mustBeLoggedIn');

Route::get('/lampiran/history/{lampiran_nu}', [LampiranController::class, 'historyView'])->middleware('mustBeLoggedIn');

Route::get('/lampiran/requisition/{lampiran_nu}', [LampiranController::class, 'approvalView'])->middleware('mustBeLoggedIn');

Route::get('/biodata/create', [LampiranController::class, 'showCreateForm'])->middleware('mustBeLoggedIn');

Route::get('/biodata/{lampiran_nu}', [LampiranController::class, 'biodataView'])->middleware('mustBeLoggedIn');

//print
Route::get('/lampiran/in_progress/{lampiran_nu}/print', [PdfController::class, 'inProgressPrint'])->middleware('mustBeLoggedIn');

Route::get('/lampiran/history/{lampiran_nu}/print', [PdfController::class, 'historyPrint'])->middleware('mustBeLoggedIn');
<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LampiranController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'homepage']);
Route::prefix('/')
    ->middleware('guest')
    ->group(function () {
        Route::get('login', [UserController::class, 'loginPage']);
        Route::post('login', [UserController::class, 'login']);
    });
Route::post('logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');

Route::prefix('users')->middleware('mustBeLoggedIn')->group(function () {
    Route::get('create', [UserController::class, 'showCreateForm']);
    Route::get('/', [UserController::class, 'getIndex']);
    Route::get('{id}/update', [UserController::class, 'showUpdateForm']);
    Route::delete('delete', [UserController::class, 'delete'])->name('user.delete');
});

Route::middleware('mustBeLoggedIn')->group(function () {
    Route::get('/lampiran', [LampiranController::class, 'index']);

    Route::get('/lampiran/update', [LampiranController::class, 'showUpdateForm']);

    Route::get('/lampiran/in_progress', [LampiranController::class, 'inProgress']);
    Route::get('/lampiran/history', [LampiranController::class, 'history']);

    // Route::get('/lampiran/{lampiran_nu}/view', [LampiranController::class, 'view']);
    Route::get('/lampiran/{lampiran_nu}/print', [PdfController::class, 'generateLampiranPdf']);
    Route::get('/lampiran/requisition', [LampiranController::class, 'requisition']);

    Route::get('/lampiran/in_progress/{lampiran_nu}', [LampiranController::class, 'inProgressView']);
    Route::get('/lampiran/history/{lampiran_nu}', [LampiranController::class, 'historyView']);
    Route::get('/lampiran/requisition/{lampiran_nu}', [LampiranController::class, 'approvalView']);

    Route::get('/biodata/create', [LampiranController::class, 'showCreateForm']);
    Route::get('/biodata/{lampiran_nu}', [LampiranController::class, 'biodataView']);

    // Print
    Route::middleware('mustBeLoggedIn')->group(function () {
        Route::get('/lampiran/in_progress/{lampiran_nu}/print', [PdfController::class, 'inProgressPrint']);
        Route::get('/lampiran/history/{lampiran_nu}/print', [PdfController::class, 'historyPrint']);
    });
});

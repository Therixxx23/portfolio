<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GitHubController;

Route::get('/', function () {
    return view('home');
});

Route::view('/projects', 'projects');
Route::view('/skills', 'skills');
Route::view('/play', 'play');
Route::get('/github', [GitHubController::class, 'index']);
Route::view('/connect', 'connect');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');

    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

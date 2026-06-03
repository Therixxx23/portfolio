<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCrudController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\PlayController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/projects', [ProjectsController::class, 'index']);
Route::view('/skills', 'skills');
Route::get('/play', [PlayController::class, 'index'])->name('play.index');
Route::get('/play/{game}', [PlayController::class, 'show'])->name('play.show');
Route::get('/github', [GitHubController::class, 'index']);
Route::view('/connect', 'connect');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');

    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile/photo', [AdminController::class, 'uploadPhoto'])->name('profile.photo');

        Route::get('/experiences', [AdminCrudController::class, 'experiences'])->name('experiences');
        Route::get('/experiences/create', [AdminCrudController::class, 'createExperience'])->name('experiences.create');
        Route::get('/experiences/{experience}/edit', [AdminCrudController::class, 'editExperience'])->name('experiences.edit');
        Route::post('/experiences/save/{experience?}', [AdminCrudController::class, 'saveExperience'])->name('experiences.save');
        Route::post('/experiences/{experience}/delete', [AdminCrudController::class, 'deleteExperience'])->name('experiences.delete');

        Route::get('/educations', [AdminCrudController::class, 'educations'])->name('educations');
        Route::get('/educations/create', [AdminCrudController::class, 'createEducation'])->name('educations.create');
        Route::get('/educations/{education}/edit', [AdminCrudController::class, 'editEducation'])->name('educations.edit');
        Route::post('/educations/save/{education?}', [AdminCrudController::class, 'saveEducation'])->name('educations.save');
        Route::post('/educations/{education}/delete', [AdminCrudController::class, 'deleteEducation'])->name('educations.delete');

        Route::get('/projects', [AdminCrudController::class, 'projects'])->name('projects');
        Route::get('/projects/create', [AdminCrudController::class, 'createProject'])->name('projects.create');
        Route::get('/projects/{project}/edit', [AdminCrudController::class, 'editProject'])->name('projects.edit');
        Route::post('/projects/save/{project?}', [AdminCrudController::class, 'saveProject'])->name('projects.save');
        Route::post('/projects/{project}/delete', [AdminCrudController::class, 'deleteProject'])->name('projects.delete');

        Route::get('/games', [AdminCrudController::class, 'games'])->name('games');
        Route::get('/games/create', [AdminCrudController::class, 'createGame'])->name('games.create');
        Route::get('/games/{game}/edit', [AdminCrudController::class, 'editGame'])->name('games.edit');
        Route::post('/games/save/{game?}', [AdminCrudController::class, 'saveGame'])->name('games.save');
        Route::post('/games/{game}/delete', [AdminCrudController::class, 'deleteGame'])->name('games.delete');
    });
});

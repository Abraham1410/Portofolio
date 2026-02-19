<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\ProjectController;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/project/{slug}', [PortfolioController::class, 'project'])->name('project.show');
Route::post('/contact', [PortfolioController::class, 'sendContact'])->name('contact.send');

// ADMIN ROUTES (tanpa login)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [ProjectController::class, 'dashboard'])->name('dashboard');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/contacts', [ProjectController::class, 'contacts'])->name('contacts');
    Route::get('/profile', [ProjectController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [ProjectController::class, 'updateProfile'])->name('profile.update');
});

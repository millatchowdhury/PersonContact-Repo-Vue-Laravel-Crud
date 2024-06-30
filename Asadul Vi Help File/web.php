<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PersonsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/person/create', [PersonsController::class, 'create__person__method'])->name('person.create');
    Route::post('/person/create/store', [PersonsController::class, 'create__store__person__method'])->name('person.store');
    Route::get('/person/get/all', [PersonsController::class, 'get__all__persons__method'])->name('person.get.all');
    Route::get('/person/edit/{id}', [PersonsController::class, 'edit__person__method'])->name('person.edit');
    Route::post('/person/update/{id}', [PersonsController::class, 'update__person__method'])->name('person.update');
    Route::get('/person/delete/{id}', [PersonsController::class, 'delete__person__method'])->name('person.delete');
});
require __DIR__.'/auth.php';

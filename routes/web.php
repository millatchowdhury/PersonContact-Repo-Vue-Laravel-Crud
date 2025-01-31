<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PersonController;
use Inertia\Inertia;

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
Route::resource('blogs', BlogController::class);

Route::get('/index', [PersonController::class, 'index'])->name('person.index');
Route::get('/create', [PersonController::class, 'create'])->name('person.create');
Route::post('/store', [PersonController::class, 'store'])->name('person.store');
Route::get('/edit/{id}', [PersonController::class, 'edit'])->name('person.edit');
Route::post('/update/{id}', [PersonController::class, 'update'])->name('person.update');
Route::get('/delete/{id}', [PersonController::class, 'delete'])->name('person.destroy');

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\PaintController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('paints/{paint}/image/', [PaintController::class, 'image'])->name('paints.image'); // Add a custom resource route
    Route::resource('paints', PaintController::class)
        ->only(['index', 'store', 'update', 'destroy', 'image']);
    // https://davecalnan.blog/laravel-routing-gotchas must be {paint} not {id}
});

Route::get('image', [ImageController::class, 'index'])->name('image.index');
Route::get('image/create', [ImageController::class, 'create'])->name('image.create');
Route::post('image', [ImageController::class, 'store'])->name('image.store');

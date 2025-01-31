<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\PaintController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RegimentController;
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

    //    Route::get('paints', [PaintController::class, 'index'])->name('index');
    Route::get('paints/{paint}/image/', [PaintController::class, 'image'])->name('paints.image'); // Add a custom resource route
    //    Route::post('paints/{paint}', [PaintController::class, 'image'])->name('paints.image'); // Add a custom resource route
    //    The POST method is not supported for route paints/47. Supported methods: PUT, PATCH, DELETE.
    Route::resource('paints', PaintController::class)
        ->only(['store', 'update', 'destroy', 'index']);

    Route::get('regiments/{regiment}/image/', [RegimentController::class, 'image'])->name('regiments.image'); // Add a custom resource route
    Route::get('regiments/{regiment}/units/', [RegimentController::class, 'units'])->name('regiments.units'); // Add a custom resource route

    Route::resource('regiments', RegimentController::class)
        ->only(['store', 'update', 'destroy', 'index']);

    Route::resource('recipes', RecipeController::class)
        ->only(['index', 'store', 'update', 'destroy', 'index']);

    // https://davecalnan.blog/laravel-routing-gotchas must be {paint} not {id}
});

Route::get('image', [ImageController::class, 'index'])->name('image.index');
Route::get('image/create', [ImageController::class, 'create'])->name('image.create');
Route::post('image', [ImageController::class, 'store'])->name('image.store');

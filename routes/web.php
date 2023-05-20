<?php

use App\Http\Controllers\DisplayController;
use App\Models\Display;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/display', function () {
        return Inertia::render('Display/List', ['displays' => auth()->user()->displays]);
    })->name('display.list');

    Route::post('/display', [DisplayController::class, 'store'])->name('display.store');

    Route::get('/display/{display}', function (Display $display) {
        return Inertia::render('Display/Show', ['display' => $display]);
    })->name('display.show');

    Route::delete('/display/{display}', [DisplayController::class, 'delete'])->name('display.delete');
});

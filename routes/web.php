<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controller::class, 'index']);
Route::get('/photos/{from}/{to}', [Controller::class, 'search']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'admin'])->name('dashboard');
Route::get('/search/{search?}', [AdminController::class, 'list'])->middleware(['auth', 'admin'])->name('dashboard');
Route::get('/form/{id?}', [AdminController::class, 'form'])->middleware(['auth', 'admin']);
Route::post('/save/{id?}', [AdminController::class, 'save'])->middleware(['auth', 'admin']);
Route::get('/delete/{id}', [AdminController::class, 'delete'])->middleware(['auth', 'admin']);

require __DIR__.'/auth.php';

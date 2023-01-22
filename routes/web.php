<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/authenticate', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/proses-register', [AuthController::class, 'prosesRegister']);
});


Route::middleware('auth')->group(function () {
    //Route Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    //Route untuk buku
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('books');
        Route::get('/create', [BookController::class, 'create']);
        Route::post('/save', [BookController::class, 'save']);
        Route::get('/edit/{id}', [BookController::class, 'edit']);
        Route::put('/update/{id}', [BookController::class, 'update']);
        Route::delete('/delete/{id}', [BookController::class, 'destroy']);
        Route::get('/download/{id}', [BookController::class, 'download']);
    });

    //Route untuk siswa
    Route::prefix('students')->group(function () {
        Route::get('/', [StudentController::class, 'index']);
        Route::get('/create', [StudentController::class, 'create']);
        Route::post('/save', [StudentController::class, 'save']);
        Route::get('/edit/{id}', [StudentController::class, 'edit']);
        Route::put('/update/{id}', [StudentController::class, 'update']);
        Route::delete('/delete/{id}', [StudentController::class, 'destroy']);
    });

    //Route untuk operator
    Route::prefix('operators')->group(function () {
        Route::get('/', [OperatorController::class, 'index']);
        Route::get('/create', [OperatorController::class, 'create']);
        Route::post('/save', [OperatorController::class, 'save']);
        Route::get('/edit/{id}', [OperatorController::class, 'edit']);
        Route::put('/update/{id}', [OperatorController::class, 'update']);
        Route::delete('/delete/{id}', [OperatorController::class, 'destroy']);
    });

    //Profile
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::put('/change-password/{id}', [ProfileController::class, 'changePassword']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

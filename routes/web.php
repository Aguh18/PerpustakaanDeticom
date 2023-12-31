<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\authController;
use App\Http\Controllers\bookController;
use App\Http\Controllers\dashboardController;

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


// Auth 





Route::get('/', function () {
    return view('home');
})->name('home');


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [authController::class, 'loginView'])->name('loginview');
    Route::post('/login', [authController::class, 'login'])->name('login')->middleware('guest');
    Route::get('/register', [authController::class, 'registerView'])->name('registerview');
    Route::post('/register', [authController::class, 'register'])->name('register');
});

route::middleware(['auth'])->group(function () {
    Route::get('/logout', [authController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');
    // books
    Route::get('/book', [bookController::class, 'newbookView'])->name('addbook');
    Route::post('/book', [bookController::class, 'newbookpost'])->name('postbook');
    Route::delete('book/{id}', [bookController::class, 'delete'])->name('book.delete');
    Route::get('book/edit/{id}', [bookController::class, 'editbookView'])->name('book.edit.view');
    Route::put('book/edit/{id}', [bookController::class, 'editBook'])->name('book.edit.post');
        
    
});

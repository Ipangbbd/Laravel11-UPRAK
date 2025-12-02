<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});

// Authentication bawaan Laravel
Auth::routes();

// Dashboard setelah login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'barangs' => BarangController::class,
    'kategoris' => KategoriController::class,
    'peminjamans' => PeminjamanController::class,
    'user' => UserController::class,
    'roles' => RoleController::class
]);
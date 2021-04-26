<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KelasController;

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
    return view('landing');
})->name('landing');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/classes', [ProfileController::class, 'class'])->name('profile.classes');
Route::get('/profile/classes/create', [ProfileController::class, 'classesCreate'])->name('profile.classes.create');

Route::get('/classes', [KelasController::class, 'index'])->name('classes');
Route::post('/classes', [KelasController::class, 'store']);
Route::get('/classes/{kelas}', [KelasController::class, 'show'])->name('classes.show');
Route::get('/classes/{kelas}/users', [KelasController::class, 'users'])->name('classes.users');
Route::get('/classes/{kelas}/users/invite', [KelasController::class, 'invite'])->name('classes.users.invite');
Route::post('/classes/{kelas}/users/invite', [KelasController::class, 'addUser']);
Route::post('/classes/{kelas}/users/{account}/delete', [KelasController::class, 'deleteUser'])->name('classes.users.delete');
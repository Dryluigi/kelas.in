<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SettingController;

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
Route::get('/profile/classes', [ProfileController::class, 'classes'])->name('profile.classes');
Route::get('/profile/classes/create', [ProfileController::class, 'classesCreate'])->name('profile.classes.create');

Route::get('/classes', [KelasController::class, 'index'])->name('classes');
Route::post('/classes', [KelasController::class, 'store']);
Route::get('/classes/{kelas}', [KelasController::class, 'show'])->name('classes.show');

Route::get('/classes/{kelas}/users', [KelasController::class, 'users'])->name('classes.users');
Route::get('/classes/{kelas}/users/invite', [KelasController::class, 'invite'])->name('classes.users.invite');
Route::post('/classes/{kelas}/users/invite', [KelasController::class, 'addUser']);
Route::get('/classes/{kelas}/users/profile/edit', [KelasController::class, 'editProfile'])->name('classes.profile.edit');
Route::put('/classes/{kelas}/users/profile/edit', [KelasController::class, 'updateProfile'])->name('classes.profile.update');
Route::get('/classes/{kelas}/users/{account}', [KelasController::class, 'showUser'])->name('classes.users.show');
Route::put('/classes/{kelas}/users/{account}', [KelasController::class, 'updateUser'])->name('classes.users.update');
Route::get('/classes/{kelas}/users/{account}/edit', [KelasController::class, 'editUser'])->name('classes.users.edit');
Route::delete('/classes/{kelas}/users/{account}/delete', [KelasController::class, 'deleteUser'])->name('classes.users.delete');

Route::get('/classes/{kelas}/posts', [PostController::class, 'index'])->name('classes.posts');
Route::post('/classes/{kelas}/posts', [PostController::class, 'store']);
Route::get('/classes/{kelas}/posts/create', [PostController::class, 'create'])->name('classes.posts.create');
Route::get('/classes/{kelas}/posts/{post}', [PostController::class, 'show'])->name('classes.posts.show');
Route::delete('/classes/{kelas}/posts/{post}', [PostController::class, 'destroy'])->name('classes.posts.delete');
Route::put('/classes/{kelas}/posts/{post}', [PostController::class, 'update'])->name('classes.posts.update');
Route::get('/classes/{kelas}/posts/{post}/edit', [PostController::class, 'edit'])->name('classes.posts.edit');

Route::get('/classes/{kelas}/courses', [CourseController::class, 'index'])->name('classes.courses');
Route::post('/classes/{kelas}/courses', [CourseController::class, 'store']);
Route::get('/classes/{kelas}/courses/create', [CourseController::class, 'create'])->name('classes.courses.create');
Route::post('/classes/{kelas}/courses/group', [CourseController::class, 'storeGroup'])->name('classes.courses.group');
Route::get('/classes/{kelas}/courses/group/create', [CourseController::class, 'createGroup'])->name('classes.courses.group.create');
Route::get('/classes/{kelas}/courses/{course}', [CourseController::class, 'show'])->name('classes.courses.show');
Route::get('/classes/{kelas}/courses/{course}/edit', [CourseController::class, 'edit'])->name('classes.courses.edit');
Route::put('/classes/{kelas}/courses/{course}/edit', [CourseController::class, 'update'])->name('classes.courses.update');
Route::delete('/classes/{kelas}/courses/{course}/delete', [CourseController::class, 'delete'])->name('classes.courses.delete');

Route::get('/classes/{kelas}/settings', [SettingController::class, 'index'])->name('classes.settings');
Route::get('/classes/{kelas}/settings/edit-leader', [SettingController::class, 'editLeader'])->name('classes.settings.edit-leader');
Route::put('/classes/{kelas}/settings/edit-leader', [SettingController::class, 'updateLeader'])->name('classes.settings.update-leader');
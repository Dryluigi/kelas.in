<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseGroupController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ChoreController;
use App\Http\Controllers\ChoreGroupController;
use App\Http\Controllers\AssignedUserChoreController;
use App\Http\Controllers\FinanceController;
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
Route::get('/profile/assignments', [ProfileController::class, 'assignments'])->name('profile.assignments');

Route::get('/classes', [KelasController::class, 'index'])->name('classes');
Route::post('/classes', [KelasController::class, 'store']);
Route::get('/classes/{kelas}', [KelasController::class, 'show'])->name('classes.show');
Route::put('/classes/{kelas}', [KelasController::class, 'update'])->name('classes.update');
Route::get('/classes/{kelas}/edit', [KelasController::class, 'edit'])->name('classes.edit');

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
Route::get('/classes/{kelas}/courses/{course}', [CourseController::class, 'show'])->name('classes.courses.show');
Route::get('/classes/{kelas}/courses/{course}/edit', [CourseController::class, 'edit'])->name('classes.courses.edit');
Route::put('/classes/{kelas}/courses/{course}/edit', [CourseController::class, 'update'])->name('classes.courses.update');
Route::delete('/classes/{kelas}/courses/{course}/delete', [CourseController::class, 'destroy'])->name('classes.courses.delete');

Route::get('/classes/{kelas}/course-groups', [CourseGroupController::class, 'index'])->name('classes.course-groups');
Route::post('/classes/{kelas}/course-groups', [CourseGroupController::class, 'store']);
Route::get('/classes/{kelas}/course-groups/create', [CourseGroupController::class, 'create'])->name('classes.course-groups.create');
Route::get('/classes/{kelas}/course-groups/{courseGroup}', [CourseGroupController::class, 'show'])->name('classes.course-groups.show');
Route::put('/classes/{kelas}/course-groups/{courseGroup}', [CourseGroupController::class, 'update'])->name('classes.course-groups.update');
Route::delete('/classes/{kelas}/course-groups/{courseGroup}', [CourseGroupController::class, 'destroy'])->name('classes.course-groups.delete');
Route::get('/classes/{kelas}/course-groups/{courseGroup}/edit', [CourseGroupController::class, 'edit'])->name('classes.course-groups.edit');

Route::get('/classes/{kelas}/assignments', [AssignmentController::class, 'index'])->name('classes.assignments');
Route::post('/classes/{kelas}/assignments', [AssignmentController::class, 'store']);
Route::get('/classes/{kelas}/assignments/create', [AssignmentController::class, 'create'])->name('classes.assignments.create');
Route::get('/classes/{kelas}/assignments/{assignment}', [AssignmentController::class, 'show'])->name('classes.assignments.show');
Route::put('/classes/{kelas}/assignments/{assignment}', [AssignmentController::class, 'update'])->name('classes.assignments.update');
Route::delete('/classes/{kelas}/assignments/{assignment}', [AssignmentController::class, 'destroy'])->name('classes.assignments.delete');
Route::get('/classes/{kelas}/assignments/{assignment}/edit', [AssignmentController::class, 'edit'])->name('classes.assignments.edit');

Route::get('/classes/{kelas}/chores', [ChoreController::class, 'index'])->name('classes.chores');
Route::post('/classes/{kelas}/chores', [ChoreController::class, 'store']);
Route::get('/classes/{kelas}/chores/create', [ChoreController::class, 'create'])->name('classes.chores.create');
Route::get('/classes/{kelas}/chores/assign-user', [ChoreController::class, 'assignUser'])->name('classes.chores.assign-user');
Route::post('/classes/{kelas}/chores/assign-user', [ChoreController::class, 'assign']);
Route::get('/classes/{kelas}/chores/{chore}', [ChoreController::class, 'show'])->name('classes.chores.show');
Route::put('/classes/{kelas}/chores/{chore}', [ChoreController::class, 'update'])->name('classes.chores.update');
Route::delete('/classes/{kelas}/chores/{chore}', [ChoreController::class, 'destroy'])->name('classes.chores.delete');
Route::get('/classes/{kelas}/chores/{chore}/edit', [ChoreController::class, 'edit'])->name('classes.chores.edit');
Route::delete('/classes/{kelas}/chores/{userChore}/user/{account}', [AssignedUserChoreController::class, 'destroy'])->name('classes.chores.user.delete');

Route::get('/classes/{kelas}/chore-groups', [ChoreGroupController::class, 'index'])->name('classes.chore-groups');
Route::post('/classes/{kelas}/chore-groups', [ChoreGroupController::class, 'store']);
Route::get('/classes/{kelas}/chore-groups/create', [ChoreGroupController::class, 'create'])->name('classes.chore-groups.create');
Route::get('/classes/{kelas}/chore-groups/{choreGroup}', [ChoreGroupController::class, 'show'])->name('classes.chore-groups.show');
Route::put('/classes/{kelas}/chore-groups/{choreGroup}', [ChoreGroupController::class, 'update'])->name('classes.chore-groups.update');
Route::delete('/classes/{kelas}/chore-groups/{choreGroup}', [ChoreGroupController::class, 'show'])->name('classes.chore-groups.delete');
Route::get('/classes/{kelas}/chore-groups/{choreGroup}/edit', [ChoreGroupController::class, 'edit'])->name('classes.chore-groups.edit');

Route::get('/classes/{kelas}/finances', [FinanceController::class, 'index'])->name('classes.finances');
Route::post('/classes/{kelas}/finances', [FinanceController::class, 'store']);
Route::get('/classes/{kelas}/finances/create', [FinanceController::class, 'create'])->name('classes.finances.create');
Route::get('/classes/{kelas}/finances/manage', [FinanceController::class, 'manage'])->name('classes.finances.manage');
Route::put('/classes/{kelas}/finances/{finance}', [FinanceController::class, 'update'])->name('classes.finances.update');
Route::delete('/classes/{kelas}/finances/{finance}', [FinanceController::class, 'destroy'])->name('classes.finances.delete');
Route::get('/classes/{kelas}/finances/{finance}/edit', [FinanceController::class, 'edit'])->name('classes.finances.edit');

Route::get('/classes/{kelas}/settings', [SettingController::class, 'index'])->name('classes.settings');
Route::get('/classes/{kelas}/settings/edit-leader', [SettingController::class, 'editLeader'])->name('classes.settings.edit-leader');
Route::put('/classes/{kelas}/settings/edit-leader', [SettingController::class, 'updateLeader'])->name('classes.settings.update-leader');
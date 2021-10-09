<?php

use App\Http\Controllers\AbsentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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
// Auth::routes();
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

// Route::get('/session', [SessionController::class, 'index']);
// Route::post('/session/store', [SessionController::class, 'store']);

Route::get('/assignment', [AssignmentController::class, 'index']);

Route::resource('messages', MessageController::class)->middleware('auth');
Route::resource('exams', ExamController::class);
Route::resource('classes', ClassController::class)->middleware('auth');
Route::get('/classes/{class}/assign_user', [ClassController::class, 'user_list'])->middleware('auth');
Route::post('/classes/{class}/assign_user/{user}', [ClassController::class, 'assign_user'])->middleware('auth');

Route::resource('session', SessionController::class);
Route::get('courses/download/{id}', [CourseController::class, 'downloadFile'])->name('uploaded');

//helena
Route::resource('courses', CourseController::class);
Route::resource('schedules', ScheduleController::class);
Route::resource('absents', AbsentController::class);
Route::resource('users', UserController::class);
Route::get('/accounts', [UserController::class, 'index']);
Route::post('/accounts', [UserController::class, 'store']);

Route::get('/register/{role?}', [RegisterController::class, 'register'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
//end

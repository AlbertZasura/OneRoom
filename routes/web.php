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
Route::get('/', function () {
    return view('welcome');
})->middleware('auth');
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/session', [SessionController::class, 'index']);
Route::get('/assignment', [AssignmentController::class, 'index']);

Route::resource('messages', MessageController::class)->middleware('auth');
Route::resource('exams', ExamController::class);
Route::resource('classes', ClassController::class)->middleware('auth');

//helena
Route::resource('courses', CourseController::class);
Route::resource('schedules', ScheduleController::class);
Route::resource('absents', AbsentController::class);

Route::get('/register/{role?}', [RegisterController::class, 'register'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
//end

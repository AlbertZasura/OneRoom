<?php

use App\Http\Controllers\AbsentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AssignmentController;
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
});
Route::get('/session', [SessionController::class, 'index']);
Route::get('/class', [ClassController::class, 'index']);
Route::get('/exam', [ExamController::class, 'index']);
Route::get('/assignment', [AssignmentController::class, 'index']);

Route::resource('messages', MessageController::class);

//helena
Route::resource('courses', CourseController::class);
Route::resource('schedules', ScheduleController::class);
Route::resource('absents', AbsentController::class);
//end

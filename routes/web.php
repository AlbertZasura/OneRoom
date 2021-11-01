<?php

use App\Http\Controllers\AbsentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Exports\AssignmentExport;
use App\Models\User;
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

// Route::get('/session', [SessionController::class, 'index']);
// Route::post('/session/store', [SessionController::class, 'store']);

Route::get('/register/{role?}', [RegisterController::class, 'register'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::resource('messages', MessageController::class);
    
    Route::get('/exams/list/{type}', [ExamController::class, 'listExam'])->name('exlist');
    Route::get('/exams/list/filter/{type}/{course_id}', [ExamController::class, 'filterExam'])->name('filterlist');
    Route::get('/exams/submit/list/{exam_id}', [ExamController::class, 'userSubmitList'])->name('examsubmitlist');
    Route::post('/exams/submitscore/{id}', [ExamController::class, 'assignExamScore'])->name('submitscroeexam');
    Route::post('/exams/submitExam', [ExamController::class, 'submitExams']);
    Route::get('/exams/downlodExam/{id}', [ExamController::class, 'downloadExamsUser'])->name('downloadexams');
    Route::post('/exams/createExam', [ExamController::class, 'createExams']);
    Route::get('/exams/downloadexamstudent/download', [ExamController::class, 'downloadExamStudent'])->name('examstudent');
    Route::get('exams/{exam}/export', [ExamController::class, 'export'])->name('exams.export');
    
    Route::resource('exams', ExamController::class);
    
    Route::get('/classes/{class}/assign_user', [ClassController::class, 'user_list']);
    Route::post('/classes/{class}/assign_user/{user}', [ClassController::class, 'assign_user']);
    Route::get('/{class}/{schedule}/chatroom', [ClassController::class, 'chatRoom'])->name('classes.chatRoom');
    Route::resource('classes', ClassController::class);
    
    Route::get('/assignments', [AssignmentController::class, 'course']);
    Route::get('assignments/{assignment}/download', [AssignmentController::class, 'download'])->name('assignments.download');
    Route::post('assignments/{assignment}/upload', [AssignmentController::class, 'upload'])->name('assignments.upload');
    Route::post('assignments/{assignment}/scoring', [AssignmentController::class, 'scoring'])->name('assignments.scoring');
    Route::get('assignments/{assignment}/export', [AssignmentController::class, 'export'])->name('assignments.export');
    Route::resource('course.assignments', AssignmentController::class);

    Route::resource('session', SessionController::class);
    
    Route::get('courses/download/{id}', [CourseController::class, 'downloadFile'])->name('uploaded');
    Route::resource('courses', CourseController::class);
    Route::post('course/createCourse', [CourseController::class, 'createCourse']);
    Route::get('course/assign', [CourseController::class, 'assignCourse']);
    
    Route::get('/schedules/all', [ScheduleController::class, 'listClass'])->name('admin.schedule');
    Route::get('/schedules', [ScheduleController::class, 'schedulesChart']);
    Route::resource('classes.schedules', ScheduleController::class);

    Route::get('/absent', [AbsentController::class, 'course']);
    Route::post('/absent', [AbsentController::class, 'store'])->name('absents.store');
    Route::get('/absents', [AbsentController::class, 'absentGrid']);
    Route::get('/absents/users', [AbsentController::class, 'listUser'])->name('absents.users');
    Route::resource('course.absents', AbsentController::class);

    Route::get('/accounts', [UserController::class, 'index']);
    Route::post('/accounts', [UserController::class, 'store']);
    Route::get('/profiles', [UserController::class, 'edit']);
    Route::resource('users', UserController::class);
    Route::put('/profiles/{user}', [UserController::class, 'updateProfile'])->name('updateProfile');
    Route::post('/profile-image', [UserController::class, 'profileImageUpdate'])->name('profile.image');

});

// Route::get('/exams/list', function () {
//     return view('welcome');
// })->name('Elist');

//end

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreateStudentController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [StudentController::class, 'index']);
Route::post('/time-in', [StudentController::class, 'timeIn'])->name('time-in');
Route::post('/time-out', [StudentController::class, 'timeOut'])->name('time-out');
// Route::post('/', [StudentController::class, 'timein']);
// Route::post('/', [StudentController::class, 'timeout']);
// Route::get('/student/login', [StudentController::class, 'view_login']);
// Route::post('/student/login', [StudentController::class, 'login']);

Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin/admins/view', [AdminController::class, 'admins']);
Route::get('/admin/admins/detail/{id}', [AdminController::class, 'admin_detail']);
Route::get('/admin/admins/edit/{id}', [AdminController::class, 'edit']);
Route::post('/admin/admins/edit/{id}', [AdminController::class, 'update']);

Route::get('/admin/new-admins/create', [AdminController::class, 'add']);
Route::post('/admin/new-admins/create', [AdminController::class, 'create']);

Route::get('/admin/students/create', [CreateStudentController::class, 'add']);
Route::post('/admin/students/create', [CreateStudentController::class, 'create']);

Route::get('/admin/students/edit/{id}', [CreateStudentController::class, 'edit']);
Route::post('/admin/students/edit/{id}', [CreateStudentController::class, 'update']);

Route::get('/admin/students/detail/{id}', [AdminController::class, 'student_detail']);
Route::get('/admin/grades/view/all', [AdminController::class, 'grades']);
Route::get('/admin/attendances/view/all', [AdminController::class, 'all_grades']);
Route::get('/admin/attendances/detail/{id}', [AdminController::class, 'attendance_detail']);

Route::get('/admin/classrooms/detail/{id}', [AdminController::class, 'classroom_detail']);

// Route::get('/search', [AdminController::class, 'search']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

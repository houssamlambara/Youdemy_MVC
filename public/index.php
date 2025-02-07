<?php

require_once '../app/config/database.php';
require_once '../core/BaseController.php';
require_once '../core/Router.php';
require_once '../core/Route.php';
require_once '../app/controllers/UserController.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/AdminController.php';
require_once '../app/controllers/StudentController.php';
require_once '../app/views/front_end/index.php';

session_start();

$router = new Router($_GET['url']);

// Pages principales
$router->get('/', [AuthController::class, 'index']);
Route::get('/index', [AuthController::class, 'index']);

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

// Routes admin

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/pending-teachers', [AdminController::class, 'pending']);
Route::get('/admin/courses', [AdminController::class, 'courses']);
Route::post('/admin/courses/delete/{id}', [AdminController::class, 'deleteCourse']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::post('/admin/users/delete/{id}', [AdminController::class, 'deleteUser']);
Route::get('/admin/tags', [AdminController::class, 'tags']);
Route::get('/admin/categories', [AdminController::class, 'categories']);
Route::post('/admin/tags/bulk-insert', [AdminController::class, 'bulkInsertTags']);
Route::post('/admin/tags/update', [AdminController::class, 'updateTag']);
Route::post('/admin/categories/add', [AdminController::class, 'addCategory']);
Route::post('/admin/categories/update', [AdminController::class, 'updateCategory']);
Route::post('/admin/tags/delete/{id}', [AdminController::class, 'deletetag']);
Route::post('/admin/categories/delete/{id}', [AdminController::class, 'deletecat']);
Route::post('/admin/teachers/activate/{id}', [AdminController::class, 'activateTeacher']);
Route::post('/admin/teachers/reject/{id}', [AdminController::class, 'rejectTeacher']);
Route::post('/admin/users/suspend/{id}', [AdminController::class, 'suspendUser']);
Route::post('/admin/users/activate/{id}', [AdminController::class, 'activateUser']);

// Routes teacher
Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard']);
Route::get('/teacher/courses', [TeacherController::class, 'courses']);
Route::post('/teacher/courses', [TeacherController::class, 'createCourse']);
Route::post('/teacher/courses/update', [TeacherController::class, 'updateCourse']);
Route::post('/teacher/courses/delete/{id}', [TeacherController::class, 'deleteCourse']);
Route::get('/teacher/students', [TeacherController::class, 'students']);
Route::post('/teacher/students/delete/{id}', [TeacherController::class, 'deleteStudent']);
Route::post('/teacher/students/update-status/{id}', [TeacherController::class, 'updateEnrollmentStatus']);

// Student routes
Route::get('/my-enrollments', [StudentController::class, 'enrollments']);
Route::post('/course/enroll/{id}', [StudentController::class, 'enroll']);
Route::post('/my-enrollments/delete/{id}', [StudentController::class, 'deleteEnrollment']);
Route::get('/course/{id}', [StudentController::class, 'courseDetails']);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

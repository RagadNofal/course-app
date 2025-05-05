<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Postman Collection:https://restless-flare-13700.postman.co/workspace/courses-app~4a7cea06-0ef8-4077-bf32-b5bec63fdf58/collection/42794636-1e73a341-825b-4dcf-8e61-fed83c652df2?action=share&creator=42794636

// Students
Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'store']);
Route::get('/students/{student}', [StudentController::class, 'show']);
Route::put('/students/{student}', [StudentController::class, 'update']);
Route::delete('/students/{student}', [StudentController::class, 'destroy']);

// Teachers
Route::get('/teachers', [TeacherController::class, 'index']);
Route::post('/teachers', [TeacherController::class, 'store']);
Route::get('/teachers/{teacher}', [TeacherController::class, 'show']);
Route::put('/teachers/{teacher}', [TeacherController::class, 'update']);
Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy']);
Route::get('/teachers/{teacher}/courses', [TeacherController::class, 'listCourses']);  



Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{course}', [CourseController::class, 'show']);
Route::put('/courses/{course}', [CourseController::class, 'update']);
Route::delete('/courses/{course}', [CourseController::class, 'destroy']);


Route::post('/courses/{course}/enroll', [CourseController::class, 'enrollStudent']);
Route::get('/courses/{course}/students', [CourseController::class, 'listStudents']);

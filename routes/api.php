<?php

use App\Http\Controllers\AdminParentController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminTeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParentAccountController;
use App\Http\Controllers\ParentAssignmentController;
use App\Http\Controllers\ParentProcessLearnController;
use App\Http\Controllers\StudentAccountController;
use App\Http\Controllers\StudentAssignmentController;
use App\Http\Controllers\StudentDiscussController;
use App\Http\Controllers\TeacherAssignmentController;
use App\Http\Controllers\TeacherCommentController;
use App\Http\Controllers\TeacherDiscussController;
use App\Http\Controllers\TeacherMateriController;
use App\Http\Controllers\StudentMateriController;
use App\Http\Controllers\TeacherAccountController;
use App\Http\Controllers\TeacherAssignmentResultController;
use App\Http\Controllers\TeacherStudentScoreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/', function () {
    return response()->json([
        'status' => 200,
        'success' => true
    ]);
});
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::middleware('admin')->group(function () {
        Route::resource('admin-teacher', AdminTeacherController::class);
        Route::get('admin-teacher/{id}', [AdminTeacherController::class, 'show']);
        Route::delete('admin-teacher/{user_id}', [AdminTeacherController::class, 'destroy']);

        Route::resource('admin-student', AdminStudentController::class);
        Route::get('admin-student/{user_id}', [AdminStudentController::class, 'show']);
        Route::delete('admin-student/{user_id}', [AdminStudentController::class, 'destroy']);

        Route::resource('admin-parent', AdminParentController::class);
        Route::get('admin-parent/{user_id}', [AdminParentController::class, 'show']);
        Route::delete('admin-parent/{user_id}', [AdminParentController::class, 'destroy']);
    });
    Route::middleware('teacher')->group(function () {
        Route::resource('teacher-materi', TeacherMateriController::class);
        Route::put('teacher-materi', [TeacherMateriController::class, 'update']);
        Route::delete('teacher-materi/{id}', [TeacherMateriController::class, 'destroy']);

        Route::resource('teacher-assignment', TeacherAssignmentController::class);
        Route::resource('teacher-assignment-result', TeacherAssignmentResultController::class);
        Route::resource('teacher-student-score', TeacherStudentScoreController::class);
        Route::resource('teacher-discuss', TeacherDiscussController::class);
        Route::put('teacher-discuss/{id}', [TeacherDiscussController::class, 'update']);
        Route::resource('teacher-comment', TeacherCommentController::class);

        Route::put('teacher-account', [TeacherAccountController::class, 'update']);
        Route::resource('teacher-account', TeacherAccountController::class);
    });

    Route::middleware('student')->group(function () {
        Route::resource('student-materi', StudentMateriController::class);
        Route::post('student-evaluation-answer', [StudentMateriController::class, 'store']);
        Route::resource('student-assignment', StudentAssignmentController::class);
        Route::resource('student-discuss', StudentDiscussController::class);
        Route::put('student-account', [StudentAccountController::class, 'update']);
        Route::resource('student-account', StudentAccountController::class);
    });

    Route::middleware('parent')->group(function () {
        Route::get('parent-learn-process', [ParentProcessLearnController::class, 'index']);
        Route::get('parent-assignment-process', [ParentAssignmentController::class, 'index']);
        Route::get('parent-account', [ParentAccountController::class, 'index']);
        Route::put('parent-account', [ParentAccountController::class, 'update']);
    });
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

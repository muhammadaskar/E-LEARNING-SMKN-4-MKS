<?php

use App\Http\Controllers\AdminParentController;
use App\Http\Controllers\AdminStudentController;
use App\Http\Controllers\AdminTeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::middleware('role')->group(function () {
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

    // Route::get('/restricted', [App\Http\Controllers\HomeController::class, 'restricted'])->middleware(['role']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

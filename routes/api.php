<?php

use App\Http\Controllers\api\admin\DoctorController;
use App\Http\Controllers\api\admin\ServiceController;
use App\Http\Controllers\api\admin\TimetableController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\frontend\AnalyzeInfoController;
use App\Http\Controllers\api\frontend\AppointmentController;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'services' => ServiceController::class,
        'doctors' => DoctorController::class,
        'timetables' => TimetableController::class,
        'analyzes' => \App\Http\Controllers\api\admin\AnalyzeInfoController::class,
        'appointments' => AppointmentController::class,
    ]);
    Route::get('infoAppointments', [AppointmentController::class, 'infoAppointments']);
});



//telegram bot uchun 

Route::get('analyze/{unique_id}', [AnalyzeInfoController::class, 'getInfo']);
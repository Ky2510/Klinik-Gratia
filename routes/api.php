<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\TreatmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');


Route::middleware('auth:api')->group(function () {
    // Doctor
    Route::get('doctors', [DoctorController::class, 'datatables'])->name('doctor.datatables');
    Route::get('doctor', [DoctorController::class, 'index'])->name('doctor.index');
    Route::post('doctor', [DoctorController::class, 'store'])->name('doctor.store');
    Route::get('doctor/{id}', [DoctorController::class, 'show'])->name('doctor.show');
    Route::put('doctor/{id}', [DoctorController::class, 'update'])->name('doctor.update');
    Route::delete('doctor/{id}', [DoctorController::class, 'destroy'])->name('doctor.destroy');

    // Treatment
    Route::get('treatments', [TreatmentController::class, 'datatables'])->name('treatment.datatables');
    Route::get('treatment', [TreatmentController::class, 'index'])->name('treatment.index');
    Route::post('treatment', [TreatmentController::class, 'store'])->name('treatment.store');
    Route::get('treatment/{id}', [TreatmentController::class, 'show'])->name('treatment.show');
    Route::put('treatment/{id}', [TreatmentController::class, 'update'])->name('treatment.update');
    Route::delete('treatment/{id}', [TreatmentController::class, 'destroy'])->name('treatment.destroy');
    
    // // Appointment
    Route::get('appointments', [AppointmentController::class, 'datatables'])->name('appointment.datatables');
    Route::get('appointment', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::post('appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('appointment/{id}', [AppointmentController::class, 'show'])->name('appointment.show');
    Route::put('appointment/{id}', [AppointmentController::class, 'update'])->name('appointment.update');
    Route::delete('appointment/{id}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
});
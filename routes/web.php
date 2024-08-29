<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\TreatmentController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/doctors', [DoctorController::class,'dataTableWeb'])->name('doctors.index');
Route::get('/treatments', [TreatmentController::class,'dataTableWeb'])->name('treatments.index');
Route::get('/appointments', [AppointmentController::class, 'datatableWeb'])->name('appointments.index');

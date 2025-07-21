<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\accessController;
use App\Http\Controllers\adminPage1Controller;
use App\Http\Controllers\AdminControlController;
use App\Http\Controllers\UserAccessController;
use App\Http\Controllers\DoctorControlController;
use App\Http\Controllers\PatientControlController;


Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


Route::get('/dashboard', [dashboardController::class, 'displayDashboard'])
    ->name('dashboard');


Route::get('/access', function () {
    return view('access');
})->name('access');
Route::get('/admin-access', function () {
    return view('adminaccess'); 
})->name('adminaccess');

Route::get('/user-login', function () {
    return view('useraccess'); 
})->name('userlogin');





Route::get('/admin-access', [adminPage1Controller::class, 'showLoginPage'])->name('adminaccess');


Route::post('/admin-verify', [adminPage1Controller::class, 'verifyAdmin'])->name('admin.verify');


Route::get('/adminControlPage', function () {
    return view('adminControlPage');
})->name('adminControlPage');





Route::get('/admin-control-page', [AdminControlController::class, 'index'])->name('adminControlPage');


Route::post('/admin/add-doctor', [AdminControlController::class, 'storeDoctor'])->name('admin.add.doctor');
Route::get('/admin/edit-doctor/{id}', [AdminControlController::class, 'editDoctor'])->name('admin.edit.doctor');
Route::put('/admin/update-doctor/{id}', [AdminControlController::class, 'updateDoctor'])->name('admin.update.doctor');
Route::delete('/admin/delete-doctor/{id}', [AdminControlController::class, 'deleteDoctor'])->name('admin.delete.doctor');


Route::post('/admin/add-drug', [AdminControlController::class, 'storeDrug'])->name('admin.add.drug');
Route::get('/admin/edit-drug/{id}', [AdminControlController::class, 'editDrug'])->name('admin.edit.drug');
Route::put('/admin/update-drug/{id}', [AdminControlController::class, 'updateDrug'])->name('admin.update.drug');
Route::delete('/admin/delete-drug/{id}', [AdminControlController::class, 'deleteDrug'])->name('admin.delete.drug');



Route::get('/user-access', [UserAccessController::class, 'index'])->name('user.access');
Route::post('/user-access-login', [UserAccessController::class, 'login'])->name('user.access.login');

Route::get('/doctor-control-page', function () {
    return view('docControlPage');
})->name('doctor.control.page');

Route::get('/patient-control-page', function () {
    return view('patControlPage');
})->name('patient.control.page');


Route::get('/doctor-control-page', [DoctorControlController::class, 'index'])->name('doctor.control.page');


Route::post('/doctor/patient/store', [DoctorControlController::class, 'storePatient'])->name('doctor.patient.store');
Route::post('/doctor/patient/update/{id}', [DoctorControlController::class, 'updatePatient'])->name('doctor.patient.update');
Route::get('/doctor/patient/delete/{id}', [DoctorControlController::class, 'deletePatient'])->name('doctor.patient.delete');


Route::post('/doctor/prescription/store', [DoctorControlController::class, 'storePrescription'])->name('doctor.prescription.store');
Route::post('/doctor/prescription/update/{id}', [DoctorControlController::class, 'updatePrescription'])->name('doctor.prescription.update');
Route::get('/doctor/prescription/delete/{id}', [DoctorControlController::class, 'deletePrescription'])->name('doctor.prescription.delete');


Route::get('/doctor/appointment/approve/{id}', [DoctorControlController::class, 'approveAppointment'])->name('doctor.appointment.approve');
Route::get('/doctor/appointment/postpone/{id}', [DoctorControlController::class, 'postponeAppointment'])->name('doctor.appointment.postpone');


Route::post('/doctor/feedback/advice/{id}', [DoctorControlController::class, 'sendAdvice'])->name('doctor.feedback.advice');

Route::middleware(['auth'])->group(function () {
    Route::get('/patient-control-page', [PatientControlController::class, 'index'])->name('patient.control.page');
    Route::post('/patient/request-appointment', [PatientControlController::class, 'requestAppointment'])->name('patient.request.appointment');
    Route::post('/patient/send-feedback', [PatientControlController::class, 'sendFeedback'])->name('patient.send.feedback');
});

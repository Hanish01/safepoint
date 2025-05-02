<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\AdminController;
Route::post('/admin-panel/complaint/resolve', [AdminController::class, 'resolveComplaint'])->name('admin.complaint.resolve');

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Incident reporting routes
Route::get('/incident-reporting', [IncidentController::class, 'showForm'])->name('incident.form')->middleware('auth');
Route::post('/incident-reporting', [IncidentController::class, 'submit'])->name('incident.submit')->middleware('auth');
Route::get('/showing-reporting', [IncidentController::class, 'showReports'])->name('incident.reports')->middleware('auth');

// Admin login routes
Route::get('/admin-login', [AdminController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin-login', [AdminController::class, 'login'])->name('admin.login');

// Admin panel routes
Route::get('/admin-panel', [AdminController::class, 'showAdminPanel'])->name('admin.panel');
Route::delete('/admin-panel/complaint/{id}', [AdminController::class, 'deleteComplaint'])->name('admin.complaint.delete');
Route::post('/admin-logout', [AdminController::class, 'logout'])->name('admin.logout');

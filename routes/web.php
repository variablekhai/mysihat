<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

// Redirect the root URL to the login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Route for the admin login form
Route::get('/admin', function () {
    return view('auth.admin-login');
})->name('admin.login');

// Default authentication routes for users
Auth::routes();

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Patient routes
    Route::prefix('patient')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'patientHomepage'])->name('patient.dashboard');
        // Add more patient-specific routes here
    });

    // Doctor routes
    Route::prefix('doctor')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'doctorHomepage'])->name('doctor.dashboard');
        // Add more doctor-specific routes here
    });

    // Admin routes
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'adminHomepage'])->name('admin.dashboard');
        // Add more admin-specific routes here
    });
});


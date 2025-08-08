<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\CompanyApprovalController;
use App\Http\Controllers\Admin\CompanyPDFController;



// Company Controllers
use App\Http\Controllers\Company\Auth\CompanyAuthController;
use App\Http\Controllers\Company\CompanyLoginController;
use App\Http\Controllers\Company\CompanyDashboardController;
use App\Http\Controllers\Company\VendorController;

// Vendor Form (Public)
use App\Http\Controllers\VendorFormController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Public Vendor Form (via Token)
Route::get('/vendor/form/{token}', [VendorFormController::class, 'showForm'])->name('vendor.form');
Route::post('/vendor/form/{token}', [VendorFormController::class, 'submitForm']);


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Login
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');

    // Protected Admin Routes
    Route::middleware('auth:admin')->group(function () {

        // Dashboard & Logout
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        // Company CRUD
        Route::resource('companies', AdminCompanyController::class)->except(['show', 'edit', 'update']);
        Route::get('/companies/paid', [AdminCompanyController::class, 'paid'])->name('companies.paid');
        Route::get('/companies/unpaid', [AdminCompanyController::class, 'unpaid'])->name('companies.unpaid');
        Route::get('/companies/pending', [AdminCompanyController::class, 'pending'])->name('companies.pending');
        Route::get('/companies/{id}/activate', [CompanyApprovalController::class, 'activate'])->name('companies.activate');

        // Approve / Reject Pending Companies
        Route::get('/pending-companies', [CompanyApprovalController::class, 'index'])->name('pending.companies');
        Route::post('/pending-companies/{id}/approve', [CompanyApprovalController::class, 'approve'])->name('pending.companies.approve');
        Route::delete('/pending-companies/{id}/reject', [CompanyApprovalController::class, 'reject'])->name('pending.companies.reject');
        // pdf
        Route::get('/companies/pdf/{type}', [CompanyPDFController::class, 'download'])->name('companies.pdf');

    });
});


/*
|--------------------------------------------------------------------------
| Company Routes
|--------------------------------------------------------------------------
*/
Route::prefix('company')->name('company.')->group(function () {

    // Registration & Login
    Route::get('/register', [CompanyAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [CompanyAuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [CompanyLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CompanyLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [CompanyLoginController::class, 'logout'])->name('logout');

    // Protected Company Routes
    Route::middleware('auth:company')->group(function () {

        // Dashboard & Profile
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [CompanyDashboardController::class, 'profile'])->name('profile');

        // Vendor Management
        Route::resource('vendors', VendorController::class)->only(['index', 'create', 'store', 'show']);

        // Plan & Payment
        Route::get('/plans', [CompanyDashboardController::class, 'showPlans'])->name('plans');
        Route::post('/plans/select', [CompanyDashboardController::class, 'selectPlan'])->name('plans.submit');
        Route::get('/payment/qr', [CompanyDashboardController::class, 'showQr'])->name('payment.qr');
    });
    
});

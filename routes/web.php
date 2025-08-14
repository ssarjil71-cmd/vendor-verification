<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\Auth\AdminResetPasswordController;
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
use App\Http\Controllers\Company\Auth\ForgotPasswordController as CompanyForgotPasswordController;

// Public Vendor Form Controller
use App\Http\Controllers\VendorFormController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Vendor form show karne ka route
Route::get('/vendor/form/{token}', [VendorFormController::class, 'showForm'])
    ->name('vendor.showForm');

// Vendor form submit karne ka route (name updated to snake_case)
Route::post('/vendor/form/{token}', [VendorFormController::class, 'submitForm'])
    ->name('vendor.submit_form');

// Vendor thank you page ka route
Route::get('/vendor/thankyou/{token}', function ($token) {
    $vendor = \App\Models\Vendor::where('token', $token)->firstOrFail();
    return view('vendor.thankyou', compact('vendor'));
})->name('vendor.thankyou');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');

    Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [AdminResetPasswordController::class, 'reset'])->name('password.update');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

        Route::resource('companies', AdminCompanyController::class)->except(['show', 'edit', 'update']);
        Route::get('/companies/paid', [AdminCompanyController::class, 'paid'])->name('companies.paid');
        Route::get('/companies/unpaid', [AdminCompanyController::class, 'unpaid'])->name('companies.unpaid');
        Route::get('/companies/pending', [AdminCompanyController::class, 'pending'])->name('companies.pending');
        Route::get('/companies/{id}/activate', [CompanyApprovalController::class, 'activate'])->name('companies.activate');

        Route::get('/pending-companies', [CompanyApprovalController::class, 'index'])->name('pending.companies');
        Route::post('/pending-companies/{id}/approve', [CompanyApprovalController::class, 'approve'])->name('pending.companies.approve');
        Route::delete('/pending-companies/{id}/reject', [CompanyApprovalController::class, 'reject'])->name('pending.companies.reject');

        Route::get('/companies/pdf/{type}', [CompanyPDFController::class, 'download'])->name('companies.pdf');
    });
});

/*
|--------------------------------------------------------------------------
| Company Routes
|--------------------------------------------------------------------------
*/
Route::prefix('company')->name('company.')->group(function () {

    Route::get('/register', [CompanyAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [CompanyAuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [CompanyLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CompanyLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [CompanyLoginController::class, 'logout'])->name('logout');

    Route::get('/forgot-password', [CompanyForgotPasswordController::class, 'showForgotForm'])->name('forgot.password');
    Route::post('/forgot-password/send-otp', [CompanyForgotPasswordController::class, 'sendOtp'])->name('forgot.sendOtp');
    Route::get('/forgot-password/verify-otp', [CompanyForgotPasswordController::class, 'showVerifyForm'])->name('forgot.verifyForm');
    Route::post('/forgot-password/verify-otp', [CompanyForgotPasswordController::class, 'verifyOtp'])->name('forgot.verifyOtp');
    Route::get('/forgot-password/reset', [CompanyForgotPasswordController::class, 'showResetForm'])->name('forgot.resetForm');
    Route::post('/forgot-password/reset', [CompanyForgotPasswordController::class, 'resetPassword'])->name('forgot.resetPassword');

    Route::post('/change-password', [CompanyDashboardController::class, 'updatePassword'])
        ->middleware('auth:company')
        ->name('change.password');

    Route::middleware('auth:company')->group(function () {

        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [CompanyDashboardController::class, 'profile'])->name('profile');

        Route::resource('vendors', VendorController::class)->only(['index', 'create', 'store', 'show']);
        Route::get('/vendors/{id}/view', [VendorController::class, 'viewForm'])->name('vendors.view');
        Route::get('/vendors/{id}/pdf', [VendorController::class, 'downloadPdf'])->name('vendors.pdf');
        Route::post('/vendors/{id}/approve', [VendorController::class, 'approve'])->name('vendors.approve');
        Route::post('/vendors/{id}/reject', [VendorController::class, 'reject'])->name('vendors.reject');

        Route::get('/plans', [CompanyDashboardController::class, 'showPlans'])->name('plans');
        Route::post('/plans/select', [CompanyDashboardController::class, 'selectPlan'])->name('plans.submit');
        Route::get('/payment/qr', [CompanyDashboardController::class, 'showQr'])->name('payment.qr');
    });
});

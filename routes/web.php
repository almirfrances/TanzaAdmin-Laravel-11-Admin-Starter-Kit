<?php

use App\Http\Middleware\Check2FA;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\UserAuthenticated;
use App\Http\Middleware\AdminAuthenticated;
use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\VendorsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\UniversitiesController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\ProfileSettingsController;
use App\Http\Controllers\Auth\LoginController as AuthLogin;













Route::get('storage/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);

    if (!Storage::disk('public')->exists($filename)) {
        abort(404);
    }

    return response()->file($path);
})->where('filename', '.*');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login');
        }
    });
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware(AdminAuthenticated::class.':admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.updatePicture');
        Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        Route::post('/profile/deactivate', [ProfileController::class, 'deactivate'])->name('profile.deactivate');

        Route::resource('messages', MessagesController::class)->only(['index', 'show', 'destroy']);
        Route::post('/messages/mark-all-as-read', [MessagesController::class, 'markAllAsRead'])->name('messages.markAllAsRead');

        Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::get('settings/general', [SettingsController::class, 'general'])->name('settings.general');
        Route::post('settings/general', [SettingsController::class, 'updateGeneral'])->name('settings.general.update');
        Route::get('settings/logo', [SettingsController::class, 'logo'])->name('settings.logo');
        Route::post('settings/logo', [SettingsController::class, 'updateLogo'])->name('settings.logo.update');
        Route::get('settings/sections', [SettingsController::class, 'showSections'])->name('settings.sections');
        Route::post('settings/sections', [SettingsController::class, 'updateSections'])->name('settings.sections.update');
        Route::get('settings/custom-code', [SettingsController::class, 'showCustomCode'])->name('settings.custom_code');
        Route::post('settings/custom-code', [SettingsController::class, 'updateCustomCode'])->name('settings.custom_code.update');
        Route::get('settings/email', [SettingsController::class, 'email'])->name('settings.email');
        Route::post('settings/email', [SettingsController::class, 'updateEmail'])->name('settings.email.update');
        Route::post('/settings/email/test', [SettingsController::class, 'testEmail'])->name('settings.email.test');
        // Route::post('/settings/email/template', [SettingsController::class, 'updateEmailTemplate'])->name('settings.email.template.update');

        Route::resource('users', UsersController::class);
        Route::resource('vendors', VendorsController::class);
        Route::resource('universities', UniversitiesController::class);






    });
});






Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('user.register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [AuthLogin::class, 'showLoginForm'])->name('user.login');
Route::post('login', [AuthLogin::class, 'login']);
Route::post('logout', [AuthLogin::class, 'logout'])->name('user.logout');

Route::get('password/forgot', [AuthLogin::class, 'showForgotPasswordForm'])->name('user.password.request');
Route::post('password/email', [AuthLogin::class, 'sendResetLinkEmail'])->name('user.password.email');
Route::get('password/reset/{token}', [AuthLogin::class, 'showResetPasswordForm'])->name('user.password.reset');
Route::post('password/reset', [AuthLogin::class, 'resetPassword'])->name('user.password.update');
Route::get('resend-password-link', [AuthLogin::class, 'showResendPasswordLinkPage'])->name('user.resend.page');
Route::post('resend-password-link', [AuthLogin::class, 'resendPasswordLink'])->name('user.resend.password.link');

// Verification routes (accessible only to authenticated vendors)
Route::get('verify-email', [VerifyEmailController::class, 'showVerifyForm'])->name('verify.email');
Route::post('verify-email', [VerifyEmailController::class, 'verify'])->name('verify.email.submit');
Route::post('resend-code', [VerifyEmailController::class, 'resendCode'])->name('resend.code');






    Route::prefix('user')->name('user.')->group(function () {
        // User authentication middleware
        Route::middleware(UserAuthenticated::class.':web')->group(function () {


            // Email verified middleware applied after authentication
            Route::middleware(EnsureEmailIsVerified::class.':web')->group(function () {
                    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
                    Route::post('/university/select', [UserDashboardController::class, 'selectUniversity'])->name('select.university');


                    Route::get('settings/account', [ProfileSettingsController::class, 'account'])->name('settings.account');
                    Route::post('settings/account', [ProfileSettingsController::class, 'updateAccount'])->name('settings.updateAccount');
                    Route::post('settings/deactivate', [ProfileSettingsController::class, 'deactivateAccount'])->name('settings.deactivateAccount');

                    Route::get('settings/security', [ProfileSettingsController::class, 'security'])->name('settings.security');
                    Route::post('settings/security/password', [ProfileSettingsController::class, 'updatePassword'])->name('settings.updatePassword');
            });
        });
    });














    Route::prefix('vendor')->name('vendor.')->group(function () {
        // User authentication middleware
        Route::middleware(UserAuthenticated::class.':vendor')->group(function () {

            // Email verified middleware applied after authentication
            Route::middleware(EnsureEmailIsVerified::class.':vendor')->group(function () {
                    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

                    Route::get('settings/account', [ProfileSettingsController::class, 'account'])->name('settings.account');
                    Route::post('settings/account', [ProfileSettingsController::class, 'updateAccount'])->name('settings.updateAccount');
                    Route::post('settings/deactivate', [ProfileSettingsController::class, 'deactivateAccount'])->name('settings.deactivateAccount');

                    Route::get('settings/security', [ProfileSettingsController::class, 'security'])->name('settings.security');
                    Route::post('settings/security/password', [ProfileSettingsController::class, 'updatePassword'])->name('settings.updatePassword');
            });
        });
    });












    Route::prefix('university')->name('university.')->group(function () {
        // User authentication middleware
        Route::middleware(UserAuthenticated::class.':university')->group(function () {

            // Email verified middleware applied after authentication
            Route::middleware(EnsureEmailIsVerified::class.':university')->group(function () {
                Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

                Route::get('settings/account', [ProfileSettingsController::class, 'account'])->name('settings.account');
                Route::post('settings/account', [ProfileSettingsController::class, 'updateAccount'])->name('settings.updateAccount');
                Route::post('settings/deactivate', [ProfileSettingsController::class, 'deactivateAccount'])->name('settings.deactivateAccount');

                Route::get('settings/security', [ProfileSettingsController::class, 'security'])->name('settings.security');
                Route::post('settings/security/password', [ProfileSettingsController::class, 'updatePassword'])->name('settings.updatePassword');
            });
        });
    });












    Route::get('/', function () {
        return view('welcome');
    });
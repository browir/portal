<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppIconController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationVisitController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdminAuthController;
use App\Http\Controllers\SuperAdminApplicationController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\SuperAdminAccountController;
use App\Http\Controllers\SuperAdminSettingController;


/*
|--------------------------------------------------------------------------
| PUBLIC / USER
|--------------------------------------------------------------------------
*/

Route::get('/', [
    ApplicationController::class,
    'index'
])->name('applications.index');


/*
|--------------------------------------------------------------------------
| IKON APLIKASI & MANIFEST PWA (dibuat dari logo portal)
|--------------------------------------------------------------------------
*/

Route::get('/manifest.webmanifest', [
    AppIconController::class,
    'manifest'
])->name('app-manifest');

// Tanpa ekstensi .png supaya tidak ditangkap rule file statis nginx (aaPanel).
Route::get('/app-icons/{name}', [
    AppIconController::class,
    'icon'
])->where('name', '[a-z0-9-]+')->name('app-icon');


/*
|--------------------------------------------------------------------------
| APLIKASI POPULER
|--------------------------------------------------------------------------
*/

Route::get('/applications/popular', [
    ApplicationController::class,
    'popular'
])->name('applications.popular');


/*
|--------------------------------------------------------------------------
| LIVE SEARCH APLIKASI
|--------------------------------------------------------------------------
*/

Route::get('/applications/search', [
    ApplicationController::class,
    'search'
])->name('applications.search');


/*
|--------------------------------------------------------------------------
| BUKA APLIKASI
|--------------------------------------------------------------------------
*/

Route::get('/applications/{application}/open', [
    ApplicationVisitController::class,
    'open'
])->name('applications.open');


/*
|--------------------------------------------------------------------------
| SUPER ADMIN AUTH
|--------------------------------------------------------------------------
*/

Route::get('/superadmin', [
    SuperAdminAuthController::class,
    'showLogin'
])->name('superadmin.login');

Route::post('/superadmin/login', [
    SuperAdminAuthController::class,
    'login'
])->name('superadmin.login.submit');

Route::post('/superadmin/logout', [
    SuperAdminAuthController::class,
    'logout'
])->name('superadmin.logout');


/*
|--------------------------------------------------------------------------
| HALAMAN SUPER ADMIN (WAJIB LOGIN)
|--------------------------------------------------------------------------
|
| Semua route di dalam grup ini hanya bisa diakses oleh user yang sudah
| login dan memiliki is_super_admin = true (middleware SuperAdmin).
|
*/

Route::middleware('superadmin')->group(function () {


/*
|--------------------------------------------------------------------------
| SUPER ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/superadmin/dashboard', [
    SuperAdminDashboardController::class,
    'dashboard'
])->name('superadmin.dashboard');

Route::get('/superadmin/dashboard/visits-trend', [
    SuperAdminDashboardController::class,
    'visitsTrend'
])->name('superadmin.dashboard.visits-trend');


/*
|--------------------------------------------------------------------------
| SEMUA APLIKASI
|--------------------------------------------------------------------------
*/

Route::get('/superadmin/all-applications', [
    SuperAdminApplicationController::class,
    'allApplications'
])->name('superadmin.all-applications');


/*
|--------------------------------------------------------------------------
| KELOLA APLIKASI
|--------------------------------------------------------------------------
*/

Route::get('/superadmin/applications', [
    SuperAdminApplicationController::class,
    'index'
])->name('superadmin.applications.index');

Route::get('/superadmin/applications/create', [
    SuperAdminApplicationController::class,
    'create'
])->name('superadmin.applications.create');

Route::post('/superadmin/applications', [
    SuperAdminApplicationController::class,
    'store'
])->name('superadmin.applications.store');


/*
|--------------------------------------------------------------------------
| TOGGLE STATUS APLIKASI
|--------------------------------------------------------------------------
*/

Route::patch('/superadmin/applications/{application}/toggle-status', [
    SuperAdminApplicationController::class,
    'toggleStatus'
])->name('superadmin.applications.toggle-status');


/*
|--------------------------------------------------------------------------
| EDIT APLIKASI
|--------------------------------------------------------------------------
*/

Route::get('/superadmin/applications/{application}/edit', [
    SuperAdminApplicationController::class,
    'edit'
])->name('superadmin.applications.edit');

Route::put('/superadmin/applications/{application}', [
    SuperAdminApplicationController::class,
    'update'
])->name('superadmin.applications.update');


/*
|--------------------------------------------------------------------------
| HAPUS APLIKASI
|--------------------------------------------------------------------------
*/

Route::delete('/superadmin/applications/{application}', [
    SuperAdminApplicationController::class,
    'destroy'
])->name('superadmin.applications.destroy');


/*
|--------------------------------------------------------------------------
| AKUN SUPER ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/superadmin/account', [
    SuperAdminAccountController::class,
    'index'
])
    ->middleware('auth')
    ->name('superadmin.account');

Route::put('/superadmin/account', [
    SuperAdminAccountController::class,
    'update'
])
    ->middleware('auth')
    ->name('superadmin.account.update');


/*
|--------------------------------------------------------------------------
| PENGATURAN PORTAL (LOGO)
|--------------------------------------------------------------------------
*/

Route::get('/superadmin/settings', [
    SuperAdminSettingController::class,
    'index'
])->name('superadmin.settings');

Route::post('/superadmin/settings/logo', [
    SuperAdminSettingController::class,
    'updateLogo'
])->name('superadmin.settings.logo.update');

Route::delete('/superadmin/settings/logo', [
    SuperAdminSettingController::class,
    'resetLogo'
])->name('superadmin.settings.logo.reset');


});

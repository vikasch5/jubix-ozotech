<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('about-us', [FrontendController::class, 'aboutUs'])->name('about.us');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::middleware('auth')->group(function () {
        Route::get('edit-profile', [AuthController::class, 'editProfile'])->name('edit.profile.page');
        Route::post('update-profile_photo', [AuthController::class, 'updateProfilePhoto'])->name('user.updateProfilePhoto');
        Route::post('update-password', [AuthController::class, 'updatePassword'])->name('user.updatePassword');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('service-list', [ServiceController::class, 'index'])->name('admin.service.list');
        Route::get('service-add/{id?}', [ServiceController::class, 'serviceAddIndex'])->name('admin.service.add');
        Route::post('service-save', [ServiceController::class, 'storeOrUpdate'])->name('admin.service.store');
        Route::delete('service-delete', [ServiceController::class, 'delete'])->name('admin.service.delete');
        
    });
});

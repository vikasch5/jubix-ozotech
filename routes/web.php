<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoryContoller;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('about-us', [FrontendController::class, 'aboutUs'])->name('about.us');
Route::get('services/{slug?}', [FrontendController::class, 'serviceDetail'])->name('service.details');
Route::get('products/{slug?}/{subSlug?}', [FrontendController::class, 'productList'])->name('product.list');
Route::get('product/{slug?}', [FrontendController::class, 'productDetail'])->name('product.detail');

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
        Route::get('category-list', [CategoryContoller::class, 'index'])->name('admin.category.index');
        Route::get('category-add/{id?}', [CategoryContoller::class, 'categoryAddIndex'])->name('admin.category.add');
        Route::post('category-save', [CategoryContoller::class, 'storeOrUpdate'])->name('admin.category.store-or-update');
        Route::delete('category-delete', [CategoryContoller::class, 'delete'])->name('admin.category.category');
        Route::get('sub-category-list', [CategoryContoller::class, 'subCategoryIndex'])->name('admin.sub.category.index');
        Route::get('sub-category-add/{id?}', [CategoryContoller::class, 'subCategoryAddIndex'])->name('admin.sub.category.add');
        Route::post('sub-category-save', [CategoryContoller::class, 'subCategoryStorOrUpdate'])->name('admin.sub.category.store-or-update');
        Route::delete('sub-category-delete', [CategoryContoller::class, 'deleteSubCategory'])->name('admin.sub.category.delete');

        Route::get('product-list', [ProductController::class, 'index'])->name('admin.product.list');
        Route::get('product-add/{id?}', [ProductController::class, 'productAddIndex'])->name('admin.product.add');
        Route::post('product-save', [ProductController::class, 'storeOrUpdate'])->name('admin.products.store');
        Route::delete('product-delete', [ProductController::class, 'delete'])->name('admin.products.delete');
        Route::post('/products/delete-image', [ProductController::class, 'deleteImage'])
        ->name('admin.products.delete-image');
        Route::get('/get-subcategories/{category_id?}', [CategoryContoller::class, 'getSubcategories'])->name('admin.get.subcategories');
    });
});

<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\VerificatorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('product', fn () => view('product'))->name('product');
Route::get('product/{id}', fn ($id) => view('detail-product', ['id' => $id]))->name('detail-product');
Route::get('about', fn () => view('about'))->name('about');
Route::get('order-flow', fn () => view('order-flow'))->name('order-flow');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'isActiveUser']], function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    // Account
    Route::group(['prefix' => 'account', 'as' => 'admin.'], function () {
        Route::get('/', [AccountController::class, 'index'])->name('account.index');
    });

    // Verificator
    Route::group(['prefix' => 'verificator', 'as' => 'admin.'], function () {
        Route::get('/', [VerificatorController::class, 'index'])->name('verificator.index');
        Route::get('create', [VerificatorController::class, 'create'])->name('verificator.create');
        Route::post('store', [VerificatorController::class, 'store'])->name('verificator.store');
        Route::delete('destroy/{id}', [VerificatorController::class, 'destroy'])->name('verificator.destroy');
    });

    // Profile
    Route::group(['prefix' => 'profile', 'as' => 'admin.'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    });

    // Course
    Route::group(['prefix' => 'course', 'as' => 'admin.'], function () {
        Route::get('/', [CourseController::class, 'index'])->name('course.index');
        Route::get('create', [CourseController::class, 'create'])->name('course.create');
        Route::post('store', [CourseController::class, 'store'])->name('course.store');
        Route::get('edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
    });

    // Course Category
    Route::resource('course-category', CourseCategoryController::class)->except(['show'])->names('admin.course-category');

    //checkout
    Route::get('checkout', fn () => view('checkout'))->name('admin.checkout');
});

require __DIR__ . '/auth.php';

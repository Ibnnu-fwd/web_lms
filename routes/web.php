<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseChapterController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseSubChapterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\VerificatorController;
use App\Http\Controllers\Admin\MinCoursePurchaseAtRegController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\CKEditorController;
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

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'isActiveUser:1']], function () {

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
        Route::post('change-image', [ProfileController::class, 'changeImage'])->name('profile.change-image');
    });

    // Course
    Route::group(['prefix' => 'course', 'as' => 'admin.'], function () {
        Route::get('/', [CourseController::class, 'index'])->name('course.index');
        Route::get('create', [CourseController::class, 'create'])->name('course.create');
        Route::post('store', [CourseController::class, 'store'])->name('course.store');
        Route::get('edit/{id}', [CourseController::class, 'edit'])->name('course.edit');
        Route::post('update/{id}', [CourseController::class, 'update'])->name('course.update');

        // Course Chapter
        Route::post('{course_id}/chapter/{id}/restore', [CourseChapterController::class, 'restore'])->name('course-chapter.restore');
        Route::resource('{course_id}/chapter', CourseChapterController::class)->names('course-chapter');

        // Course Sub Chapter
        Route::get('course-sub-chapter/{courseChapterId}', [CourseSubChapterController::class, 'index'])->name('course-sub-chapter.index');
        Route::get('course-sub-chapter/{courseChapterId}/create', [CourseSubChapterController::class, 'create'])->name('course-sub-chapter.create');
    });

    // Ckeditor Image Upload
    Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

    // Course Category
    Route::resource('course-category', CourseCategoryController::class)->except(['show'])->names('admin.course-category');

    // Min Course Purchase At Reg
    Route::resource('mincourse', MinCoursePurchaseAtRegController::class)->except(['show'])->names('admin.mincourse');
});



Route::group(
    ['prefix' => 'user-dashboard', 'middleware' => ['auth', 'isActiveUser:4']],
    function () {

        Route::get('/', fn () => view('user.dashboard'))->name('user.dashboard');
        // Checkout
        Route::get('checkout', fn () => view('checkout'))->name('user.checkout');

        // Cart
        Route::get('cart', fn () => view('cart'))->name('user.cart');
    }
);



require __DIR__ . '/auth.php';

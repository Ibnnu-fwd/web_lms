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
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\User\TransactionController as UserTransactionController;
use App\Http\Controllers\Verificator\CourseRequestController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
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
    Route::get('/', DashboardController::class)->name('dashboard')->middleware('checkRole:1');

    // Account
    Route::group(['prefix' => 'account', 'as' => 'admin.'], function () {
        Route::get('/', [AccountController::class, 'index'])->name('account.index');
    });

    // Transaction
    Route::group(['prefix' => 'admin/transaction', 'as' => 'admin.'], function () {
        Route::get('/', [AdminTransactionController::class, 'index'])->name('transaction.index');
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
        Route::delete('destroy/{id}', [CourseController::class, 'destroy'])->name('course.destroy');
        Route::post('restore/{id}', [CourseController::class, 'restore'])->name('course.restore');
        Route::post('publish/{id}', [CourseController::class, 'publish'])->name('course.publish');
        Route::post('unpublish/{id}', [CourseController::class, 'unpublish'])->name('course.unpublish');

        // Course Chapter
        Route::post('{course_id}/chapter/{id}/restore', [CourseChapterController::class, 'restore'])->name('course-chapter.restore');
        Route::resource('{course_id}/chapter', CourseChapterController::class)->names('course-chapter');

        // Course Sub Chapter
        Route::get('course-sub-chapter/{courseChapterId}', [CourseSubChapterController::class, 'index'])->name('course-sub-chapter.index');
        Route::get('course-sub-chapter/{courseChapterId}/create', [CourseSubChapterController::class, 'create'])->name('course-sub-chapter.create');
        Route::post('course-sub-chapter/{courseChapterId}/store', [CourseSubChapterController::class, 'store'])->name('course-sub-chapter.store');
        Route::get('course-sub-chapter/{courseChapterId}/edit/{id}', [CourseSubChapterController::class, 'edit'])->name('course-sub-chapter.edit');
        Route::post('course-sub-chapter/{courseChapterId}/update/{id}', [CourseSubChapterController::class, 'update'])->name('course-sub-chapter.update');
        Route::post('course-sub-chapter/{courseSubChapter}/delete-file', [CourseSubChapterController::class, 'deleteFile'])->name('course-sub-chapter.delete-file');
        Route::post('course-sub-chapter/{courseSubChapter}/delete-video', [CourseSubChapterController::class, 'deleteVideo'])->name('course-sub-chapter.delete-video');

        Route::post('quiz/{quizId}/restore', [QuizController::class, 'restore'])->name('quiz.restore');
        Route::resource('{courseChapterId}/quiz', QuizController::class);

        Route::resource('{quizId}/question', QuestionController::class);
    })->middleware('checkRole:1');


    // Ckeditor Image Upload
    Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload')->middleware('checkRole:1');

    // Course Category
    Route::resource('course-category', CourseCategoryController::class)->except(['show'])->names('admin.course-category')->middleware('checkRole:1');

    // Min Course Purchase At Reg
    Route::resource('mincourse', MinCoursePurchaseAtRegController::class)->except(['show'])->names('admin.mincourse')->middleware('checkRole:1');
});

Route::group(
    ['prefix' => 'user-dashboard', 'middleware' => ['auth', 'isActiveUser:1', 'checkRole:4']],
    function () {
        Route::get('/', fn () => view('user.dashboard'))->name('user.dashboard');
        Route::get('checkout', fn () => view('checkout'))->name('user.checkout');
        Route::get('cart', fn () => view('cart'))->name('user.cart');
        Route::group(['prefix' => 'transaction'], function () {
            Route::get('/', [UserTransactionController::class, 'index'])->name('user.transaction');
        });
        Route::get('course', fn () => view('user.course.index'))->name('user.course');
    }
);

Route::group(['prefix' => 'verificator-dashboard', 'middleware' => ['isActiveUser:1', 'isVerificator'], 'as' => 'verificator.'], function () {
    Route::get('/', fn () => view('verificator.dashboard'))->name('dashboard');
    Route::group(['prefix' => 'course-request'], function () {
        Route::get('/', [CourseRequestController::class, 'index'])->name('course-request.index');
        Route::post('approve/{id}', [CourseRequestController::class, 'approve'])->name('course-request.approve');
        Route::post('reject/{id}', [CourseRequestController::class, 'reject'])->name('course-request.reject');
        Route::post('pending/{id}', [CourseRequestController::class, 'pending'])->name('course-request.pending');
    });
});

Route::group(
    ['prefix' => 'institution-dashboard', 'middleware' => ['auth', 'isActiveUser:1', 'checkRole:3']],
    function () {
        Route::get('/', fn () => view('institution.dashboard'))->name('institution.dashboard');
        Route::get('management-acount', fn () => view('institution.management-account'))->name('institution.management-account');
    }
);


// Institution


require __DIR__ . '/auth.php';

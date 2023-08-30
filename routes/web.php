<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\RegisteredInstitutionController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseChapterController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Institution\CourseController as InstitutionCourseController;
use App\Http\Controllers\Admin\CourseSubChapterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\VerificatorController;
use App\Http\Controllers\Admin\MinCoursePurchaseAtRegController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\User\TransactionController as UserTransactionController;
use App\Http\Controllers\Verificator\CourseRequestController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Institution\TransactionController as InstitutionTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\CourseController as UserCourseController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('/');

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('product', [ProductController::class, 'index'])->name('product');
Route::get('product/{id}', [UserCourseController::class, 'show'])->name('product.show');
Route::get('about', fn () => view('about'))->name('about');
Route::get('order-flow', fn () => view('order-flow'))->name('order-flow');

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'isActiveUser:1']], function () {
    Route::get('/', DashboardController::class)
        ->name('dashboard')
        ->middleware('checkRole:1');

    // Account
    Route::group(['prefix' => 'account', 'as' => 'admin.'], function () {
        Route::get('/', [AccountController::class, 'index'])->name('account.index');
    });

    // Transaction
    Route::group(['prefix' => 'admin-transaction', 'as' => 'admin.'], function () {
        Route::post('decline/{id}', [AdminTransactionController::class, 'decline'])->name('transaction.decline');
        Route::post('approve/{id}', [AdminTransactionController::class, 'approve'])->name('transaction.approve');
        Route::get('detail/{id}', [AdminTransactionController::class, 'detail'])->name('transaction.detail');
        Route::get('/', [AdminTransactionController::class, 'index'])->name('transaction.index');
    })->middleware('checkRole:1');

    Route::group(['prefix' => 'member', 'as' => 'admin.'], function () {
        Route::post('change-status/{id}', [MemberController::class, 'changeStatus'])->name('member.change-status');
        Route::get('/', [MemberController::class, 'index'])->name('member.index');
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

        // Quiz
        Route::post('quiz/{quizId}/restore', [QuizController::class, 'restore'])->name('quiz.restore');
        Route::resource('{courseChapterId}/quiz', QuizController::class);
        Route::resource('{quizId}/question', QuestionController::class);
    })->middleware('checkRole:1');

    // Ckeditor Image Upload
    Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])
        ->name('ckeditor.upload')
        ->middleware('checkRole:1');


    // Course Category
    Route::resource('course-category', CourseCategoryController::class)
        ->except(['show'])
        ->names('admin.course-category')
        ->middleware('checkRole:1');


    // Min Course Purchase At Reg
    Route::resource('mincourse', MinCoursePurchaseAtRegController::class)
        ->except(['show'])
        ->names('admin.mincourse')
        ->middleware('checkRole:1');

    // Cart
    Route::get('cart', [ProductController::class, 'getAllCart'])->name('cart');
    Route::post('cart/delete', [ProductController::class, 'deleteCart'])->name('cart.delete');
    Route::post('product/add-to-cart', [ProductController::class, 'addToCart'])->name('product.add-to-cart');
    Route::post('cart/update', [ProductController::class, 'updateCart'])->name('cart.update');

    // Checkout
    Route::post('checkout/payment', [ProductController::class, 'checkoutPayment'])->name('checkout.payment');
    Route::get('checkout', [ProductController::class, 'checkout'])->name('checkout');
});



// User
Route::group(
    ['prefix' => 'user-dashboard', 'middleware' => ['auth', 'isActiveUser:1', 'checkRole:3']],
    function () {
        Route::get('/', UserDashboardController::class)->name('user.dashboard');
        Route::get('checkout', fn () => view('checkout'))->name('user.checkout');
        Route::get('cart', fn () => view('cart'))->name('user.cart');
        Route::group(['prefix' => 'user-transaction'], function () {
            Route::get('/', [UserTransactionController::class, 'index'])->name('user.transaction');
            Route::get('detail/{id}', [UserTransactionController::class, 'detail'])->name('user.transaction.detail');
            Route::post('upload-payment/{id}', [UserTransactionController::class, 'uploadPayment'])->name('user.transaction.upload-payment');
            Route::post('cancel/{id}', [UserTransactionController::class, 'cancel'])->name('user.transaction.cancel');
        });
        Route::post('quiz/{id}', [UserCourseController::class, 'quiz'])->name('user.quiz');
        Route::post('quiz/answer', [UserCourseController::class, 'quizAnswer'])->name('user.quiz.answer');
        Route::post('quiz/{id}/done', [UserCourseController::class, 'quizDone'])->name('user.quiz.done');
        Route::get('course/{id}/{page}', [UserCourseController::class, 'index'])->name('user.course.detail');
        Route::get('get-File-View/{filename}', [UserCourseController::class, 'getFileView'])->name('getFileView');
        Route::post('course/{id}/{page}/next', [UserCourseController::class, 'nextPage'])->name('user.course.next-page');
        Route::post('course/{id}/finish', [UserCourseController::class, 'finish'])->name('user.course.finish');
    }
);

// Verificator
Route::group(['prefix' => 'verificator-dashboard', 'middleware' => ['isActiveUser:1', 'isVerificator'], 'as' => 'verificator.'], function () {
    Route::get('/', fn () => view('verificator.dashboard'))->name('dashboard');
    Route::group(['prefix' => 'course-request'], function () {
        Route::get('/', [CourseRequestController::class, 'index'])->name('course-request.index');
        Route::post('approve/{id}', [CourseRequestController::class, 'approve'])->name('course-request.approve');
        Route::post('reject/{id}', [CourseRequestController::class, 'reject'])->name('course-request.reject');
        Route::post('pending/{id}', [CourseRequestController::class, 'pending'])->name('course-request.pending');
    });
});

// Institution
Route::group(
    ['prefix' => 'institution-dashboard', 'middleware' => ['auth', 'isActiveUser:1', 'checkRole:2']],
    function () {
        // dashboard
        Route::get('/', fn () => view('institution.dashboard'))->name('institution.dashboard');

        //management-account
        Route::get('management-account', fn () => view('institution.management-account'))->name('institution.management-account');

        // Course
        Route::group(['prefix' => 'institution-course', 'as' => 'institution.'], function () {
            Route::get('/', [InstitutionCourseController::class, 'index'])->name('course.index');
            Route::get('create', [InstitutionCourseController::class, 'create'])->name('course.create');
            Route::post('store', [InstitutionCourseController::class, 'store'])->name('course.store');
            Route::get('edit/{id}', [InstitutionCourseController::class, 'edit'])->name('course.edit');
            Route::post('update/{id}', [InstitutionCourseController::class, 'update'])->name('course.update');
            Route::delete('destroy/{id}', [InstitutionCourseController::class, 'destroy'])->name('course.destroy');
            Route::post('restore/{id}', [InstitutionCourseController::class, 'restore'])->name('course.restore');
            Route::post('publish/{id}', [InstitutionCourseController::class, 'publish'])->name('course.publish');
            Route::post('unpublish/{id}', [InstitutionCourseController::class, 'unpublish'])->name('course.unpublish');

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
        })->middleware('checkRole:3');

        // transaction
        Route::group(['prefix' => 'institution-transaction', 'as' => 'institution.'], function () {
            Route::post('approve/{id}', [InstitutionTransactionController::class, 'approve'])->name('transaction.approve');
            Route::post('upload-payment/{id}', [InstitutionTransactionController::class, 'uploadPayment'])->name('transaction.upload-payment');
            Route::post('cancel/{id}', [InstitutionTransactionController::class, 'cancel'])->name('transaction.cancel');
            Route::get('detail/{id}', [InstitutionTransactionController::class, 'detail'])->name('transaction.detail');
            Route::get('/', [InstitutionTransactionController::class, 'index'])->name('transaction.index');
        });
    }
);

//download template surat pernyataan
Route::get('register/download-template', [RegisteredInstitutionController::class, 'downloadTemplate'])->name('download_template');

// Register-institution
Route::post('register_institution', [RegisteredInstitutionController::class, 'registeredInstitution'])->name('register_institution');



// Register-personal
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

require __DIR__ . '/auth.php';

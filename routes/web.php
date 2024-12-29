<?php

use App\Http\Controllers\UserProfileController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\InstitutionController;
use App\Http\Controllers\Admin\FAQQuestionController;
use App\Http\Controllers\Admin\FAQCategoryController;
use App\Http\Controllers\Admin\NewsItemController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserCourseController;
use App\Http\Controllers\User\ContactController;


use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [UserCourseController::class, 'index'])->name('index');
    Route::get('/{id}', [UserCourseController::class, 'showTutors'])->name('tutors');
    Route::post('/{id}', [UserCourseController::class, 'store'])->name('storeTutor');
    Route::get('/tutor/{id}', [UserCourseController::class, 'create'])->name('createTutor');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
    });

    Route::prefix('home')->name('home.')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
    });

    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
    });

});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    })->name('home');
    Route::get('/', [AdminController::class, 'index'])->name('home.index');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/', [UserController::class, 'store'])->name('store');
    });

    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::post('/', [CourseController::class, 'store'])->name('store');
        Route::get('/create', [CourseController::class, 'create'])->name('create');
        Route::delete('/{id}', [CourseController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('institutions')->name('institutions.')->group(function () {
        Route::get('/', [InstitutionController::class, 'index'])->name('index');
        Route::get('/create', [InstitutionController::class, 'create'])->name('create');
        Route::post('/', [InstitutionController::class, 'store'])->name('store');
        Route::delete('/{id}', [InstitutionController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', [FAQCategoryController::class, 'index'])->name('index');
        Route::post('/', [FAQCategoryController::class, 'store'])->name('faq_category.store');
        Route::get('/category/create', [FAQCategoryController::class, 'create'])->name('faq_category.create');
        Route::get('/category/{id}', [FAQQuestionController::class, 'index'])->name('faq_questions.index');    
        Route::get('/question/create/{category_id}', [FAQQuestionController::class, 'create'])->name('faq_questions.create');
        Route::post('/question', [FAQQuestionController::class, 'store'])->name('faq_questions.store');
        Route::delete('/category/{id}', [FAQCategoryController::class, 'destroy'])->name('faq_category.destroy');
        Route::delete('/question/{id}', [FAQQuestionController::class, 'destroy'])->name('faq_questions.destroy');
    });

    Route::prefix('newsItems')->name('news_items.')->group(function () {
        Route::post('/', [NewsItemController::class, 'store'])->name('store');    
        Route::get('/create', [NewsItemController::class, 'create'])->name('create');    
        Route::get('/', [NewsItemController::class, 'index'])->name('index');
        Route::delete('/{id}', [NewsItemController::class, 'destroy'])->name('destroy');
    });


});

require __DIR__.'/auth.php';

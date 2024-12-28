<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\FAQQuestionController;
use App\Http\Controllers\FAQCategoryController;
use App\Http\Controllers\NewsItemController;

use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
    });

    Route::prefix('institutions')->name('institutions.')->group(function () {
        Route::get('/', [InstitutionController::class, 'index'])->name('index');
        Route::get('/create', [InstitutionController::class, 'create'])->name('create');
        Route::post('/', [InstitutionController::class, 'store'])->name('store');
    });

    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', [FAQCategoryController::class, 'index'])->name('index');
        Route::post('/', [FAQCategoryController::class, 'store'])->name('faq_category.store');
        Route::get('/category/create', [FAQCategoryController::class, 'create'])->name('faq_category.create');
        Route::get('/category/{id}', [FAQQuestionController::class, 'index'])->name('faq_questions.index');    
        Route::get('/question/create/{category_id}', [FAQQuestionController::class, 'create'])->name('faq_questions.create');
        Route::post('/question', [FAQQuestionController::class, 'store'])->name('faq_questions.store');

    });

    Route::prefix('newsItems')->name('news_items.')->group(function () {
        Route::post('/', [NewsItemController::class, 'store'])->name('store');    
        Route::get('/create', [NewsItemController::class, 'create'])->name('create');    
        Route::get('/', [NewsItemController::class, 'index'])->name('index');
    });


});

require __DIR__.'/auth.php';

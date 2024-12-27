<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstitutionController;
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
        return view('home');
    })->name('home');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/user/{id}', [AdminController::class, 'show'])->name('user.show');
    Route::put('/users/{id}', [UserController::class, 'updateUser'])->name('user.updateRole');
    Route::post('/user', [AdminController::class, 'store'])->name('user.store');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/add', [CourseController::class, 'add'])->name('courses.add');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/institutions', [InstitutionController::class, 'index'])->name('institutions.index');
    Route::get('/institutions/add', [InstitutionController::class, 'add'])->name('institutions.add');
    Route::post('/institutions', [InstitutionController::class, 'store'])->name('institutions.store');

});

require __DIR__.'/auth.php';

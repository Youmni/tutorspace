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
use App\Http\Controllers\User\FAQController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationUserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\User\ClientController;



use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return redirect()->route('home.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [UserCourseController::class, 'index'])->name('index');
    Route::get('/{id}', [UserCourseController::class, 'showTutors'])->name('tutors');
    Route::post('/{id}', [UserCourseController::class, 'store'])->name('storeTutor');
    Route::get('/tutor/{id}', [UserCourseController::class, 'create'])->name('createTutor');
    Route::get('/search', [CourseController::class, 'search'])->name('search');
});
Route::get('/client/search', [ClientController::class, 'searchUser'])->name('client.search');



Route::prefix('home')->name('home.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/announcements', [HomeController::class, 'show'])->name('show');
});

Route::prefix('faq')->name('faq.')->group(function () {
    Route::get('/catagories', [FAQController::class, 'index'])->name('index');
    Route::get('/questions/{id}', [FAQController::class, 'show'])->name('show');
});

Route::prefix('contact')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'send'])->name('send');
});



Route::middleware('auth')->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index'); // Profiel overzicht
        Route::put('/', [ProfileController::class, 'updateProfile'])->name('update.profile'); // Profiel bijwerken
        Route::get('/course', [ProfileController::class, 'courses'])->name('courses'); // Cursussen overzicht
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy'); // Profiel verwijderen
        Route::patch('/', [ProfileController::class, 'update'])->name('update'); // Profiel update actie
        Route::get('/security', [ProfileController::class, 'edit'])->name('security'); // Beveiligingsinstellingen

        Route::prefix('chats')->name('chats.')->group(function () {
            Route::get('/', [ChatController::class, 'index'])->name('index'); // Lijst van gesprekken
            Route::get('/{conversation}', [ChatController::class, 'show'])->name('show'); // Specifiek gesprek tonen
            Route::post('/{conversation}/message', [MessageController::class, 'store'])->name('message.store'); // Bericht versturen in een gesprek
            Route::get('/start/{tutorId}', [ChatController::class, 'startOrOpen'])->name('startOrOpen'); // Start of open gesprek met tutor
        });

        Route::prefix('reservations')->name('reservations.')->group(function () {
            Route::get('/', [ReservationUserController::class, 'index'])->name('index'); // Alle reserveringen ophalen van de ingelogde gebruiker
            Route::get('/{reservation}', [ReservationUserController::class, 'show'])->name('show'); // Specifieke reservering ophalen
            Route::patch('/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('updateStatus');
            Route::get('/create', [ReservationController::class, 'create'])->name('create'); // Formulier voor het aanmaken van een reservering
            Route::put('/{id}', [ReservationController::class, 'update'])->name('update'); // Reservering bijwerken
            Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit'); // Formulier voor het bewerken van een reservering
        });
    });

    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store'); // Reservering opslaan
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy'); // Reservering verwijderen

    Route::get('/password', [PasswordController::class, 'update'])->name('password.update'); // Wachtwoord wijzigen
    Route::delete('/{id}', [UserCourseController::class, 'destroy'])->name('tutor_course.destroy'); // Cursus van een tutor verwijderen
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
        Route::put('/{id}', [CourseController::class, 'update'])->name('update');
        Route::get('/{id}', [CourseController::class, 'edit'])->name('edit');
    });

    Route::prefix('institutions')->name('institutions.')->group(function () {
        Route::get('/', [InstitutionController::class, 'index'])->name('index');
        Route::get('/create', [InstitutionController::class, 'create'])->name('create');
        Route::post('/', [InstitutionController::class, 'store'])->name('store');
        Route::delete('/{id}', [InstitutionController::class, 'destroy'])->name('destroy');
        Route::put('/{id}', [InstitutionController::class, 'update'])->name('update');
        Route::get('/{id}', [InstitutionController::class, 'edit'])->name('edit');
    });

    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('/', [FAQCategoryController::class, 'index'])->name('index');
        Route::post('/', [FAQCategoryController::class, 'store'])->name('faq_category.store');
        Route::get('/category/create', [FAQCategoryController::class, 'create'])->name('faq_category.create');
        Route::get('/question/{id}', [FAQQuestionController::class, 'index'])->name('faq_questions.index');    
        Route::get('/question/create/{category_id}', [FAQQuestionController::class, 'create'])->name('faq_questions.create');
        Route::post('/question', [FAQQuestionController::class, 'store'])->name('faq_questions.store');
        Route::delete('/category/{id}', [FAQCategoryController::class, 'destroy'])->name('faq_category.destroy');
        Route::delete('/question/{id}', [FAQQuestionController::class, 'destroy'])->name('faq_questions.destroy');
        Route::put('/category/update/{id}', [FAQCategoryController::class, 'update'])->name('faq_category.update');
        Route::get('/category/update/{id}', [FAQCategoryController::class, 'edit'])->name('faq_category.edit');    
        Route::put('/question/update/{category_id}/{question_id}', [FAQQuestionController::class, 'update'])->name('faq_question.update');
        Route::get('/question/update/{id}', [FAQQuestionController::class, 'edit'])->name('faq_question.edit');    
    });

    Route::prefix('newsItems')->name('news_items.')->group(function () {
        Route::post('/', [NewsItemController::class, 'store'])->name('store');    
        Route::get('/create', [NewsItemController::class, 'create'])->name('create');    
        Route::get('/', [NewsItemController::class, 'index'])->name('index');
        Route::delete('/{id}', [NewsItemController::class, 'destroy'])->name('destroy');
        Route::put('/{id}', [NewsItemController::class, 'update'])->name('update');
        Route::get('/{id}', [NewsItemController::class, 'edit'])->name('edit');
    });


});

require __DIR__.'/auth.php';

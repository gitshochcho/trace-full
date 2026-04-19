<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;




Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/team', [App\Http\Controllers\HomeController::class, 'team'])->name('team');
Route::get('/teamdetails', [App\Http\Controllers\HomeController::class, 'teamdetails'])->name('teamdetails');
Route::get('/projects', [App\Http\Controllers\HomeController::class, 'projects'])->name('projects');
Route::get('/projectdetails', [App\Http\Controllers\HomeController::class, 'projectdetails'])->name('projectdetails');


Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/service-details/{id}', [App\Http\Controllers\HomeController::class, 'serviceDetails'])->name('serviceDetails');
Route::get('/insights', [App\Http\Controllers\HomeController::class, 'insights'])->name('insights');
Route::get('/article-details/{id}', [App\Http\Controllers\HomeController::class, 'articleDetails'])->name('articleDetails');
Route::get('/career', [App\Http\Controllers\HomeController::class, 'career'])->name('career');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::post('validate/login', [App\Http\Controllers\HomeController::class, 'validateLogin'])->name('loginCheck');
Route::get('/register', [App\Http\Controllers\HomeController::class, 'registration'])->name('registration');
Route::post('store/register', [App\Http\Controllers\HomeController::class, 'storRegistration'])->name('storRegistration');
Route::get('forget/password', [App\Http\Controllers\HomeController::class, 'loadForgetMyPass'])->name('forgetMyPass');
Route::post('user/check', [App\Http\Controllers\HomeController::class, 'searchUser'])->name('searchUser');
Route::match(['get', 'post'], 'user/load/otp', [HomeController::class, 'userOtpLoad'])->name('userOtpLoad');
Route::post('validate/user/otp', [HomeController::class, 'validateUserOtp'])->name('validateUserOtp');
Route::post('update/user/pass', [HomeController::class, 'updateUserPassword'])->name('updateUserPassword');

// socialite

Route::get('google/oauth/load', [App\Http\Controllers\HomeController::class, 'googleOauthLoad'])->name('googleOauthLoad');
Route::get('google/auth/callback', [App\Http\Controllers\HomeController::class, 'googleOauthCallBack'])->name('googleOauthCallBack');




Route::prefix('user')->group(function () {

    Route::middleware(['auth'])->group(function () {

        Route::controller(HomeController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('user.dashboard');
            Route::get('logout', 'logout')->name('user.logout');
        //     Route::post('store', 'store');
        //     Route::post('update/{survey:uuid}', 'update');
        //     Route::get('show/{survey:uuid}', 'show');
        //     Route::get('cheak/status/{survey:uuid}', 'cheakStatus');
        });

    });

    // Route::get('user/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('user.dashboard');
    Route::prefix('surveys')->group(function () {

        // Route::controller(HomeController::class)->group(function () {
        //     Route::get('list', 'index');
        //     Route::post('store', 'store');
        //     Route::post('update/{survey:uuid}', 'update');
        //     Route::get('show/{survey:uuid}', 'show');
        //     Route::get('cheak/status/{survey:uuid}', 'cheakStatus');
        // });
    });

    // Route::prefix('question')->group(function () {
    //     Route::controller(QuestionController::class)->group(function () {
    //         Route::get('list/', 'index');
    //         Route::post('store', 'store');
    //         Route::post('update/{question}', 'update');
    //         Route::get('show/{question}', 'show');
    //         Route::post('delete/{question}', 'destroy');

    //     });
    // });

    // Route::prefix('option')->group(function () {
    //     Route::controller(QuestionOptionController::class)->group(function () {
    //         Route::get('list/', 'index');
    //         Route::post('store', 'store');
    //         Route::post('update/{questionOption}', 'update');
    //         Route::get('show/{questionOption}', 'show');
    //         Route::post('delete/{questionOption}', 'destroy');

    //     });
    // });


    // Route::prefix('participant')->group(function () {
    //     Route::controller(SurveyParticipantController::class)->group(function () {
    //         Route::post('store', 'store');
    //         Route::get('list/', 'index');
    //         Route::post('update/{questionOption}', 'update');
    //         Route::get('show/{questionOption}', 'show');
    //         Route::post('delete/{questionOption}', 'destroy');

    //     });
    // });

    // Route::prefix('participant/answer')->group(function () {
    //     Route::controller(ParticipantAnswerController::class)->group(function () {
    //         Route::post('store', 'store');
    //         Route::get('list/', 'index');
    //         Route::post('update/{questionOption}', 'update');
    //         Route::get('show/{questionOption}', 'show');
    //         Route::post('delete/{questionOption}', 'destroy');

    //     });
    // });

    // Route::prefix('graph')->group(function () {
    //     Route::controller(SurveyGraph::class)->group(function () {

    //         Route::get('participant/{survey:uuid}', 'participantGraph');
    //         Route::get('question/{survey:uuid}', 'questionGraph');


    //     });
    // });

});

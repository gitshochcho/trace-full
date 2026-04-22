<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ContactInfoController;

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {

     Route::controller(AdminController::class)->group(function () {
                Route::get('login', 'adminLogin')->name('adminLogin');
                Route::get('load/forgetpass', 'loadForgetMyPass')->name('loadForgetMyPass');
                Route::post('find/user', 'findUser')->name('findUser');
                Route::post('validate/login', 'adminValidateLogin')->name('adminValidateLogin');
                Route::post('update/password', 'updatePassword')->name('updatePassword');
                Route::post('validate/otp', 'validateOtp')->name('validateOtp');


        //     Route::post('update/{survey:uuid}', 'update');
        //     Route::get('show/{survey:uuid}', 'show');
        //     Route::get('cheak/status/{survey:uuid}', 'cheakStatus');
         });
         Route::match(['get', 'post'], 'load/otp', [AdminController::class, 'otpLoad'])->name('otpLoad');

    Route::middleware(['auth:admin'])->group(function () {

        Route::controller(AdminController::class)->group(function () {
            Route::get('dashboard', 'dashboard')->name('admin.dashboard');
            Route::get('logout', 'logout')->name('admin.logout');

        });

        Route::controller(SettingsController::class)->group(function () {
            Route::get('settings', 'edit')->name('admin.settings.edit');
            Route::post('settings', 'update')->name('admin.settings.update');
        });

        Route::controller(ContentController::class)->group(function () {
            Route::get('content', 'index')->name('admin.content.index');
            Route::post('content', 'store')->name('admin.content.store');
            Route::get('content/{content}/edit', 'edit')->name('admin.content.edit');
            Route::put('content/{content}', 'update')->name('admin.content.update');
            Route::delete('content/{content}', 'destroy')->name('admin.content.destroy');
        });

        Route::controller(ServiceController::class)->group(function () {
            Route::get('services-manager', 'index')->name('admin.services.index');
            Route::post('services-manager', 'store')->name('admin.services.store');
            Route::get('services-manager/{service}/edit', 'edit')->name('admin.services.edit');
            Route::put('services-manager/{service}', 'update')->name('admin.services.update');
            Route::delete('services-manager/{service}', 'destroy')->name('admin.services.destroy');
        });

        Route::controller(ProjectController::class)->group(function () {
            Route::get('projects-manager', 'index')->name('admin.projects.index');
            Route::post('projects-manager', 'store')->name('admin.projects.store');
            Route::get('projects-manager/{project}/edit', 'edit')->name('admin.projects.edit');
            Route::put('projects-manager/{project}', 'update')->name('admin.projects.update');
            Route::delete('projects-manager/{project}', 'destroy')->name('admin.projects.destroy');
        });

        Route::controller(SliderController::class)->group(function () {
            Route::get('slider', 'edit')->name('admin.slider.edit');
            Route::post('slider', 'update')->name('admin.slider.update');
        });

        Route::controller(ContactMessageController::class)->group(function () {
            Route::get('contact-messages', 'index')->name('admin.contact-messages.index');
            Route::get('contact-messages/{id}', 'show')->name('admin.contact-messages.show');
            Route::delete('contact-messages/{id}', 'destroy')->name('admin.contact-messages.destroy');
        });

        Route::controller(ContactInfoController::class)->group(function () {
            Route::get('contact-info', 'index')->name('admin.contact-info.index');
            Route::get('contact-info/create', 'create')->name('admin.contact-info.create');
            Route::post('contact-info', 'store')->name('admin.contact-info.store');
            Route::get('contact-info/{contactInfo}/edit', 'edit')->name('admin.contact-info.edit');
            Route::put('contact-info/{contactInfo}', 'update')->name('admin.contact-info.update');
            Route::delete('contact-info/{contactInfo}', 'destroy')->name('admin.contact-info.destroy');
        });

    });

});

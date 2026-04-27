<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\InsightController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\JobPostingController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\InsightTypeController;


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

        Route::controller(TeamController::class)->group(function () {
            Route::get('teams-manager', 'index')->name('admin.teams.index');
            Route::post('teams-manager', 'store')->name('admin.teams.store');
            Route::get('teams-manager/{team}/edit', 'edit')->name('admin.teams.edit');
            Route::put('teams-manager/{team}', 'update')->name('admin.teams.update');
            Route::delete('teams-manager/{team}', 'destroy')->name('admin.teams.destroy');
        });

        Route::controller(PartnerController::class)->group(function () {
    Route::get('partners', 'index')->name('admin.partners.index');
    Route::get('partners/create', 'create')->name('admin.partners.create');
    Route::post('partners', 'store')->name('admin.partners.store');
    Route::get('partners/{partner}/edit', 'edit')->name('admin.partners.edit');
    Route::put('partners/{partner}', 'update')->name('admin.partners.update');
    Route::delete('partners/{partner}', 'destroy')->name('admin.partners.destroy');
});

        Route::controller(InsightController::class)->group(function () {
            Route::get('insights-manager', 'index')->name('admin.insights.index');
            Route::post('insights-manager', 'store')->name('admin.insights.store');

           Route::get('/insights/{insight}', 'show')->name('admin.insights.show');

            Route::get('insights-manager/{insight}/edit', 'edit')->name('admin.insights.edit');
            Route::put('insights-manager/{insight}', 'update')->name('admin.insights.update');
            Route::delete('insights-manager/{insight}', 'destroy')->name('admin.insights.destroy');
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

        Route::controller(JobPostingController::class)->group(function () {
            Route::get('job-postings', 'index')->name('admin.job-postings.index');
            Route::get('job-postings/create', 'create')->name('admin.job-postings.create');
            Route::post('job-postings', 'store')->name('admin.job-postings.store');
            Route::get('job-postings/{jobPosting}', 'show')->name('admin.job-postings.show');
            Route::get('job-postings/{jobPosting}/edit', 'edit')->name('admin.job-postings.edit');
            Route::put('job-postings/{jobPosting}', 'update')->name('admin.job-postings.update');
            Route::delete('job-postings/{jobPosting}', 'destroy')->name('admin.job-postings.destroy');
        });

        Route::controller(JobApplicationController::class)->group(function () {
            Route::get('job-applications', 'index')->name('admin.job-applications.index');
            Route::get('job-applications/{application}', 'show')->name('admin.job-applications.show');
            Route::get('job-applications/{application}/download-cv', 'downloadCv')->name('admin.job-applications.download-cv');
            Route::post('job-applications/{application}/mark-reviewed', 'markReviewed')->name('admin.job-applications.mark-reviewed');
        });

        Route::controller(InsightTypeController::class)->group(function () {
            Route::get('insight-types', 'index')->name('admin.insight-types.index');
            Route::post('insight-types', 'store')->name('admin.insight-types.store');
            Route::get('insight-types/{insightType}/edit', 'edit')->name('admin.insight-types.edit');
            Route::put('insight-types/{insightType}', 'update')->name('admin.insight-types.update');
            Route::delete('insight-types/{insightType}', 'destroy')->name('admin.insight-types.destroy');
        });

    });

});

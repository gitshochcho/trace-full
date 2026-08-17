<?php

namespace App\Providers;
use App\Http\Controllers\SitemapController;
use App\Models\InsightArticle;
use App\Models\JobPosting;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Team;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         Paginator::useBootstrapFive();
        View::share('siteSettings', $this->loadSiteSettings());
        // Make `setting` available in all views (used by admin sidebar)
        View::share('setting', $this->loadSiteSettings());

        Gate::before(function ($user, $ability) {
            return $user->hasRole('SuperAdmin') ? true : null;
        });

        View::composer('admin.layout.sidebar', function ($view) {
        $setting = Cache::remember('site_settings', 3600, function () {
            return Setting::with('media')->first();
        });
        $view->with('setting', $setting);
    });

        foreach ([Service::class, Project::class, Team::class, InsightArticle::class, JobPosting::class] as $model) {
            $model::saved(fn () => Cache::forget(SitemapController::CACHE_KEY));
            $model::deleted(fn () => Cache::forget(SitemapController::CACHE_KEY));
        }
    }

    private function loadSiteSettings(): ?Setting
    {
        if (app()->runningInConsole() || ! Schema::hasTable('settings')) {
            return null;
        }

        return Cache::remember('site_settings', now()->addHour(), function () {
            return Setting::query()->with('media')->first();
        });
    }
}

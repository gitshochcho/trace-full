<?php

namespace App\Http\Controllers;

use App\Models\Innovation;
use App\Models\Insight;
use App\Models\InsightArticle;
use App\Models\JobPosting;
use App\Models\Project;
use App\Models\Service;
use App\Models\Team;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public const CACHE_KEY = 'sitemap_xml';

    public function index()
    {
        $xml = cache()->remember(self::CACHE_KEY, now()->addHours(6), function () {
            return $this->build()->render();
        });

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }

    protected function build(): Sitemap
    {
        $sitemap = Sitemap::create();

        $staticRoutes = [
            ['name' => 'home', 'priority' => 1.0],
            ['name' => 'about', 'priority' => 0.8],
            ['name' => 'team', 'priority' => 0.7],
            ['name' => 'projects', 'priority' => 0.8],
            ['name' => 'services', 'priority' => 0.8],
            ['name' => 'insights', 'priority' => 0.7],
            ['name' => 'latestUpdates', 'priority' => 0.6],
            ['name' => 'innovations', 'priority' => 0.6],
            ['name' => 'career', 'priority' => 0.6],
            ['name' => 'contact', 'priority' => 0.6],
        ];

        foreach ($staticRoutes as $route) {
            $sitemap->add(
                Url::create(route($route['name']))
                    ->setPriority($route['priority'])
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );
        }

        Service::query()->where('active', true)->each(function (Service $service) use ($sitemap) {
            $sitemap->add(
                Url::create(route('serviceDetails', $service->id))
                    ->setLastModificationDate($service->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        Project::query()->each(function (Project $project) use ($sitemap) {
            $sitemap->add(
                Url::create(route('projectdetails', $project))
                    ->setLastModificationDate($project->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        Team::query()->each(function (Team $team) use ($sitemap) {
            $sitemap->add(
                Url::create(route('teamdetails', $team))
                    ->setLastModificationDate($team->updated_at)
                    ->setPriority(0.5)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        InsightArticle::query()->where('active', true)->each(function (InsightArticle $article) use ($sitemap) {
            $sitemap->add(
                Url::create(route('articleDetails', $article))
                    ->setLastModificationDate($article->updated_at)
                    ->setPriority(0.6)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        JobPosting::query()->where('is_active', true)->each(function (JobPosting $job) use ($sitemap) {
            $sitemap->add(
                Url::create(route('careerdetails', $job->id))
                    ->setLastModificationDate($job->updated_at)
                    ->setPriority(0.5)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );
        });

        return $sitemap;
    }
}

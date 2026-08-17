<?php

namespace Database\Seeders;

use App\Models\PageSetting;
use Illuminate\Database\Seeder;

class PageSettingSeeder extends Seeder
{
    public function run(): void
    {
        foreach (PageSetting::PAGE_DEFAULTS as $pageSlug => $defaults) {
            PageSetting::updateOrCreate(
                ['page_slug' => $pageSlug],
                $defaults + ['og_type' => 'website']
            );
        }
    }
}

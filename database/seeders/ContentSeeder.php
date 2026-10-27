<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    /**
     * Move the JSON page catalogues (services.json + company.json) into SQLite
     * so the admin panel can edit them. Existing rows are refreshed on reseed.
     */
    public function run(): void
    {
        $services = json_decode(file_get_contents(resource_path('data/services.json')), true, 512, JSON_THROW_ON_ERROR);
        $company = json_decode(file_get_contents(resource_path('data/company.json')), true, 512, JSON_THROW_ON_ERROR);

        foreach ($services as $service) {
            Page::updateOrCreate(
                ['slug' => $service['slug']],
                [
                    'type' => Page::TYPE_SERVICE,
                    'title' => $service['h1'],
                    'description' => Str::limit(strip_tags($service['lead']), 155, '…'),
                    'theme' => $service['theme'],
                    'status' => 'published',
                    'content' => $service,
                ],
            );
        }

        foreach ($company['company'] as $slug => $page) {
            Page::updateOrCreate(
                ['slug' => $slug],
                [
                    'type' => Page::TYPE_COMPANY,
                    'title' => $page['title'],
                    'description' => $page['desc'],
                    'theme' => str_starts_with($slug, 'about') || $slug === 'careers' ? 'theme-violet' : 'theme-indigo',
                    'status' => 'published',
                    'content' => $page,
                ],
            );
        }

        foreach ($company['legal'] as $slug => $page) {
            Page::updateOrCreate(
                ['slug' => $slug],
                [
                    'type' => Page::TYPE_LEGAL,
                    'title' => $page['title'],
                    'description' => $page['desc'],
                    'theme' => 'theme-indigo',
                    'status' => 'published',
                    'content' => $page,
                ],
            );
        }
    }
}

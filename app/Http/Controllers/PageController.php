<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    /**
     * About us page.
     */
    public function about(): View
    {
        return $this->companyPage('about');
    }

    /**
     * Careers page.
     */
    public function careers(): View
    {
        return $this->companyPage('careers');
    }

    /**
     * Press & media page.
     */
    public function press(): View
    {
        return $this->companyPage('press');
    }

    /**
     * Help centre page.
     */
    public function help(): View
    {
        return $this->companyPage('help');
    }

    /**
     * Contact page — the form posts to the admin workspace.
     */
    public function contact(): View
    {
        return view('contact', ['description' => 'Get in touch with WebServicers — fill out the form to request a call back about your website, SEO or advertising.']);
    }

    /**
     * Pricing overview — one card per published service.
     */
    public function pricing(): View
    {
        $iconKeys = [
            'google-search-ads' => 'search',
            'google-shopping-ads' => 'cart',
            'facebook-ads' => 'users',
            'instagram-ads' => 'camera',
            'seo' => 'chart',
            'google-my-business' => 'map',
            'marketing-analytics' => 'gauge',
            'website' => 'globe',
            'website-design' => 'palette',
        ];

        $services = Page::query()
            ->published()
            ->ofType(Page::TYPE_SERVICE)
            ->orderBy('id')
            ->get();

        $plans = $services->map(function (Page $service) use ($iconKeys): array {
            $tiers = $service->content['pricing']['tiers'] ?? [];

            return [
                'slug' => $service->slug,
                'label' => $service->content['crumb'] ?? $service->title,
                'tag' => $service->content['eyebrow'] ?? 'Service',
                'theme' => $service->theme ?? ($service->content['theme'] ?? 'theme-indigo'),
                'price' => $tiers[0]['price'] ?? '$0',
                'icon' => $iconKeys[$service->slug] ?? 'bolt',
            ];
        });

        return view('pricing', [
            'plans' => $plans,
            'description' => 'Plans and pricing for websites, SEO, advertising, local listings and analytics.',
        ]);
    }

    /**
     * Terms of Service.
     */
    public function terms(): View
    {
        return $this->legalPage('terms');
    }

    /**
     * Privacy Policy.
     */
    public function privacy(): View
    {
        return $this->legalPage('privacy');
    }

    /**
     * Sitemap — every page in one list.
     */
    public function sitemap(): View
    {
        return view('sitemap', ['description' => 'All pages on the WebServicers website.']);
    }

    /**
     * Render a company content page (about, careers, press, help).
     */
    private function companyPage(string $key): View
    {
        $row = Page::query()
            ->where('slug', $key)
            ->where('type', Page::TYPE_COMPANY)
            ->published()
            ->first();

        abort_unless($row, 404);

        return view("company.{$key}", [
            'page' => $row->content,
            'theme' => $row->theme ?: 'theme-indigo',
            'metaTitle' => $row->title,
            'description' => $row->description,
        ]);
    }

    /**
     * Render a legal document page (terms, privacy).
     */
    private function legalPage(string $key): View
    {
        $row = Page::query()
            ->where('slug', $key)
            ->where('type', Page::TYPE_LEGAL)
            ->published()
            ->first();

        abort_unless($row, 404);

        return view('legal', [
            'page' => $row->content,
            'theme' => $row->theme ?: 'theme-indigo',
            'metaTitle' => $row->title,
            'description' => $row->description,
        ]);
    }
}

<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Contracts\View\View as ViewInstance;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // The hosting preview serves this app over TLS behind a proxy. Any
        // host that is not a loopback address or literal IP is a public
        // domain reached over https, so force https URL generation —
        // otherwise asset() emits http:// links that browsers block as
        // mixed content and the page renders unstyled.
        $host = str_replace(['[', ']'], '', request()->host());

        $isLocal = $host === ''
            || strtolower($host) === 'localhost'
            || filter_var($host, FILTER_VALIDATE_IP) !== false;

        if (! $isLocal) {
            URL::forceScheme('https');
        }

        // Settings → General drives the public site's brand defaults without
        // querying from Blade views. Composers run when a layout renders —
        // not at boot — so artisan commands (e.g. migrate on a fresh
        // database) and tests never touch the settings table early.
        View::composer(['layouts.app', 'admin.layout'], function (ViewInstance $view): void {
            $view->with([
                'siteName' => Setting::get('site_name', 'WebServicers'),
                'siteDescription' => Setting::get('meta_description', 'We build premium websites that reflect your brand and grow your business with SEO, Google Ads, and social advertising.'),
            ]);
        });
    }
}

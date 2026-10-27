<?php

/*
|--------------------------------------------------------------------------
| Admin workspace menu
|--------------------------------------------------------------------------
| Mirrors the reference dashboard structure. Inventory and Marketplace are
| intentionally excluded per the project brief.
*/

return [
    'menu' => [
        [
            'label' => 'Operate',
            'items' => [
                ['label' => 'Overview', 'route' => 'admin.overview', 'icon' => 'home'],
                [
                    'label' => 'Products',
                    'icon' => 'box',
                    'children' => [
                        ['label' => 'Products', 'route' => 'admin.products.index', 'icon' => 'box'],
                        ['label' => 'Variants & options', 'resource' => 'variants'],
                        ['label' => 'Categories', 'resource' => 'categories'],
                        ['label' => 'Attributes', 'resource' => 'attributes'],
                        ['label' => 'Brands', 'resource' => 'brands'],
                        ['label' => 'Collections', 'resource' => 'collections'],
                        ['label' => 'Tags', 'resource' => 'tags'],
                        ['label' => 'Reviews & ratings', 'resource' => 'reviews'],
                    ],
                ],
                [
                    'label' => 'Orders',
                    'icon' => 'receipt',
                    'children' => [
                        ['label' => 'Orders', 'route' => 'admin.orders.index', 'icon' => 'receipt'],
                        ['label' => 'Fulfillment & tracking', 'resource' => 'fulfillment'],
                        ['label' => 'Delivery & shipment tracking', 'resource' => 'deliveries'],
                        ['label' => 'Carriers & service levels', 'resource' => 'carriers'],
                        ['label' => 'Returns', 'resource' => 'returns'],
                        ['label' => 'Refund requests', 'resource' => 'refund_requests'],
                        ['label' => 'Cancellations', 'resource' => 'cancellations'],
                        ['label' => 'Abandoned checkouts', 'resource' => 'abandoned_checkouts'],
                    ],
                ],
                [
                    'label' => 'Customers',
                    'icon' => 'users',
                    'children' => [
                        ['label' => 'Customers', 'route' => 'admin.customers.index', 'icon' => 'users'],
                        ['label' => 'Customer segments', 'resource' => 'segments'],
                    ],
                ],
            ],
        ],
        [
            'label' => 'Commerce',
            'items' => [
                [
                    'label' => 'Checkout & pricing',
                    'icon' => 'tag',
                    'children' => [
                        ['label' => 'Checkout experience', 'resource' => 'checkout_experience'],
                        ['label' => 'Checkout payment methods', 'resource' => 'payment_methods'],
                        ['label' => 'Coupons', 'resource' => 'coupons'],
                        ['label' => 'Automatic discounts', 'resource' => 'automatic_discounts'],
                        ['label' => 'Promotions', 'resource' => 'promotions'],
                        ['label' => 'Gift cards', 'resource' => 'gift_cards'],
                        ['label' => 'Campaigns', 'resource' => 'campaigns'],
                    ],
                ],
                [
                    'label' => 'Online store',
                    'icon' => 'store',
                    'children' => [
                        ['label' => 'Online store', 'route' => 'admin.store.index', 'icon' => 'store'],
                        ['label' => 'Menus & mega menus', 'resource' => 'menus'],
                        ['label' => 'Store pages', 'route' => 'admin.store.pages'],
                        ['label' => 'Blog posts', 'resource' => 'blog'],
                        ['label' => 'Testimonials', 'resource' => 'testimonials'],
                        ['label' => 'Contact messages', 'route' => 'admin.messages.index'],
                        ['label' => 'Popups & announcements', 'resource' => 'popups'],
                        ['label' => 'FAQ library', 'resource' => 'faqs'],
                    ],
                ],
                [
                    'label' => 'Payments',
                    'icon' => 'card',
                    'children' => [
                        ['label' => 'Transactions', 'resource' => 'transactions'],
                        ['label' => 'Payment providers', 'resource' => 'payment_providers'],
                        ['label' => 'Settlements', 'resource' => 'settlements'],
                        ['label' => 'Payment links', 'resource' => 'payment_links'],
                    ],
                ],
            ],
        ],
        [
            'label' => 'Grow & connect',
            'items' => [
                [
                    'label' => 'Reports',
                    'icon' => 'chart',
                    'children' => [
                        ['label' => 'Sales report', 'route' => 'admin.reports.sales'],
                        ['label' => 'Orders report', 'route' => 'admin.reports.orders'],
                        ['label' => 'Products report', 'route' => 'admin.reports.products'],
                        ['label' => 'Customers report', 'route' => 'admin.reports.customers'],
                        ['label' => 'Returns report', 'route' => 'admin.reports.returns'],
                        ['label' => 'Channels report', 'route' => 'admin.reports.channels'],
                        ['label' => 'Payments report', 'route' => 'admin.reports.payments'],
                        ['label' => 'Marketing report', 'route' => 'admin.reports.marketing'],
                    ],
                ],
            ],
        ],
        [
            'label' => 'Communication',
            'items' => [
                ['label' => 'Customer inbox', 'route' => 'admin.inbox.index', 'icon' => 'inbox'],
                ['label' => 'Support tickets', 'resource' => 'tickets'],
                ['label' => 'Email workspace', 'resource' => 'email'],
                ['label' => 'Message templates', 'resource' => 'email_templates'],
                ['label' => 'Notifications & activity', 'route' => 'admin.notifications.index'],
            ],
        ],
        [
            'label' => 'WebServicers AI',
            'items' => [
                ['label' => 'AI workflows', 'resource' => 'ai_workflows'],
                ['label' => 'AI studio', 'resource' => 'ai_studio'],
                ['label' => 'Voice & product assist', 'resource' => 'ai_voice'],
                ['label' => 'AI knowledge', 'resource' => 'ai_knowledge'],
                ['label' => 'Prompt library', 'resource' => 'ai_prompts'],
                ['label' => 'AI reply rules', 'resource' => 'ai_rules'],
                ['label' => 'AI activity & usage', 'resource' => 'ai_history'],
            ],
        ],
        [
            'label' => 'Media & files',
            'items' => [
                ['label' => 'Media library', 'resource' => 'media'],
                ['label' => 'File manager', 'resource' => 'files'],
            ],
        ],
        [
            'label' => 'Workspace',
            'items' => [
                ['label' => 'Team members', 'route' => 'admin.team.index', 'icon' => 'users'],
                ['label' => 'Roles', 'resource' => 'roles'],
                ['label' => 'Permission matrix', 'resource' => 'permissions'],
                ['label' => 'Teams', 'resource' => 'teams'],
                ['label' => 'Activity log', 'route' => 'admin.activity.index'],
            ],
        ],
        [
            'label' => 'Integrations',
            'items' => [
                ['label' => 'API connections', 'resource' => 'integrations'],
                ['label' => 'Webhooks', 'resource' => 'webhooks'],
            ],
        ],
        [
            'label' => 'Settings',
            'items' => [
                ['label' => 'General settings', 'route' => 'admin.settings.general'],
                ['label' => 'Branding', 'route' => 'admin.settings.branding'],
                ['label' => 'Language & currency', 'route' => 'admin.settings.localization'],
                ['label' => 'Store SEO', 'route' => 'admin.settings.seo'],
                ['label' => 'Maintenance mode', 'route' => 'admin.settings.maintenance'],
                ['label' => 'Marketing connections', 'route' => 'admin.settings.marketing'],
                ['label' => 'Tax rules', 'route' => 'admin.settings.tax'],
                ['label' => 'Shipping zones & rates', 'route' => 'admin.settings.shipping'],
                ['label' => 'Notification preferences', 'route' => 'admin.settings.notifications'],
                ['label' => 'Email delivery', 'route' => 'admin.settings.email'],
                ['label' => 'Storage settings', 'route' => 'admin.settings.storage'],
                ['label' => 'Security', 'route' => 'admin.settings.security'],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Settings pages (each writes keys into the settings table)
    |--------------------------------------------------------------------------
    */

    'settings' => [
        'general' => [
            'label' => 'General settings',
            'description' => 'Your site identity, browser title, contact details and preferences.',
            'fields' => [
                'site_name' => ['label' => 'Site name', 'required' => true],
                'browser_title' => ['label' => 'Browser / tab title', 'required' => true],
                'tagline' => ['label' => 'Tagline'],
                'support_email' => ['label' => 'Customer support email', 'type' => 'email', 'required' => true],
                'support_phone' => ['label' => 'Support phone'],
                'business_address' => ['label' => 'Business address'],
            ],
        ],
        'branding' => [
            'label' => 'Branding',
            'description' => 'Logos, colours and the identity shown across the site and workspace.',
            'fields' => [
                'brand_primary' => ['label' => 'Primary colour', 'type' => 'color'],
                'brand_accent' => ['label' => 'Accent colour', 'type' => 'color'],
                'brand_wordmark' => ['label' => 'Wordmark text', 'hint' => 'Shown next to the logo mark.'],
                'favicon_path' => ['label' => 'Favicon path', 'hint' => 'Defaults to /assets/img/favicon.svg.'],
            ],
        ],
        'localization' => [
            'label' => 'Language & currency',
            'description' => 'How money, dates and language are displayed.',
            'fields' => [
                'language' => ['label' => 'Language', 'type' => 'select', 'options' => ['English', 'Danish', 'German', 'French', 'Spanish']],
                'currency' => ['label' => 'Currency', 'type' => 'select', 'options' => ['USD', 'EUR', 'GBP', 'DKK', 'SEK']],
                'timezone' => ['label' => 'Timezone', 'type' => 'select', 'options' => ['Europe/Copenhagen', 'Europe/London', 'Europe/Berlin', 'America/New_York', 'UTC']],
                'date_format' => ['label' => 'Date format', 'type' => 'select', 'options' => ['1 Oct 2026', '2026-10-01', '01/10/2026']],
            ],
        ],
        'seo' => [
            'label' => 'Store SEO',
            'description' => 'Defaults applied to the public site when a page has no specific meta.',
            'fields' => [
                'meta_description' => ['label' => 'Default meta description', 'type' => 'textarea', 'required' => true],
                'seo_title_template' => ['label' => 'Title template', 'hint' => 'Use %s where the page name goes.'],
                'og_image_path' => ['label' => 'Social share image path'],
                'robots_txt' => ['label' => 'Robots policy', 'type' => 'select', 'options' => ['index,follow', 'noindex,nofollow']],
            ],
        ],
        'maintenance' => [
            'label' => 'Maintenance mode',
            'description' => 'Take the public site offline while the workspace stays available.',
            'fields' => [
                'maintenance_mode' => ['label' => 'Enable maintenance mode', 'type' => 'toggle'],
                'maintenance_message' => ['label' => 'Notice line', 'type' => 'textarea'],
            ],
        ],
        'marketing' => [
            'label' => 'Marketing connections',
            'description' => 'Advertising and analytics connections used across campaigns.',
            'fields' => [
                'ga_measurement_id' => ['label' => 'Google Analytics ID'],
                'gtm_container' => ['label' => 'GTM container ID'],
                'meta_pixel_id' => ['label' => 'Meta pixel ID'],
                'google_ads_id' => ['label' => 'Google Ads customer ID'],
            ],
        ],
        'tax' => [
            'label' => 'Tax rules',
            'description' => 'How tax is applied to plans and one-off work.',
            'fields' => [
                'tax_rate' => ['label' => 'Default tax rate (%)', 'type' => 'number'],
                'tax_included' => ['label' => 'Prices include tax', 'type' => 'toggle'],
                'tax_number' => ['label' => 'Tax / VAT number'],
            ],
        ],
        'shipping' => [
            'label' => 'Shipping zones & rates',
            'description' => 'Delivery expectations shown during checkout for physical goods.',
            'fields' => [
                'shipping_enabled' => ['label' => 'Enable shipping estimates', 'type' => 'toggle'],
                'shipping_zones' => ['label' => 'Zones', 'type' => 'textarea'],
                'shipping_note' => ['label' => 'Checkout note'],
            ],
        ],
        'notifications' => [
            'label' => 'Notification preferences',
            'description' => 'Choose what lands in your workspace bell and inbox.',
            'fields' => [
                'notify_new_orders' => ['label' => 'New orders', 'type' => 'toggle'],
                'notify_new_messages' => ['label' => 'New contact messages', 'type' => 'toggle'],
                'notify_weekly_report' => ['label' => 'Weekly report digest', 'type' => 'toggle'],
            ],
        ],
        'email' => [
            'label' => 'Email delivery',
            'description' => 'The from-identity used for every outgoing message.',
            'fields' => [
                'email_from_name' => ['label' => 'From name', 'required' => true],
                'email_from_address' => ['label' => 'From address', 'type' => 'email', 'required' => true],
                'email_footer' => ['label' => 'Footer line', 'type' => 'textarea'],
            ],
        ],
        'storage' => [
            'label' => 'Storage settings',
            'description' => 'Where uploads and exports are kept.',
            'fields' => [
                'storage_driver' => ['label' => 'Driver', 'type' => 'select', 'options' => ['local', 's3', 'r2']],
                'storage_max_size' => ['label' => 'Max upload size (MB)', 'type' => 'number'],
                'storage_keep_days' => ['label' => 'Keep trashed files (days)', 'type' => 'number'],
            ],
        ],
        'security' => [
            'label' => 'Security',
            'description' => 'Access rules for the workspace and the signed-in account.',
            'fields' => [
                'session_timeout' => ['label' => 'Session lifetime (minutes)', 'type' => 'number'],
                'two_factor_required' => ['label' => 'Require two-factor for admins', 'type' => 'toggle'],
                'password_min' => ['label' => 'Minimum password length', 'type' => 'number'],
            ],
        ],
    ],
];

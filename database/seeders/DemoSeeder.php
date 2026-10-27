<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\ContactMessage;
use App\Models\Customer;
use App\Models\Notice;
use App\Models\Order;
use App\Models\Record;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Settings defaults plus realistic demo data so every dashboard,
     * report and inbox page has something to show on first run.
     */
    public function run(): void
    {
        $this->seedSettings();
        $this->seedCustomers();
        $this->seedOrders();
        $this->seedMessages();
        $this->seedNotices();
        $this->seedActivities();
        $this->seedRecords();
    }

    private function seedSettings(): void
    {
        Setting::setMany([
            'site_name' => 'WebServicers',
            'tagline' => 'Online success platform.',
            'browser_title' => 'WebServicers',
            'meta_description' => 'We build premium websites that reflect your brand and grow your business with SEO, Google Ads, and social advertising.',
            'support_email' => 'hello@webservicers.com',
            'support_phone' => '+1 202 555 0100',
            'business_address' => 'Copenhagen, Denmark',
            'currency' => 'USD',
            'language' => 'English',
            'timezone' => 'Europe/Copenhagen',
            'maintenance_mode' => '0',
            'seo_title_template' => '%s — WebServicers',
            'notify_new_orders' => '1',
            'notify_new_messages' => '1',
            'notify_weekly_report' => '1',
            'email_from_name' => 'WebServicers',
            'email_from_address' => 'hello@webservicers.com',
            'tax_rate' => '20',
            'shipping_enabled' => '1',
            'storage_driver' => 'local',
            'session_timeout' => '120',
            'two_factor_required' => '0',
        ]);
    }

    private function seedCustomers(): void
    {
        if (Customer::query()->exists()) {
            return;
        }

        $rows = [
            ['Nora Mitchell', 'nora@brightbloom.co', '+1 415 555 0110', 'Bright Bloom Florists', 'active'],
            ['Liam Patel', 'liam@patelplumbing.com', '+1 415 555 0111', 'Patel Plumbing', 'active'],
            ['Sofia Alvarez', 'sofia@alvarezlaw.com', '+1 415 555 0112', 'Alvarez Law', 'active'],
            ['Ethan Brooks', 'ethan@brooksfitness.io', '+1 415 555 0113', 'Brooks Fitness', 'active'],
            ['Maya Chen', 'maya@studiomaya.com', '+1 415 555 0114', 'Studio Maya', 'active'],
            ['Oliver Grant', 'oliver@grantmotors.com', '+1 415 555 0115', 'Grant Motors', 'lead'],
            ['Amelia Rossi', 'amelia@rossidental.it', '+39 06 555 0116', 'Rossi Dental', 'active'],
            ['Lucas Meyer', 'lucas@meyer-bau.de', '+49 30 555 0117', 'Meyer Bau', 'active'],
            ['Isabella Costa', 'isabella@costahotel.pt', '+351 21 555 0118', 'Costa Hotel', 'active'],
            ['Noah Jensen', 'noah@jensenauto.dk', '+45 33 555 0119', 'Jensen Auto', 'active'],
            ['Ava Thompson', 'ava@pawandco.com', '+1 415 555 0120', 'Paw & Co', 'lead'],
            ['William Dubois', 'william@duboisbistro.fr', '+33 1 555 0121', 'Dubois Bistro', 'active'],
            ['Emma Larsson', 'emma@larssondesign.se', '+46 8 555 0122', 'Larsson Design', 'active'],
            ['James Okafor', 'james@okaforconsult.ng', '+234 1 555 0123', 'Okafor Consulting', 'churned'],
            ['Mia Novak', 'mia@novakstudio.cz', '+420 2 555 0124', 'Novak Studio', 'active'],
            ['Benjamin Lee', 'ben@leeinsurance.com', '+1 415 555 0125', 'Lee Insurance', 'active'],
            ['Charlotte Wong', 'charlotte@wongeats.com', '+1 415 555 0126', 'Wong Eats', 'active'],
            ['Henry Kowalski', 'henry@kowalskiroofing.pl', '+48 22 555 0127', 'Kowalski Roofing', 'lead'],
            ['Ella Andersen', 'ella@andersenco.dk', '+45 33 555 0128', 'Andersen & Co', 'active'],
            ['Alexander Ivanov', 'alex@northpeakgear.com', '+1 415 555 0129', 'Northpeak Gear', 'active'],
            ['Grace Mensah', 'grace@mensahcraft.gh', '+233 30 555 0130', 'Mensah Craft', 'active'],
            ['Leo Ferrari', 'leo@ferraricafe.it', '+39 06 555 0131', 'Ferrari Cafe', 'active'],
            ['Chloe Martin', 'chloe@martinevents.fr', '+33 1 555 0132', 'Martin Events', 'active'],
            ['Daniel Silva', 'daniel@silvafit.pt', '+351 21 555 0133', 'Silva Fit', 'churned'],
            ['Harper Evans', 'harper@evansagency.com', '+1 415 555 0134', 'Evans Agency', 'active'],
            ['Sebastian Berg', 'sebastian@bergelektronik.de', '+49 30 555 0135', 'Berg Elektronik', 'active'],
            ['Evelyn Wright', 'evelyn@wrightdental.com', '+1 415 555 0136', 'Wright Dental', 'active'],
            ['Oscar Lind', 'oscar@lindbygg.se', '+46 8 555 0137', 'Lind Bygg', 'lead'],
            ['Lily Turner', 'lily@turnerbooks.co.uk', '+44 20 555 0138', 'Turner Books', 'active'],
            ['Jack Murphy', 'jack@murphybrew.ie', '+353 1 555 0139', 'Murphy Brew', 'active'],
        ];

        foreach ($rows as $i => $row) {
            Customer::create([
                'name' => $row[0],
                'email' => $row[1],
                'phone' => $row[2],
                'company' => $row[3],
                'status' => $row[4],
                'last_active_on' => now()->subDays($i % 21),
            ]);
        }
    }

    private function seedOrders(): void
    {
        if (Order::query()->exists()) {
            return;
        }

        $services = [
            ['google-search-ads', 'Google Search Ads'],
            ['google-shopping-ads', 'Google Shopping Ads'],
            ['facebook-ads', 'Facebook Ads'],
            ['instagram-ads', 'Instagram Ads'],
            ['seo', 'SEO Tool'],
            ['google-my-business', 'Google My Business'],
            ['marketing-analytics', 'Marketing Analytics'],
            ['website', 'Website'],
            ['website-design', 'Website Design'],
        ];

        $statuses = ['completed', 'paid', 'in_progress', 'completed', 'paid', 'completed', 'pending', 'completed', 'paid', 'cancelled'];
        $amounts = [149, 249, 149, 149, 199, 49, 99, 19, 149, 0];
        $customers = Customer::query()->get();

        for ($i = 0; $i < 56; $i++) {
            $customer = $customers[$i % $customers->count()];
            [$slug, $label] = $services[$i % count($services)];
            $status = $statuses[$i % count($statuses)];
            $amount = $amounts[$i % count($amounts)];

            if ($status === 'completed' && $i % 7 === 3) {
                $amount += 900; // bigger build projects
            }

            if ($status === 'cancelled') {
                $amount = 0;
            }

            Order::create([
                'reference' => 'WS-'.(1042 - $i),
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'service' => $label,
                'amount' => $amount,
                'status' => $status,
                'placed_on' => now()->subDays((int) floor($i * 1.07)),
            ]);
        }
    }

    private function seedMessages(): void
    {
        if (ContactMessage::query()->exists()) {
            return;
        }

        $rows = [
            ['Nora Mitchell', 'nora@brightbloom.co', '+1 415 555 0110', 'Website', 'We need a new site for our flower shops — can you share timelines and a rough quote?', 'replied'],
            ['Oliver Grant', 'oliver@grantmotors.com', '+1 415 555 0115', 'Google Search Ads', 'Our ad spend is up but leads are flat. Looking for someone to audit the account.', 'read'],
            ['Ava Thompson', 'ava@pawandco.com', '+1 415 555 0120', 'Not sure yet — advise me', 'Honestly not sure what we need. We are a pet store that wants more walk-ins.', 'new'],
            ['Henry Kowalski', 'henry@kowalskiroofing.pl', '+48 22 555 0127', 'Google My Business', 'Our map listing keeps dropping out of the local pack. Can you fix that?', 'new'],
            ['Lily Turner', 'lily@turnerbooks.co.uk', '+44 20 555 0138', 'SEO Tool', 'Do you handle content as well as technical SEO? We publish weekly.', 'read'],
            ['Mia Novak', 'mia@novakstudio.cz', '+420 2 555 0124', 'Website Design', 'We rebranded and the old site looks nothing like us anymore.', 'new'],
        ];

        foreach ($rows as $i => $row) {
            ContactMessage::create([
                'name' => $row[0],
                'email' => $row[1],
                'phone' => $row[2],
                'service' => $row[3],
                'message' => $row[4],
                'status' => $row[5],
                'created_at' => now()->subHours(5 + $i * 9),
                'updated_at' => now()->subHours(5 + $i * 9),
            ]);
        }
    }

    private function seedNotices(): void
    {
        if (Notice::query()->exists()) {
            return;
        }

        $rows = [
            ['New order WS-1042', 'Search ads campaign for Nora Mitchell — $149/mo.', 'order', null],
            ['New contact message', 'Ava Thompson asked to be advised on what she needs.', 'message', null],
            ['Payment received', 'Order WS-1040 settled — $249.00.', 'success', null],
            ['Weekly report ready', 'Organic traffic is up 12% week over week.', 'info', now()->subDay()],
            ['Domain renewal soon', 'webservicers.com renews in 30 days.', 'warning', now()->subDays(2)],
            ['Welcome to your workspace', 'Everything you sell and publish lives here.', 'info', now()->subDays(4)],
        ];

        foreach ($rows as $row) {
            Notice::create([
                'title' => $row[0],
                'body' => $row[1],
                'kind' => $row[2],
                'read_at' => $row[3],
            ]);
        }
    }

    private function seedActivities(): void
    {
        if (Activity::query()->exists()) {
            return;
        }

        $rows = [
            ['seeded', 'Catalogue imported from JSON', ['pages' => 17]],
            ['order.paid', 'Order WS-1040 marked paid', null],
            ['page.published', 'Page google-search-ads published', null],
            ['settings.updated', 'General settings updated', ['field' => 'support_email']],
            ['message.read', 'Contact message from Mia Novak marked read', null],
            ['login', 'Signed in from Copenhagen', null],
        ];

        foreach ($rows as $i => $row) {
            Activity::create([
                'user_id' => null,
                'action' => $row[0],
                'subject' => $row[1],
                'data' => $row[2],
                'created_at' => now()->subHours(2 + $i * 7),
            ]);
        }
    }

    private function seedRecords(): void
    {
        $demo = [
            'coupons' => [
                ['code' => 'WELCOME10', 'discount' => '10% off', 'used' => '128 uses', 'status' => 'Active'],
                ['code' => 'LAUNCH25', 'discount' => '$25 off', 'used' => '54 uses', 'status' => 'Active'],
                ['code' => 'SUMMER2025', 'discount' => '15% off', 'used' => '301 uses', 'status' => 'Expired'],
            ],
            'categories' => [
                ['name' => 'Presence', 'slug' => 'presence', 'sort' => '1', 'status' => 'Published'],
                ['name' => 'Reach', 'slug' => 'reach', 'sort' => '2', 'status' => 'Published'],
                ['name' => 'Promote', 'slug' => 'promote', 'sort' => '3', 'status' => 'Published'],
                ['name' => 'Company', 'slug' => 'company', 'sort' => '4', 'status' => 'Published'],
            ],
            'blog' => [
                ['title' => 'What a $500 ad budget actually buys in 2026', 'author' => 'Jonas Berg', 'category' => 'Advertising', 'status' => 'Published'],
                ['title' => 'Local SEO in ten minutes a week', 'author' => 'Priya Raman', 'category' => 'SEO', 'status' => 'Published'],
                ['title' => 'Why your homepage is not converting', 'author' => 'Maya Chen', 'category' => 'Design', 'status' => 'Draft'],
            ],
            'testimonials' => [
                ['customer' => 'Nora Mitchell', 'company' => 'Bright Bloom Florists', 'rating' => '5.0', 'status' => 'Published'],
                ['customer' => 'Noah Jensen', 'company' => 'Jensen Auto', 'rating' => '4.9', 'status' => 'Published'],
                ['customer' => 'Mia Novak', 'company' => 'Novak Studio', 'rating' => '5.0', 'status' => 'Pending'],
            ],
            'faqs' => [
                ['question' => 'How long does a website take?', 'category' => 'Websites', 'status' => 'Published'],
                ['question' => 'Do you charge a setup fee?', 'category' => 'Billing', 'status' => 'Published'],
                ['question' => 'Who owns the ad accounts?', 'category' => 'Advertising', 'status' => 'Published'],
                ['question' => 'Can I pause my plan?', 'category' => 'Billing', 'status' => 'Draft'],
            ],
            'reviews' => [
                ['customer' => 'Ethan Brooks', 'service' => 'SEO Tool', 'rating' => '4.8', 'status' => 'Approved'],
                ['customer' => 'Emma Larsson', 'service' => 'Website Design', 'rating' => '5.0', 'status' => 'Approved'],
                ['customer' => 'Jack Murphy', 'service' => 'Facebook Ads', 'rating' => '4.6', 'status' => 'Pending'],
            ],
            'transactions' => [
                ['reference' => 'TX-88421', 'customer' => 'Nora Mitchell', 'amount' => '$149.00', 'method' => 'Card', 'status' => 'Succeeded'],
                ['reference' => 'TX-88420', 'customer' => 'Noah Jensen', 'amount' => '$249.00', 'method' => 'Card', 'status' => 'Succeeded'],
                ['reference' => 'TX-88419', 'customer' => 'Oliver Grant', 'amount' => '$0.00', 'method' => 'Card', 'status' => 'Failed'],
                ['reference' => 'TX-88418', 'customer' => 'Mia Novak', 'amount' => '$199.00', 'method' => 'SEPA', 'status' => 'Succeeded'],
            ],
            'tickets' => [
                ['subject' => 'Cannot access Google Ads account', 'requester' => 'Oliver Grant', 'priority' => 'High', 'status' => 'Open'],
                ['subject' => 'Change the CTA colour on the homepage', 'requester' => 'Nora Mitchell', 'priority' => 'Low', 'status' => 'Open'],
                ['subject' => 'Invoice for March', 'requester' => 'Liam Patel', 'priority' => 'Normal', 'status' => 'Resolved'],
            ],
            'email_templates' => [
                ['name' => 'Welcome email', 'subject' => 'Welcome to WebServicers', 'updated' => '2 days ago', 'status' => 'Active'],
                ['name' => 'Monthly report', 'subject' => 'Your monthly growth report', 'updated' => '1 week ago', 'status' => 'Active'],
                ['name' => 'Invoice receipt', 'subject' => 'Your payment receipt', 'updated' => '3 weeks ago', 'status' => 'Active'],
            ],
            'media' => [
                ['name' => 'logo.svg', 'type' => 'SVG', 'size' => '1 KB', 'status' => 'Used on 19 pages'],
                ['name' => 'favicon.svg', 'type' => 'SVG', 'size' => '1 KB', 'status' => 'Used on 19 pages'],
                ['name' => 'marketing-collage.svg', 'type' => 'SVG', 'size' => '5 KB', 'status' => 'In use'],
                ['name' => 'seo-laptop.svg', 'type' => 'SVG', 'size' => '4 KB', 'status' => 'In use'],
            ],
            'integrations' => [
                ['name' => 'Google Ads', 'type' => 'Advertising', 'status' => 'Connected'],
                ['name' => 'Meta Business', 'type' => 'Advertising', 'status' => 'Connected'],
                ['name' => 'Google Analytics', 'type' => 'Analytics', 'status' => 'Connected'],
                ['name' => 'Stripe', 'type' => 'Payments', 'status' => 'Not connected'],
            ],
            'roles' => [
                ['name' => 'Admin', 'members' => '1 member', 'access' => 'Full access', 'status' => 'Active'],
                ['name' => 'Editor', 'members' => '0 members', 'access' => 'Content only', 'status' => 'Active'],
                ['name' => 'Viewer', 'members' => '0 members', 'access' => 'Read only', 'status' => 'Active'],
            ],
            'teams' => [
                ['name' => 'Growth', 'lead' => 'Jonas Berg', 'members' => '8 members', 'status' => 'Active'],
                ['name' => 'Design', 'lead' => 'Maya Chen', 'members' => '6 members', 'status' => 'Active'],
            ],
            'campaigns' => [
                ['name' => 'Spring local push', 'channel' => 'Google Search', 'budget' => '$1,200/mo', 'status' => 'Active'],
                ['name' => 'Retargeting — site visitors', 'channel' => 'Meta', 'budget' => '$600/mo', 'status' => 'Paused'],
            ],
            'promotions' => [
                ['name' => 'First month half price', 'channel' => 'All channels', 'value' => '50%', 'status' => 'Active'],
                ['name' => 'Bundle: SEO + GMB', 'channel' => 'Website', 'value' => '20%', 'status' => 'Scheduled'],
            ],
            'menus' => [
                ['name' => 'Primary navigation', 'location' => 'Header', 'items' => '14 items', 'status' => 'Active'],
                ['name' => 'Footer links', 'location' => 'Footer', 'items' => '18 items', 'status' => 'Active'],
            ],
            'webhooks' => [
                ['name' => 'Order created', 'event' => 'order.created', 'url' => 'https://hooks.webservicers.com/orders', 'status' => 'Active'],
                ['name' => 'Message received', 'event' => 'message.created', 'url' => 'https://hooks.webservicers.com/inbox', 'status' => 'Active'],
            ],
            'carriers' => [
                ['name' => 'DHL Express', 'level' => 'International', 'zones' => 'EU, UK, US', 'status' => 'Active'],
                ['name' => 'PostNord', 'level' => 'Standard', 'zones' => 'Nordics', 'status' => 'Active'],
            ],
            'segments' => [
                ['name' => 'Big spenders', 'rule' => 'Lifetime value > $1,000', 'customers' => '12', 'status' => 'Active'],
                ['name' => 'At risk', 'rule' => 'No order in 60 days', 'customers' => '5', 'status' => 'Active'],
            ],
            'payment_methods' => [
                ['name' => 'Credit card', 'provider' => 'Stripe', 'fee' => '2.9% + 30¢', 'status' => 'Active'],
                ['name' => 'SEPA transfer', 'provider' => 'Stripe', 'fee' => '€0.35', 'status' => 'Active'],
            ],
            'permissions' => [
                ['module' => 'Pages', 'role' => 'Admin', 'access' => 'Full', 'status' => 'Granted'],
                ['module' => 'Pages', 'role' => 'Editor', 'access' => 'Edit', 'status' => 'Granted'],
                ['module' => 'Settings', 'role' => 'Editor', 'access' => 'None', 'status' => 'Denied'],
            ],
        ];

        foreach ($demo as $resource => $rows) {
            foreach ($rows as $row) {
                Record::create(['resource' => $resource, 'data' => $row]);
            }
        }
    }
}

<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\RecordController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\BalanceController;
use App\Http\Controllers\Dashboard\BillingController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\TicketsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServicePageController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

// The public contact form lands in the admin workspace.
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Sign in / out.
Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
 * Company, legal and pricing pages.
 * Registered before the service catch-all for clarity, though the
 * catch-all is constrained to service slugs only.
 */
Route::controller(PageController::class)
    ->prefix('')->group(function (): void {
        Route::get('/pricing', 'pricing')->name('pricing');
        Route::get('/about', 'about')->name('about');
        Route::get('/contact', 'contact')->name('contact');
        Route::get('/help', 'help')->name('help');
        Route::get('/careers', 'careers')->name('careers');
        Route::get('/press', 'press')->name('press');
        Route::get('/terms', 'terms')->name('terms');
        Route::get('/privacy', 'privacy')->name('privacy');
        Route::get('/sitemap', 'sitemap')->name('sitemap');
    });

Route::get('/{slug}', ServicePageController::class)
    ->whereIn('slug', [
        'google-search-ads',
        'google-shopping-ads',
        'facebook-ads',
        'instagram-ads',
        'seo',
        'google-my-business',
        'marketing-analytics',
        'website',
        'website-design',
    ])
    ->name('page.show');

/*
 * Customer dashboard. Any signed-in user; every query inside is
 * scoped to the account (by user id or order email).
 */
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function (): void {
    Route::redirect('/', '/dashboard/orders')->name('home');

    // Orders + per-order conversation
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}/chat', [OrdersController::class, 'chat'])->name('orders.chat');
    Route::post('/orders/{order}/chat', [OrdersController::class, 'sendChat'])->name('orders.chat.send');

    // Support tickets + thread replies
    Route::get('/tickets', [TicketsController::class, 'index'])->name('tickets.index');
    Route::post('/tickets', [TicketsController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketsController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/replies', [TicketsController::class, 'reply'])->name('tickets.reply');

    // Balance, billing & invoices
    Route::get('/balance', [BalanceController::class, 'index'])->name('balance');
    Route::get('/billing', [BillingController::class, 'index'])->name('billing.index');
    Route::get('/billing/{invoice}', [BillingController::class, 'show'])->name('billing.show');

    // Profile settings (updates reuse the shared auth methods)
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AuthController::class, 'changePassword'])->name('profile.password');
});

/*
 * Admin workspace. Everything behind auth + the admin role check.
 */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function (): void {
    Route::redirect('/', '/admin/overview');

    // Operate → Overview
    Route::get('/overview', [DashboardController::class, 'overview'])->name('overview');

    // Products / store pages content
    Route::get('/products', [PageContentController::class, 'products'])->name('products.index');
    Route::get('/store-pages', [PageContentController::class, 'storePages'])->name('store.pages');
    Route::get('/pages/{page}/edit', [PageContentController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{page}', [PageContentController::class, 'update'])->name('pages.update');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    // Messages + inbox
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/inbox', [MessageController::class, 'inbox'])->name('inbox.index');
    Route::patch('/messages/{message}', [MessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // Online store overview
    Route::get('/store', [StoreController::class, 'index'])->name('store.index');

    // Reports
    foreach (['sales', 'orders', 'products', 'customers', 'returns', 'channels', 'payments', 'marketing'] as $report) {
        Route::get('/reports/'.$report, [ReportController::class, 'show'])
            ->defaults('report', $report)
            ->name('reports.'.$report);
    }

    // Generic resource CRUD (all remaining sidebar pages)
    Route::get('/records/{resource}', [RecordController::class, 'index'])->name('records.index');
    Route::get('/records/{resource}/create', [RecordController::class, 'create'])->name('records.create');
    Route::post('/records/{resource}', [RecordController::class, 'store'])->name('records.store');
    Route::get('/records/{resource}/{record}/edit', [RecordController::class, 'edit'])->name('records.edit');
    Route::put('/records/{resource}/{record}', [RecordController::class, 'update'])->name('records.update');
    Route::delete('/records/{resource}/{record}', [RecordController::class, 'destroy'])->name('records.destroy');

    // Settings
    foreach (['general', 'branding', 'localization', 'seo', 'maintenance', 'marketing', 'tax', 'shipping', 'notifications', 'email', 'storage', 'security'] as $settingsPage) {
        Route::get('/settings/'.$settingsPage, [SettingsController::class, 'edit'])
            ->defaults('page', $settingsPage)
            ->name('settings.'.$settingsPage);
        Route::put('/settings/'.$settingsPage, [SettingsController::class, 'update'])
            ->defaults('page', $settingsPage)
            ->name('settings.'.$settingsPage.'.update');
    }

    // Team & access
    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::post('/team', [TeamController::class, 'store'])->name('team.store');
    Route::put('/team/{user}', [TeamController::class, 'update'])->name('team.update');
    Route::delete('/team/{user}', [TeamController::class, 'destroy'])->name('team.destroy');

    // Notifications & activity
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{notice}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');
    Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');

    // Search + own profile
    Route::get('/search', SearchController::class)->name('search');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AuthController::class, 'changePassword'])->name('profile.password');
});

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Notice;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    /**
     * Communication → Notifications & activity.
     */
    public function index(): View
    {
        return view('admin.notifications.index', [
            'notices' => Notice::query()->latest()->get(),
            'activities' => Activity::query()->with('user')->latest('created_at')->paginate(15),
            'unread' => Notice::query()->unread()->count(),
        ]);
    }

    /**
     * Mark one notice read.
     */
    public function markRead(Notice $notice): RedirectResponse
    {
        $notice->update(['read_at' => now()]);

        return back();
    }

    /**
     * Mark every notice read.
     */
    public function markAllRead(): RedirectResponse
    {
        Notice::query()->unread()->update(['read_at' => now()]);

        return back()->with('status', 'All notifications marked read.');
    }
}

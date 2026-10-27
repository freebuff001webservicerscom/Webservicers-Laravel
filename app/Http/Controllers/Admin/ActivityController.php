<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Contracts\View\View;

class ActivityController extends Controller
{
    /**
     * Workspace → Activity log.
     */
    public function index(): View
    {
        return view('admin.activity.index', [
            'activities' => Activity::query()->with('user')->latest('created_at')->paginate(25),
        ]);
    }
}

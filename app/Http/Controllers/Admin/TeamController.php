<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Team members (users table).
     */
    public function index(): View
    {
        return view('admin.team.index', [
            'members' => User::query()->orderBy('name')->get(),
            'roles' => ['admin', 'editor', 'viewer'],
        ]);
    }

    /**
     * Create a team member.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email'],
            'job_title' => ['nullable', 'string', 'max:120'],
            'role' => ['required', 'in:admin,editor,viewer'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        User::create($data);

        Activity::record('team.created', $data['name'].' added to the workspace');

        return redirect()->route('admin.team.index')->with('status', 'Team member added.');
    }

    /**
     * Update a team member.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email,'.$user->id],
            'job_title' => ['nullable', 'string', 'max:120'],
            'role' => ['required', 'in:admin,editor,viewer'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if ($data['password'] === null || $data['password'] === '') {
            unset($data['password']);
        }

        // Never let the last admin demote themselves out of the workspace.
        if ($user->isAdmin() && $data['role'] !== 'admin' && User::admins()->count() <= 1) {
            return back()->withErrors(['role' => 'At least one admin must remain.']);
        }

        $user->update($data);

        Activity::record('team.updated', $data['name'].' updated');

        return back()->with('status', 'Team member updated.');
    }

    /**
     * Remove a team member.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($user->id === $request->user()->id) {
            return back()->withErrors(['member' => 'You cannot remove your own account.']);
        }

        if ($user->isAdmin() && User::admins()->count() <= 1) {
            return back()->withErrors(['member' => 'At least one admin must remain.']);
        }

        $user->delete();

        Activity::record('team.removed', 'Team member removed');

        return redirect()->route('admin.team.index')->with('status', 'Team member removed.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the sign-in screen.
     */
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.overview');
        }

        return view('auth.login');
    }

    /**
     * Attempt to sign the administrator in.
     *
     * @throws ValidationException
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        Activity::record('login', 'Signed in from '.$request->ip());

        return redirect()->intended(route('admin.overview'));
    }

    /**
     * Sign out and invalidate the session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Activity::record('logout', 'Signed out');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    /**
     * Change the signed-in user's password (Settings → Security).
     */
    public function changePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = $request->user();
        $user->password = $request->input('password');
        $user->save();

        Activity::record('password.changed', 'Password updated for '.$user->name);

        return back()->with('status', 'Password updated.');
    }

    /**
     * Update the signed-in user's profile (name and email).
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email,'.$request->user()->id],
        ]);

        $user = $request->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        Activity::record('profile.updated', 'Profile details updated');

        return back()->with('status', 'Profile updated.');
    }
}

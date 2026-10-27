@extends('dashboard.layout')

@section('pageTitle', 'Profile settings')
@section('crumb', 'Profile settings')

@section('content')
    <div class="page-head">
      <div>
        <h1>Profile settings<span class="dot">.</span></h1>
        <p class="page-sub">Your account details and password. Invoices and tickets always follow this email.</p>
      </div>
    </div>

    <div class="two-col">
        <div class="card card-pad">
            <p class="card-eyebrow">Account</p>
            <h3 class="card-title" style="margin-bottom:18px;">Profile details</h3>

            <form method="post" action="{{ route('dashboard.profile.update') }}">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <label class="field"><span>Full name *</span>
                        <input name="name" type="text" required maxlength="120" value="{{ old('name', $user->name) }}" />
                    </label>
                    <label class="field"><span>Email address *</span>
                        <input name="email" type="email" required maxlength="190" value="{{ old('email', $user->email) }}" />
                        @error('email')<small class="field-error" style="color:var(--danger);">{{ $message }}</small>@enderror
                    </label>
                    <label class="field"><span>Account role</span>
                        <input type="text" value="{{ ucfirst($user->role) }}" disabled />
                    </label>
                    <label class="field"><span>Member since</span>
                        <input type="text" value="{{ $user->created_at?->format('j M Y') ?? '—' }}" disabled />
                    </label>
                </div>
                <div class="modal-actions" style="justify-content:flex-start; margin-top:6px;">
                    <button class="btn btn-dark" type="submit">Save changes</button>
                </div>
            </form>
        </div>

        <div class="card card-pad">
            <p class="card-eyebrow">Security</p>
            <h3 class="card-title" style="margin-bottom:18px;">Change password</h3>

            <form method="post" action="{{ route('dashboard.profile.password') }}">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <label class="field"><span>Current password *</span>
                        <input name="current_password" type="password" required />
                        @error('current_password')<small style="color:var(--danger);">{{ $message }}</small>@enderror
                    </label>
                    <label class="field"><span>New password * <small style="color:var(--muted);">min 8 characters</small></span>
                        <input name="password" type="password" required minlength="8" />
                        @error('password')<small style="color:var(--danger);">{{ $message }}</small>@enderror
                    </label>
                    <label class="field"><span>Confirm new password *</span>
                        <input name="password_confirmation" type="password" required minlength="8" />
                    </label>
                </div>
                <div class="modal-actions" style="justify-content:flex-start; margin-top:6px;">
                    <button class="btn btn-dark" type="submit">Update password</button>
                </div>
            </form>
        </div>
    </div>
@endsection

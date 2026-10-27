@extends('admin.layout')

@section('pageTitle', $definition['label'])

@section('content')
    <div class="page-head">
      <div>
        <h1>{{ $definition['label'] }}<span class="dot">.</span></h1>
        <p class="page-sub">{{ $definition['description'] }}</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('home') }}" target="_blank" rel="noopener">View site ↗</a>
      </div>
    </div>

    @if ($errors->any())
        <div class="error-bag">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="settings-grid">
        <nav class="card settings-nav" aria-label="Settings sections">
            @foreach ($pages as $navKey => $navPage)
                @if ($navKey === 'tax')
                    <div class="nav-sep"></div>
                @endif
                <a class="{{ $navKey === $page ? 'is-active' : '' }}" href="{{ route('admin.settings.'.$navKey) }}">
                    {{ $navPage['label'] }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                </a>
            @endforeach

            <div class="nav-sep"></div>
            <a class="{{ request()->routeIs('admin.profile*') ? 'is-active' : '' }}" href="{{ route('admin.team.index') }}">
                Team &amp; access
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
            </a>
        </nav>

        <div class="card card-pad">
            <form method="post" action="{{ route('admin.settings.'.$page.'.update') }}">
                @csrf
                @method('PUT')

                <div class="form-section">
                    <h3>{{ $definition['label'] }}</h3>
                    <p class="section-desc">{{ $definition['description'] }} Saved values are used across the workspace and the public site.</p>

                    <div class="form-grid">
                        @foreach ($definition['fields'] as $key => $field)
                            @php
                                $type = $field['type'] ?? 'text';
                                $value = old($key, $values[$key] ?? '');
                            @endphp

                            @if ($type === 'textarea')
                                <label class="field span-2">
                                    <span>{{ $field['label'] }} @if (!empty($field['required']))<em>*</em>@endif</span>
                                    <textarea name="{{ $key }}" rows="3" data-grow>{{ $value }}</textarea>
                                    @if (!empty($field['hint']))<span class="hint">{{ $field['hint'] }}</span>@endif
                                    @error($key)<span class="err">{{ $message }}</span>@enderror
                                </label>
                            @elseif ($type === 'toggle')
                                <label class="field">
                                    <span>{{ $field['label'] }}</span>
                                    <label class="toggle">
                                        <input type="checkbox" name="{{ $key }}" value="1" @checked($value === '1') />
                                        <span class="track"></span>
                                        <span class="toggle-label">{{ $value === '1' ? 'On' : 'Off' }}</span>
                                    </label>
                                    @error($key)<span class="err">{{ $message }}</span>@enderror
                                </label>
                            @elseif ($type === 'select')
                                <label class="field">
                                    <span>{{ $field['label'] }} @if (!empty($field['required']))<em>*</em>@endif</span>
                                    <select name="{{ $key }}">
                                        @foreach ($field['options'] ?? [] as $option)
                                            <option value="{{ $option }}" @selected($value === $option)>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                    @error($key)<span class="err">{{ $message }}</span>@enderror
                                </label>
                            @elseif ($type === 'color')
                                <label class="field">
                                    <span>{{ $field['label'] }}</span>
                                    <input type="color" name="{{ $key }}" value="{{ $value !== '' ? $value : '#0c7c5a' }}" />
                                    @error($key)<span class="err">{{ $message }}</span>@enderror
                                </label>
                            @else
                                <label class="field">
                                    <span>{{ $field['label'] }} @if (!empty($field['required']))<em>*</em>@endif</span>
                                    <input type="{{ $type }}" name="{{ $key }}" value="{{ $value }}" placeholder="{{ $field['placeholder'] ?? '' }}" />
                                    @if (!empty($field['hint']))<span class="hint">{{ $field['hint'] }}</span>@endif
                                    @error($key)<span class="err">{{ $message }}</span>@enderror
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="form-actions">
                    <button class="btn btn-dark btn-lg" type="submit">Save changes</button>
                    <a class="btn btn-ghost btn-lg" href="{{ route('admin.overview') }}">Cancel</a>
                </div>
            </form>

            @if ($page === 'security')
                <div class="form-section" style="margin-top: 26px;">
                    <h3>Change your password</h3>
                    <p class="section-desc">Signed in as {{ auth()->user()->email }}.</p>

                    <form method="post" action="{{ route('admin.profile.password') }}">
                        @csrf
                        @method('PUT')
                        <div class="form-grid">
                            <label class="field span-2">
                                <span>Current password <em>*</em></span>
                                <input type="password" name="current_password" autocomplete="current-password" required />
                            </label>
                            <label class="field">
                                <span>New password <em>*</em></span>
                                <input type="password" name="password" autocomplete="new-password" required minlength="8" />
                            </label>
                            <label class="field">
                                <span>Confirm new password <em>*</em></span>
                                <input type="password" name="password_confirmation" autocomplete="new-password" required minlength="8" />
                            </label>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-dark" type="submit">Update password</button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection

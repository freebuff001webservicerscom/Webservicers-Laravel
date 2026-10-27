@extends('admin.layout')

@section('pageTitle', 'Edit — ' . $page->title)

@section('content')
    <div class="page-head">
      <div>
        <h1>{{ $page->slug }}<span class="dot">.</span></h1>
        <p class="page-sub">Everything below is stored in SQLite and served directly to the public site. Save to publish your changes.</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-ghost" href="{{ route('home') }}/{{ $page->slug }}" target="_blank" rel="noopener">Preview on site ↗</a>
        <a class="btn btn-white" href="{{ $page->type === 'service' ? route('admin.products.index') : route('admin.store.pages') }}">Back to list</a>
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

    <form method="post" action="{{ route('admin.pages.update', $page) }}">
        @csrf
        @method('PUT')

        <div class="card card-pad">
            <div class="form-section">
                <h3>Page meta</h3>
                <p class="section-desc">Used for the browser title, description and the theme accents on the public page.</p>

                <div class="form-grid">
                    <label class="field">
                        <span>Title <em>*</em></span>
                        <input type="text" name="title" value="{{ old('title', $page->title) }}" required />
                        @error('title')<span class="err">{{ $message }}</span>@enderror
                    </label>

                    <label class="field">
                        <span>Theme</span>
                        <select name="theme">
                            <option value="">— default —</option>
                            @foreach ($themes as $theme)
                                <option value="{{ $theme }}" @selected(old('theme', $page->theme) === $theme)>{{ $theme }}</option>
                            @endforeach
                        </select>
                    </label>

                    <label class="field span-2">
                        <span>Meta description</span>
                        <textarea name="description" rows="2" data-grow>{{ old('description', $page->description) }}</textarea>
                        @error('description')<span class="err">{{ $message }}</span>@enderror
                    </label>

                    <label class="field">
                        <span>Status <em>*</em></span>
                        <select name="status">
                            <option value="published" @selected(old('status', $page->status) === 'published')>Published — live on the site</option>
                            <option value="draft" @selected(old('status', $page->status) === 'draft')>Draft — hidden (404)</option>
                        </select>
                    </label>
                </div>
            </div>

            <div class="form-section">
                <h3>Page content</h3>
                <p class="section-desc">Sections rendered by the frontend template. Paired values use a single <code>a|b</code> line; lists use one value per line; advanced blocks accept JSON.</p>

                <div class="content-fields">
                    @foreach ($contentFields as $field)
                        @php
                            $inputName = 'content['.$field['path'].']';
                            $oldInput = old('content');
                            $current = is_array($oldInput) && array_key_exists($field['path'], $oldInput)
                                ? $oldInput[$field['path']]
                                : $field['value'];
                            $isLong = $field['type'] !== 'text';
                        @endphp
                        <label class="field {{ $isLong ? 'span-2' : '' }}">
                            <span>
                                {{ $field['label'] }}
                                @if ($field['hint'] !== '')
                                    <span class="content-path">· inside {{ $field['hint'] }}</span>
                                @endif
                            </span>

                            @if ($field['type'] === 'text')
                                <input type="text" name="{{ $inputName }}" value="{{ $current }}" data-grow />
                            @elseif ($field['type'] === 'textarea-json')
                                <textarea name="{{ $inputName }}" class="tall" rows="6">{{ $current }}</textarea>
                            @else
                                <textarea name="{{ $inputName }}" rows="2" data-grow>{{ $current }}</textarea>
                            @endif
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="form-actions">
                <button class="btn btn-dark btn-lg" type="submit">Save changes</button>
                <a class="btn btn-ghost btn-lg" href="{{ $page->type === 'service' ? route('admin.products.index') : route('admin.store.pages') }}">Cancel</a>
            </div>
        </div>
    </form>
@endsection

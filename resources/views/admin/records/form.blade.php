@extends('admin.layout')

@section('pageTitle', ($record ? 'Edit ' : 'New ') . $definition['singular'])

@section('content')
    @php $singular = $definition['singular']; @endphp

    <div class="page-head">
      <div>
        <h1>{{ $record ? 'Edit' : 'New' }} {{ strtolower($singular) }}<span class="dot">.</span></h1>
        <p class="page-sub">{{ $definition['description'] ?? 'Stored in the records table and rendered across the workspace.' }}</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-white" href="{{ route('admin.records.index', $resource) }}">Back to {{ strtolower($definition['label']) }}</a>
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

    <div class="card card-pad">
        <form method="post" action="{{ $record ? route('admin.records.update', [$resource, $record]) : route('admin.records.store', $resource) }}">
            @csrf
            @if ($record)@method('PUT')@endif

            <div class="form-grid">
                @foreach ($definition['fields'] as $key => $field)
                    @php
                        $value = old($key, $data[$key] ?? '');
                        $type = $field['type'] ?? 'text';
                        $options = $field['options'] ?? [];
                    @endphp

                    @if ($type === 'textarea')
                        <label class="field span-2">
                            <span>{{ $field['label'] }} @if (!empty($field['required']))<em>*</em>@endif</span>
                            <textarea name="{{ $key }}" rows="4" data-grow>{{ $value }}</textarea>
                            @error($key)<span class="err">{{ $message }}</span>@enderror
                        </label>
                    @elseif ($type === 'select')
                        <label class="field">
                            <span>{{ $field['label'] }} @if (!empty($field['required']))<em>*</em>@endif</span>
                            <select name="{{ $key }}">
                                <option value="">— select —</option>
                                @foreach ($options as $option)
                                    <option value="{{ $option }}" @selected($value === $option)>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error($key)<span class="err">{{ $message }}</span>@enderror
                        </label>
                    @elseif ($type === 'toggle')
                        <label class="field">
                            <span>{{ $field['label'] }}</span>
                            <label class="toggle">
                                <input type="checkbox" name="{{ $key }}" value="1" @checked($value === '1' || $value === 1 || $value === true) />
                                <span class="track"></span>
                                <span class="toggle-label">Enabled</span>
                            </label>
                        </label>
                    @else
                        <label class="field">
                            <span>{{ $field['label'] }} @if (!empty($field['required']))<em>*</em>@endif</span>
                            <input type="{{ $type === 'number' ? 'number' : ($type === 'email' ? 'email' : 'text') }}" name="{{ $key }}" value="{{ $value }}"
                                @if (!empty($field['hint'])) aria-describedby="{{ $key }}-hint" @endif />
                            @if (!empty($field['hint']))<span class="hint" id="{{ $key }}-hint">{{ $field['hint'] }}</span>@endif
                            @error($key)<span class="err">{{ $message }}</span>@enderror
                        </label>
                    @endif
                @endforeach
            </div>

            <div class="form-actions">
                <button class="btn btn-dark btn-lg" type="submit">{{ $record ? 'Save changes' : 'Create '.strtolower($singular) }}</button>
                <a class="btn btn-ghost btn-lg" href="{{ route('admin.records.index', $resource) }}">Cancel</a>
            </div>
        </form>

        @if ($record)
            <form class="inline-form" method="post" action="{{ route('admin.records.destroy', [$resource, $record]) }}" data-confirm="Delete this {{ strtolower($singular) }}? This cannot be undone." style="float: right;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-lg" type="submit">Delete</button>
            </form>
        @endif
    </div>
@endsection

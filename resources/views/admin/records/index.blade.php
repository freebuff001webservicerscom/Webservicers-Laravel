@extends('admin.layout')

@section('pageTitle', $definition['label'])

@section('content')
    <div class="page-head">
      <div>
        <h1>{{ $definition['label'] }}<span class="dot">.</span></h1>
        <p class="page-sub">{{ $definition['description'] ?? 'Managed from the workspace database.' }}</p>
      </div>
      <div class="page-actions">
        <a class="btn btn-dark" href="{{ route('admin.records.create', $resource) }}">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          New {{ strtolower($definition['singular']) }}
        </a>
      </div>
    </div>

    <div class="card">
      <div class="card-head bordered">
        <div>
          <p class="card-eyebrow">Workspace</p>
          <h3 class="card-title">{{ $definition['label'] }}</h3>
        </div>
        <span class="card-note">{{ $records->count() }} {{ Str::plural('record', $records->count()) }}</span>
      </div>

      @if ($records->isEmpty())
        <div class="empty">
          <span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'box'])</span>
          <h3>No {{ strtolower($definition['label']) }} yet</h3>
          <p>Create the first entry — it is stored straight in SQLite and shows up across the workspace.</p>
          <a class="btn btn-dark" href="{{ route('admin.records.create', $resource) }}">Add {{ strtolower($definition['singular']) }}</a>
        </div>
      @else
        <div class="table-wrap">
          <table class="table">
            <thead>
              <tr>
                @foreach ($definition['columns'] as $label)
                  <th>{{ $label }}</th>
                @endforeach
                <th>Updated</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($records as $index => $record)
                <tr>
                  @php $columnKeys = array_keys($definition['columns']); @endphp
                  @foreach ($columnKeys as $key)
                    @php $value = $record->data[$key] ?? '—'; @endphp
                    <td class="{{ $loop->first ? 'cell-main' : '' }}">
                      @if ($key === 'status' || $key === 'access' || $key === 'priority' || $key === 'mode')
                        @include('partials.admin.pill', ['value' => $value])
                      @elseif ($loop->first)
                        {{ $value }}
                      @else
                        {{ $value }}
                      @endif
                    </td>
                  @endforeach
                  <td>{{ $record->updated_at->diffForHumans(short: true) }}</td>
                  <td>
                    <div class="row-actions">
                      <a class="icon-btn" href="{{ route('admin.records.edit', [$resource, $record]) }}" title="Edit">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h4L20 8l-4-4L4 16v4Z"/><path d="m14 6 4 4"/></svg>
                      </a>
                      <form class="inline-form" method="post" action="{{ route('admin.records.destroy', [$resource, $record]) }}" data-confirm="Delete this {{ strtolower($definition['singular']) }}? This cannot be undone.">
                        @csrf
                        @method('DELETE')
                        <button class="icon-btn" type="submit" title="Delete">
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16M9 7V4h6v3M6.5 7l1 13h9l1-13M10 11v5M14 11v5"/></svg>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
@endsection

@extends('admin.layout')

@section('pageTitle', 'Team members')

@section('content')
    <div class="page-head">
      <div>
        <h1>Team members<span class="dot">.</span></h1>
        <p class="page-sub">Who can enter this workspace. Roles decide what each member sees and changes.</p>
      </div>
      <div class="page-actions">
        <button class="btn btn-dark" type="button" data-open-modal="memberModal">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          Add member
        </button>
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

    <div class="card">
      <div class="card-head bordered">
        <div>
          <p class="card-eyebrow">Workspace</p>
          <h3 class="card-title">Members</h3>
        </div>
        <span class="card-note">{{ $members->count() }} {{ Str::plural('member', $members->count()) }}</span>
      </div>

      <div class="table-wrap">
        <table class="table">
          <thead>
            <tr>
              <th>Member</th>
              <th>Role</th>
              <th>Job title</th>
              <th>Joined</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($members as $member)
              <tr>
                <td>
                  <div class="cell-with-avatar">
                    <span class="avatar {{ ['v2', 'v3', 'v4'][$member->id % 3] }}">{!! strtoupper(mb_substr($member->name, 0, 1)) !!}</span>
                    <div>
                      <div class="cell-main">{{ $member->name }}{{ $member->id === auth()->id() ? ' (you)' : '' }}</div>
                      <div class="cell-sub">{{ $member->email }}</div>
                    </div>
                  </div>
                </td>
                <td>@include('partials.admin.pill', ['value' => ucfirst($member->role)])</td>
                <td>{{ $member->job_title ?? '—' }}</td>
                <td>{{ $member->created_at?->format('j M Y') ?? '—' }}</td>
                <td>
                  <div class="row-actions">
                    <button class="icon-btn" type="button" title="Edit member" data-open-modal="member-{{ $member->id }}">
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h4L20 8l-4-4L4 16v4Z"/><path d="m14 6 4 4"/></svg>
                    </button>
                    @if ($member->id !== auth()->id())
                      <form class="inline-form" method="post" action="{{ route('admin.team.destroy', $member) }}" data-confirm="Remove {{ $member->name }} from the workspace?">
                        @csrf
                        @method('DELETE')
                        <button class="icon-btn" type="submit" title="Remove member">
                          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16M9 7V4h6v3M6.5 7l1 13h9l1-13M10 11v5M14 11v5"/></svg>
                        </button>
                      </form>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    @foreach ($members as $member)
      <div class="modal-backdrop" id="member-{{ $member->id }}" hidden>
        <div class="modal" role="dialog" aria-modal="true" aria-label="Edit {{ $member->name }}">
          <div class="modal-head">
            <h3>Edit {{ $member->name }}</h3>
            <button class="icon-btn" type="button" data-close-modal aria-label="Close">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
            </button>
          </div>
          <form method="post" action="{{ route('admin.team.update', $member) }}">
            @csrf
            @method('PUT')
            <div class="form-grid">
              <label class="field"><span>Name <em>*</em></span><input type="text" name="name" value="{{ $member->name }}" required /></label>
              <label class="field"><span>Email <em>*</em></span><input type="email" name="email" value="{{ $member->email }}" required /></label>
              <label class="field"><span>Job title</span><input type="text" name="job_title" value="{{ $member->job_title }}" placeholder="Paid Media Lead" /></label>
              <label class="field"><span>Role</span>
                <select name="role">
                  @foreach ($roles as $role)
                    <option value="{{ $role }}" @selected($member->role === $role)>{{ ucfirst($role) }}</option>
                  @endforeach
                </select>
              </label>
              <label class="field span-2"><span>New password <span class="hint">leave blank to keep current</span></span>
                <input type="password" name="password" autocomplete="new-password" minlength="8" />
              </label>
            </div>
            <div class="modal-actions">
              <button class="btn btn-ghost" type="button" data-close-modal>Cancel</button>
              <button class="btn btn-dark" type="submit">Save</button>
            </div>
          </form>
        </div>
      </div>
    @endforeach

    <div class="modal-backdrop" id="memberModal" hidden>
      <div class="modal" role="dialog" aria-modal="true" aria-label="Add team member">
        <div class="modal-head">
          <h3>Add team member</h3>
          <button class="icon-btn" type="button" data-close-modal aria-label="Close">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
          </button>
        </div>
        <form method="post" action="{{ route('admin.team.store') }}">
          @csrf
          <div class="form-grid">
            <label class="field"><span>Name <em>*</em></span><input type="text" name="name" required placeholder="Alex Morgan" /></label>
            <label class="field"><span>Email <em>*</em></span><input type="email" name="email" required placeholder="teammate@webservicers.com" /></label>
            <label class="field"><span>Job title</span><input type="text" name="job_title" placeholder="SEO Strategist" /></label>
            <label class="field"><span>Role</span>
              <select name="role">
                @foreach ($roles as $role)
                  <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                @endforeach
              </select>
            </label>
            <label class="field span-2"><span>Temporary password <em>*</em></span>
              <input type="password" name="password" required minlength="8" autocomplete="new-password" placeholder="At least 8 characters" />
            </label>
          </div>
          <div class="modal-actions">
            <button class="btn btn-ghost" type="button" data-close-modal>Cancel</button>
            <button class="btn btn-dark" type="submit">Add member</button>
          </div>
        </form>
      </div>
    </div>
@endsection

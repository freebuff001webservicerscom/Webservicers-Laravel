@extends('dashboard.layout')

@section('pageTitle', 'Support tickets')
@section('crumb', 'Support tickets')

@section('content')
    <div class="page-head">
      <div>
        <h1>Support tickets<span class="dot">.</span></h1>
        <p class="page-sub">Open a ticket about anything — billing, campaigns, the website — and track every reply here.</p>
      </div>
      <div class="page-actions">
        <button class="btn btn-dark" type="button" data-open-modal="newTicketModal">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          New ticket
        </button>
      </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-blue">@include('partials.admin.icon', ['name' => 'inbox'])</span><span class="stat-hint">all time</span></div>
            <div class="stat-value"><strong>{{ $stats['total'] }}</strong><span class="stat-label">Total tickets</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'clock'])</span><span class="stat-hint">awaiting reply</span></div>
            <div class="stat-value"><strong>{{ $stats['open'] }}</strong><span class="stat-label">Open</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-top"><span class="chip tone-green">@include('partials.admin.icon', ['name' => 'target'])</span><span class="stat-hint">closed out</span></div>
            <div class="stat-value"><strong>{{ $stats['resolved'] }}</strong><span class="stat-label">Resolved</span></div>
        </div>
    </div>

    <div class="card">
        <div class="card-head bordered">
            <div>
                <p class="card-eyebrow">Communication</p>
                <h3 class="card-title">Your tickets</h3>
            </div>
            <span class="card-note">{{ $tickets->total() }} {{ Str::plural('ticket', $tickets->total()) }}</span>
        </div>

        @if ($tickets->isEmpty())
            <div class="empty">
                <span class="chip tone-amber">@include('partials.admin.icon', ['name' => 'inbox'])</span>
                <h3>No tickets yet</h3>
                <p>Need a change or hit a snag? Open a ticket and the team replies here.</p>
                <button class="btn btn-dark" type="button" data-open-modal="newTicketModal">Open your first ticket</button>
            </div>
        @else
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Priority</th>
                            <th>Replies</th>
                            <th>Last activity</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td class="cell-main">{{ $ticket->subject }}</td>
                                <td>@include('partials.admin.pill', ['value' => $ticket->priority])</td>
                                <td>{{ $ticket->replies_count }}</td>
                                <td>{{ $ticket->last_message_at?->diffForHumans(short: true) ?? $ticket->created_at->diffForHumans(short: true) }}</td>
                                <td>@include('partials.admin.pill', ['value' => $ticket->status])</td>
                                <td>
                                    <div class="row-actions">
                                        <a class="icon-btn" href="{{ route('dashboard.tickets.show', $ticket) }}" title="Open ticket">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5h16v11H9l-5 4V5Z"/><path d="M8 9h8M8 12.5h5"/></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @include('partials.admin.pagination', ['paginator' => $tickets])
        @endif
    </div>

    <!-- New ticket modal -->
    <div class="modal-backdrop" id="newTicketModal" hidden>
        <div class="modal" role="dialog" aria-modal="true" aria-label="New support ticket">
            <div class="modal-head">
                <h3>New support ticket</h3>
                <button class="icon-btn" type="button" data-close-modal aria-label="Close">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
                </button>
            </div>
            <form method="post" action="{{ route('dashboard.tickets.store') }}">
                @csrf
                <div class="form-grid">
                    <label class="field"><span>Subject *</span>
                        <input name="subject" type="text" required maxlength="160" placeholder="Can't update campaign budget" />
                    </label>
                    <label class="field"><span>Priority</span>
                        <select name="priority">
                            <option value="normal">Normal</option>
                            <option value="low">Low</option>
                            <option value="high">High</option>
                        </select>
                    </label>
                    <label class="field"><span>How can we help? *</span>
                        <textarea name="body" rows="5" required maxlength="4000" placeholder="Describe the issue or request…"></textarea>
                    </label>
                </div>
                <div class="modal-actions">
                    <button class="btn btn-ghost" type="button" data-close-modal>Cancel</button>
                    <button class="btn btn-dark" type="submit">Open ticket</button>
                </div>
            </form>
        </div>
    </div>
@endsection

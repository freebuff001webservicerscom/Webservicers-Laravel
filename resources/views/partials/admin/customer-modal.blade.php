<div class="modal-backdrop" id="customer-{{ $customer->id }}" hidden>
    <div class="modal" role="dialog" aria-modal="true" aria-label="Edit {{ $customer->name }}">
        <div class="modal-head">
            <h3>Edit {{ $customer->name }}</h3>
            <button class="icon-btn" type="button" data-close-modal aria-label="Close">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
            </button>
        </div>
        <form method="post" action="{{ route('admin.customers.update', $customer) }}">
            @csrf
            @method('PUT')
            <div class="form-grid">
                <label class="field"><span>Name <em>*</em></span><input type="text" name="name" value="{{ $customer->name }}" required /></label>
                <label class="field"><span>Email <em>*</em></span><input type="email" name="email" value="{{ $customer->email }}" required /></label>
                <label class="field"><span>Phone</span><input type="text" name="phone" value="{{ $customer->phone }}" /></label>
                <label class="field"><span>Company</span><input type="text" name="company" value="{{ $customer->company }}" /></label>
                <label class="field"><span>Status</span>
                    <select name="status">
                        @foreach (['active', 'lead', 'churned'] as $option)
                            <option value="{{ $option }}" @selected($customer->status === $option)>{{ ucfirst($option) }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="modal-actions">
                <button class="btn btn-ghost" type="button" data-close-modal>Cancel</button>
                <button class="btn btn-dark" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>

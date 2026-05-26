@extends('layouts.app')
@section('title', 'Ticket Requests')

@section('content')
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-ticket-alt me-2 text-primary"></i>Ticket Requests</h4>
</div>

<!-- Filters -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small">Search</label>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Ticket #, title, name..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Priority</label>
                <select name="priority" class="form-select form-select-sm">
                    <option value="">All Priority</option>
                    <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    <option value="high"   {{ request('priority') == 'high'   ? 'selected' : '' }}>High</option>
                    <option value="normal" {{ request('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small">Category</label>
                <select name="category" class="form-select form-select-sm">
                    <option value="">All Categories</option>
                    @foreach(\App\Models\Ticket::CATEGORIES as $value => $label)
                    <option value="{{ $value }}" {{ request('category') == $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100"><i class="fas fa-search me-1"></i>Filter</button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-secondary btn-sm w-100"><i class="fas fa-times me-1"></i>Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="ticketsTable">
                <thead class="table-light">
                    <tr>
                        <th>Ticket #</th>
                        <th>Title</th>
                        <th>Submitted By</th>
                        <th>Location</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                    <tr>
                        <td><code class="small">{{ $ticket->ticket_number }}</code></td>
                        <td>
                            <div>{{ Str::limit($ticket->title, 35) }}</div>
                            <div class="text-muted" style="font-size:0.75rem;">
                                <i class="fas {{ $ticket->category_icon }} me-1"></i>{{ $ticket->category_label }}
                            </div>
                        </td>
                        <td>
                            <div class="small">{{ $ticket->user->full_name }}</div>
                            <div class="text-muted" style="font-size:0.75rem;">{{ $ticket->user->department }}</div>
                        </td>
                        <td class="small">{{ $ticket->facility?->full_location ?? '—' }}</td>
                        <td>
                            <span class="badge bg-{{ $ticket->priority_badge }} text-capitalize">
                                @if($ticket->priority_level === 'urgent')<i class="fas fa-exclamation-triangle me-1"></i>@endif
                                {{ $ticket->priority_level }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $ticket->status_badge }} text-capitalize">{{ $ticket->status }}</span>
                        </td>
                        <td class="small">{{ $ticket->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No tickets found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($tickets->hasPages())
    <div class="card-footer bg-white">
        {{ $tickets->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    @if($tickets->count())
    $('#ticketsTable').DataTable({ paging: false, searching: false, info: false, order: [] });
    @endif
});
</script>
@endpush

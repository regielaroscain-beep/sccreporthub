@extends('layouts.app')
@section('title', 'Maintenance Monitoring')

@section('content')
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-hard-hat me-2 text-primary"></i>Maintenance Monitoring</h4>
        <p class="text-muted small mb-0">Track progress, verify completion, and generate receipts</p>
    </div>
</div>

<!-- Filters -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small">Search</label>
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Ticket #, title, name..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small">Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Active</option>
                    <option value="assigned" {{ request('status') == 'assigned' ? 'selected' : '' }}>Assigned</option>
                    <option value="ongoing"  {{ request('status') == 'ongoing'  ? 'selected' : '' }}>Ongoing</option>
                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved (Pending Verification)</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="fas fa-search me-1"></i>Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.monitoring.index') }}" class="btn btn-outline-secondary btn-sm w-100">
                    <i class="fas fa-times me-1"></i>Clear
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="monitoringTable">
                <thead class="table-light">
                    <tr>
                        <th>Ticket #</th>
                        <th>Title</th>
                        <th>Submitted By</th>
                        <th>Assigned To</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Assigned Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                    <tr>
                        <td><code class="small">{{ $ticket->ticket_number }}</code></td>
                        <td>{{ Str::limit($ticket->title, 35) }}</td>
                        <td>
                            <div class="small">{{ $ticket->user->full_name }}</div>
                            <div class="text-muted" style="font-size:0.75rem;">{{ $ticket->user->department }}</div>
                        </td>
                        <td class="small">{{ $ticket->assignedStaff?->full_name ?? '—' }}</td>
                        <td>
                            <span class="badge bg-{{ $ticket->priority_badge }} text-capitalize">
                                @if($ticket->priority_level === 'urgent')<i class="fas fa-exclamation-triangle me-1"></i>@endif
                                {{ $ticket->priority_level }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $ticket->status_badge }} text-capitalize">
                                {{ $ticket->status }}
                            </span>
                            @if($ticket->status === 'resolved')
                                <div class="text-warning small mt-1"><i class="fas fa-clock me-1"></i>Needs verification</div>
                            @endif
                        </td>
                        <td class="small">{{ $ticket->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.monitoring.show', $ticket) }}"
                               class="btn btn-sm btn-outline-primary" title="View Progress">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($ticket->status === 'resolved')
                            <form method="POST" action="{{ route('admin.monitoring.verify', $ticket) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success" title="Verify Completion"
                                        onclick="return confirm('Mark ticket #{{ $ticket->ticket_number }} as completed?')">
                                    <i class="fas fa-check-double"></i>
                                </button>
                            </form>
                            <a href="{{ route('admin.monitoring.receipt', $ticket) }}"
                               class="btn btn-sm btn-outline-success" title="Print Receipt" target="_blank">
                                <i class="fas fa-print"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="fas fa-hard-hat fa-2x mb-2 d-block opacity-25"></i>
                            No active maintenance tasks found.
                        </td>
                    </tr>
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
    $('#monitoringTable').DataTable({ paging: false, searching: false, info: false, order: [] });
    @endif
});
</script>
@endpush

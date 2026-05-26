@extends('layouts.app')
@section('title', 'History')

@section('content')
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-clock-rotate-left me-2 text-primary"></i>History</h4>
        <p class="text-muted small mb-0">View completed and rejected tickets</p>
    </div>
</div>

<!-- Filter -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Search ticket #, title..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted">Date From</label>
                <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small text-muted">Date To</label>
                <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="fas fa-magnifying-glass me-1"></i>Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.history') }}" class="btn btn-outline-secondary btn-sm w-100">Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="historyTable">
                <thead class="table-light">
                    <tr>
                        <th>Ticket #</th>
                        <th>Title</th>
                        <th>Submitted By</th>
                        <th>Assigned To</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Completed</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                    <tr>
                        <td><code class="small">{{ $ticket->ticket_number }}</code></td>
                        <td>{{ Str::limit($ticket->title, 40) }}</td>
                        <td class="small">{{ $ticket->user->full_name }}</td>
                        <td class="small">{{ $ticket->assignedStaff?->full_name ?? '—' }}</td>
                        <td><span class="badge bg-{{ $ticket->priority_badge }} text-capitalize">{{ $ticket->priority_level }}</span></td>
                        <td><span class="badge bg-{{ $ticket->status_badge }} text-capitalize">{{ $ticket->status }}</span></td>
                        <td class="small">{{ $ticket->completed_at?->format('M d, Y') ?? '—' }}</td>
                        <td>
                            <a href="{{ route('admin.tickets.show', [$ticket, 'from' => 'history']) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if($ticket->status === 'completed')
                            <a href="{{ route('admin.monitoring.receipt', $ticket) }}" class="btn btn-sm btn-outline-success" target="_blank">
                                <i class="fas fa-print"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No history records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($tickets->hasPages())
    <div class="card-footer bg-white">{{ $tickets->withQueryString()->links() }}</div>
    @endif
</div>
@endsection

@push('scripts')
<script>$(document).ready(function() {
    @if($tickets->count())
    $('#historyTable').DataTable({ paging: false, searching: false, info: false, order: [] });
    @endif
});</script>
@endpush

@extends('layouts.app')
@section('title', 'Tasks History')

@section('content')
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-clock-rotate-left me-2 text-primary"></i>Tasks History</h4>
    <p class="text-muted small mb-0">View Completed Tasks</p>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="completedTable">
                <thead class="table-light">
                    <tr>
                        <th>Ticket #</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Total Cost</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                    <tr>
                        <td><code class="small">{{ $ticket->ticket_number }}</code></td>
                        <td>{{ Str::limit($ticket->title, 40) }}</td>
                        <td class="small">{{ $ticket->facility?->full_location ?? '—' }}</td>
                        <td><span class="badge bg-{{ $ticket->priority_badge }} text-capitalize">{{ $ticket->priority_level }}</span></td>
                        <td><span class="badge bg-{{ $ticket->status_badge }} text-capitalize">{{ $ticket->status }}</span></td>
                        <td class="small">₱{{ number_format($ticket->maintenanceLogs->sum('repair_cost'), 2) }}</td>
                        <td class="small">{{ $ticket->completed_at?->format('M d, Y') ?? $ticket->updated_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('maintenance.tasks.show', $ticket) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">No completed tasks yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($tickets->hasPages())
    <div class="card-footer bg-white">{{ $tickets->links() }}</div>
    @endif
</div>
@endsection

@push('scripts')
<script>$(document).ready(function() {
    @if($tickets->count())
    $('#completedTable').DataTable({ paging: false, searching: true, info: false, order: [[6,'desc']] });
    @endif
});</script>
@endpush

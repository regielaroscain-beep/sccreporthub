@extends('layouts.app')
@section('title', 'Maintenance Dashboard')

@section('content')
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-chart-pie me-2 text-primary"></i>Dashboard</h4>
        <p class="text-muted small mb-0">Welcome, {{ auth()->user()->full_name }}</p>
    </div>
    <span class="text-muted small">{{ now()->format('l, F d, Y') }}</span>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="fas fa-tasks"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['assigned_tasks'] }}</div>
                <div class="stat-label">Active Tasks</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-danger">
            <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['urgent_tasks'] }}</div>
                <div class="stat-label">Urgent Tasks</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="fas fa-check"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['resolved_tasks'] }}</div>
                <div class="stat-label">Resolved</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="fas fa-check-double"></i></div>
            <div class="stat-info">
                <div class="stat-value">{{ $stats['completed_tasks'] }}</div>
                <div class="stat-label">Completed</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Active Tasks -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="fas fa-tools me-2 text-primary"></i>Active Assigned Tasks</span>
                <a href="{{ route('maintenance.tasks.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                @forelse($assignedTickets as $ticket)
                <div class="p-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge bg-{{ $ticket->priority_badge }} text-capitalize">{{ $ticket->priority_level }}</span>
                                <span class="badge bg-{{ $ticket->status_badge }} text-capitalize">{{ $ticket->status }}</span>
                                <code class="small text-muted">{{ $ticket->ticket_number }}</code>
                            </div>
                            <div class="fw-semibold">{{ $ticket->title }}</div>
                            <div class="text-muted small">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $ticket->facility?->full_location ?? 'Location not specified' }}
                            </div>
                            <div class="text-muted small">
                                <i class="fas fa-user me-1"></i>{{ $ticket->user->full_name }} — {{ $ticket->user->department }}
                            </div>
                        </div>
                        <a href="{{ route('maintenance.tasks.show', $ticket) }}" class="btn btn-sm btn-primary ms-3">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-5">
                    <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                    <div>No active tasks assigned to you.</div>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Completed -->
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="fas fa-history me-2 text-primary"></i>Recently Completed</span>
                <a href="{{ route('maintenance.tasks.completed') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="list-group list-group-flush">
                @forelse($recentCompleted as $ticket)
                <a href="{{ route('maintenance.tasks.show', $ticket) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex justify-content-between">
                        <code class="small">{{ $ticket->ticket_number }}</code>
                        <span class="badge bg-success">Completed</span>
                    </div>
                    <div class="small fw-semibold">{{ Str::limit($ticket->title, 40) }}</div>
                    <div class="text-muted" style="font-size:0.75rem;">{{ $ticket->completed_at?->format('M d, Y') ?? $ticket->updated_at->format('M d, Y') }}</div>
                </a>
                @empty
                <div class="list-group-item text-center text-muted py-4 small">No completed tasks yet.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

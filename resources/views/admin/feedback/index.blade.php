@extends('layouts.app')
@section('title', 'Feedback')

@section('content')
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-star me-2 text-warning"></i>User Feedback</h4>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm text-center p-4">
            <div class="display-4 fw-bold text-warning">{{ number_format($avgRating, 1) }}</div>
            <div class="text-muted">Average Rating</div>
            <div class="mt-2">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= round($avgRating) ? 'text-warning' : 'text-muted' }}"></i>
                @endfor
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm p-4">
            <h6 class="fw-semibold mb-3">Rating Distribution</h6>
            @for($i = 5; $i >= 1; $i--)
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="small" style="width:40px;">{{ $i }} <i class="fas fa-star text-warning fa-xs"></i></span>
                <div class="progress flex-grow-1" style="height:12px;">
                    @php $count = $ratingCounts[$i] ?? 0; $total = $feedbacks->total() ?: 1; @endphp
                    <div class="progress-bar bg-warning" style="width:{{ ($count/$total)*100 }}%"></div>
                </div>
                <span class="small text-muted" style="width:30px;">{{ $count }}</span>
            </div>
            @endfor
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Ticket #</th>
                        <th>Submitted By</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($feedbacks as $feedback)
                    <tr>
                        <td><code class="small">{{ $feedback->ticket->ticket_number }}</code></td>
                        <td class="small">{{ $feedback->user->full_name }}</td>
                        <td>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-muted' }} fa-sm"></i>
                            @endfor
                        </td>
                        <td class="small">{{ $feedback->comment ?? '—' }}</td>
                        <td class="small">{{ $feedback->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No feedback yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($feedbacks->hasPages())
    <div class="card-footer bg-white">{{ $feedbacks->links() }}</div>
    @endif
</div>
@endsection

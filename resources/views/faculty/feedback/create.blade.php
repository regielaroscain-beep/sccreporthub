@extends('layouts.app')
@section('title', 'Submit Feedback')

@section('content')
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-star me-2 text-warning"></i>Submit Feedback</h4>
    <a href="{{ route('faculty.tickets.show', $ticket) }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">

        <!-- Ticket Info -->
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-12 col-sm-4">
                        <div class="text-muted small">Ticket #</div>
                        <div class="fw-semibold"><code>{{ $ticket->ticket_number }}</code></div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="text-muted small">Title</div>
                        <div class="small fw-semibold">{{ Str::limit($ticket->title, 40) }}</div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="text-muted small">Assigned To</div>
                        <div class="small">{{ $ticket->assignedStaff?->full_name ?? '—' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback Form -->
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h6 class="fw-semibold mb-4 text-center">How would you rate the maintenance service?</h6>

                <form method="POST" action="{{ route('faculty.feedback.store', $ticket) }}">
                    @csrf

                    <!-- Star Rating -->
                    <div class="mb-4 text-center">
                        <div class="d-flex justify-content-center gap-2 mb-2" id="starRating">
                            @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star text-muted star-btn" data-value="{{ $i }}"
                               style="cursor:pointer; font-size:2rem;"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="ratingInput" value="{{ old('rating') }}" required>
                        <div class="text-muted small mt-1" id="ratingLabel">Click a star to rate</div>
                        @error('rating')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Comments <span class="text-muted fw-normal small">(optional)</span></label>
                        <textarea name="comment" class="form-control" rows="3"
                                  placeholder="Share your experience...">{{ old('comment') }}</textarea>
                        @error('comment')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn btn-warning w-100 fw-semibold">
                        <i class="fas fa-paper-plane me-2"></i>Submit Feedback
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const stars = document.querySelectorAll('.star-btn');
const ratingInput = document.getElementById('ratingInput');
const ratingLabel = document.getElementById('ratingLabel');
const labels = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];

function setStars(val) {
    stars.forEach((s, i) => {
        s.classList.toggle('text-warning', i < val);
        s.classList.toggle('text-muted', i >= val);
    });
}

stars.forEach(star => {
    star.addEventListener('click', function() {
        const val = parseInt(this.dataset.value);
        ratingInput.value = val;
        ratingLabel.textContent = labels[val];
        setStars(val);
    });
    star.addEventListener('mouseover', function() {
        setStars(parseInt(this.dataset.value));
    });
    star.addEventListener('mouseout', function() {
        setStars(parseInt(ratingInput.value) || 0);
    });
});

const prev = parseInt(ratingInput.value);
if (prev) { ratingLabel.textContent = labels[prev]; setStars(prev); }
</script>
@endpush

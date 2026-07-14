@extends('layouts.auth')
@section('title', 'Email Verified')

@section('content')
<div class="text-center py-3">

    {{-- Animated checkmark --}}
    <div class="mb-4">
        <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10"
              style="width:80px;height:80px;">
            <i class="fas fa-circle-check text-success" style="font-size:2.4rem;"></i>
        </span>
    </div>

    <h4 class="fw-bold mb-2">Email Verified!</h4>
    <p class="text-muted small mb-1">Your email address has been successfully verified.</p>
    <p class="text-muted small mb-4">You can now log in to your SCC ReportHub account.</p>

    <div class="alert alert-light border small text-start mb-4" style="border-radius:10px;">
        <i class="fas fa-shield-halved text-success me-2"></i>
        Your account is now <strong>active and secure</strong>. Welcome to SCC ReportHub!
    </div>

    <a href="{{ route('login') }}" class="btn btn-primary w-100 py-2 fw-semibold mb-3" id="loginBtn">
        <i class="fas fa-right-to-bracket me-2"></i>Proceed to Login
    </a>

    <p class="text-muted" style="font-size:12px;">
        Redirecting to login in <span id="countdown">5</span>s...
    </p>
</div>
@endsection

@push('scripts')
<script>
    // Auto-redirect countdown
    let seconds = 5;
    const countdown = document.getElementById('countdown');
    const interval = setInterval(() => {
        seconds--;
        countdown.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(interval);
            window.location.href = "{{ route('login') }}";
        }
    }, 1000);
</script>
@endpush

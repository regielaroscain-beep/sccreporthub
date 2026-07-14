@extends('layouts.auth')
@section('title', 'Verify Your Email')

@section('content')

@if(session('success'))
    {{-- ── Resent State ─────────────────────────────────────────────────── --}}
    <div class="text-center py-2">
        <div class="mb-4">
            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10"
                  style="width:72px;height:72px;">
                <i class="fas fa-envelope-circle-check text-success" style="font-size:2rem;"></i>
            </span>
        </div>
        <h5 class="fw-bold mb-2">Email resent!</h5>
        <p class="text-muted small mb-4">
            We sent a new verification link to<br>
            <strong class="text-dark">{{ session('sent_email') }}</strong>
        </p>
        <a href="{{ route('verification.notice') }}" class="btn btn-outline-secondary w-100 py-2">
            <i class="fas fa-rotate-left me-2"></i>Back
        </a>
    </div>

@else
    {{-- ── Notice State ─────────────────────────────────────────────────── --}}
    <div class="text-center py-2">
        <div class="mb-4">
            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10"
                  style="width:72px;height:72px;">
                <i class="fas fa-envelope-open-text text-primary" style="font-size:2rem;"></i>
            </span>
        </div>
        <h5 class="fw-bold mb-2">Verify your email</h5>
        <p class="text-muted small mb-1">We sent a verification link to</p>
        <p class="fw-semibold text-dark mb-4">{{ session('sent_email') ?? 'your email address' }}</p>

        <div class="alert alert-light border text-start small mb-4" style="border-radius:10px;">
            <i class="fas fa-circle-info text-primary me-2"></i>
            Click the link in the email to activate your account. Check your spam folder if you don't see it.
        </div>

        @if(session('error'))
            <div class="alert alert-warning small mb-3">
                <i class="fas fa-triangle-exclamation me-2"></i>{{ session('error') }}
            </div>
        @endif

        {{-- Resend form --}}
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <input type="hidden" name="email" value="{{ session('sent_email') }}">
            <button type="submit" class="btn btn-outline-primary w-100 py-2 mb-3">
                <i class="fas fa-paper-plane me-2"></i>Resend Verification Email
            </button>
        </form>

        <a href="{{ route('login') }}" class="btn btn-link text-muted small text-decoration-none">
            <i class="fas fa-arrow-left me-1"></i>Back to Login
        </a>
    </div>
@endif

@endsection

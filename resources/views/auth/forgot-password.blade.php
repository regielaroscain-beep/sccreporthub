@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('content')

@if(session('success'))
    {{-- ── Sent State ──────────────────────────────────────────────────── --}}
    <div class="text-center py-2">
        <div class="mb-4">
            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10"
                  style="width:72px;height:72px;">
                <i class="fas fa-envelope-circle-check text-success" style="font-size:2rem;"></i>
            </span>
        </div>
        <h5 class="fw-bold mb-2">Check your inbox</h5>
        <p class="text-muted small mb-4">
            We sent a password reset link to<br>
            <strong class="text-dark">{{ session('sent_email') }}</strong>
        </p>
        <div class="alert alert-light border text-start small mb-4" style="border-radius:10px;">
            <i class="fas fa-circle-info text-primary me-2"></i>
            The link will expire in <strong>60 minutes</strong>. If you don't see it, check your spam folder.
        </div>
        <a href="{{ route('password.request') }}" class="btn btn-outline-secondary w-100 py-2 mb-3">
            <i class="fas fa-rotate-left me-2"></i>Try a different email
        </a>
        <a href="{{ route('login') }}" class="btn btn-primary w-100 py-2 fw-semibold">
            <i class="fas fa-arrow-left me-2"></i>Back to Login
        </a>
    </div>

@else
    {{-- ── Form State ──────────────────────────────────────────────────── --}}
    <div class="text-center mb-4">
        <div class="mb-3">
            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10"
                  style="width:64px;height:64px;">
                <i class="fas fa-lock text-primary" style="font-size:1.6rem;"></i>
            </span>
        </div>
        <h5 class="fw-bold mb-1">Forgot your password?</h5>
        <p class="text-muted small mb-0">No worries — enter your email and we'll send you a reset link.</p>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-4">
            <label class="form-label fw-semibold small">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-envelope text-muted"></i>
                </span>
                <input type="email" name="email"
                       class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       placeholder="your@southernchristiancollege.edu.ph"
                       required autofocus>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
            <i class="fas fa-paper-plane me-2"></i>Send Reset Link
        </button>
    </form>

    <hr class="my-4">
    <p class="text-center text-muted small mb-0">
        <a href="{{ route('login') }}" class="text-primary">
            <i class="fas fa-arrow-left me-1"></i>Back to Login
        </a>
    </p>
@endif

@endsection

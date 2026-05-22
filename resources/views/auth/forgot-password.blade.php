@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('content')
<h5 class="text-center fw-semibold mb-2">Forgot Password</h5>
<p class="text-center text-muted small mb-4">Enter your email and we'll send you a reset link.</p>

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="mb-4">
        <label class="form-label">Email Address</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="your@email.com" required autofocus>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
        <i class="fas fa-paper-plane me-2"></i>Send Reset Link
    </button>
</form>

<hr class="my-4">
<p class="text-center text-muted small mb-0">
    <a href="{{ route('login') }}" class="text-primary"><i class="fas fa-arrow-left me-1"></i>Back to Login</a>
</p>
@endsection

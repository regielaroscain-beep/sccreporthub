@extends('layouts.auth')
@section('title', 'Email Verified')

@section('content')
<div class="text-center py-3">

    <div class="mb-4">
        <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10"
              style="width:80px;height:80px;">
            <i class="fas fa-circle-check text-success" style="font-size:2.4rem;"></i>
        </span>
    </div>

    <h4 class="fw-bold mb-2">Email Verified!</h4>
    <p class="text-muted small mb-4">
        Your account is now active. Click the button below to go to your dashboard.
    </p>

    <a href="{{ route('faculty.dashboard') }}" class="btn btn-primary w-100 py-2 fw-semibold">
        <i class="fas fa-gauge me-2"></i>Go to Dashboard
    </a>

</div>
@endsection

@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
<div class="text-center mb-4">
    <div class="mb-3">
        <span class="rounded-circle d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10"
              style="width:56px;height:56px;">
            <i class="fas fa-lock-open text-primary fs-4"></i>
        </span>
    </div>
    <h5 class="fw-semibold mb-1">Set New Password</h5>
    <p class="text-muted small mb-0">Must be at least 8 characters with uppercase, number &amp; symbol.</p>
</div>

<form method="POST" action="{{ route('password.update') }}" id="resetForm">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <div class="mb-3">
        <label class="form-label fw-semibold">New Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
            <input type="password" name="password" id="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="Enter new password" required autofocus>
            <button type="button" class="btn btn-outline-secondary" id="togglePassword" tabindex="-1">
                <i class="fas fa-eye" id="eyeIcon"></i>
            </button>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <!-- Password strength bar -->
        <div class="mt-2">
            <div class="progress" style="height:4px;">
                <div class="progress-bar" id="strengthBar" role="progressbar" style="width:0%;transition:width .3s,background .3s"></div>
            </div>
            <small id="strengthLabel" class="text-muted"></small>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold">Confirm New Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
            <input type="password" name="password_confirmation" id="passwordConfirm"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   placeholder="Confirm new password" required>
            @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <small id="matchMsg" class="d-block mt-1"></small>
    </div>

    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
        <i class="fas fa-check me-2"></i>Reset Password
    </button>
</form>

<hr class="my-4">
<p class="text-center text-muted small mb-0">
    <a href="{{ route('login') }}" class="text-primary">
        <i class="fas fa-arrow-left me-1"></i>Back to Login
    </a>
</p>
@endsection

@push('scripts')
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        const input = document.getElementById('password');
        const icon  = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });

    // Password strength indicator
    document.getElementById('password').addEventListener('input', function () {
        const val   = this.value;
        const bar   = document.getElementById('strengthBar');
        const label = document.getElementById('strengthLabel');
        let score   = 0;

        if (val.length >= 8)           score++;
        if (/[A-Z]/.test(val))         score++;
        if (/[0-9]/.test(val))         score++;
        if (/[^A-Za-z0-9]/.test(val))  score++;

        const levels = [
            { w: '0%',   cls: '',          text: '' },
            { w: '25%',  cls: 'bg-danger',  text: 'Weak' },
            { w: '50%',  cls: 'bg-warning', text: 'Fair' },
            { w: '75%',  cls: 'bg-info',    text: 'Good' },
            { w: '100%', cls: 'bg-success', text: 'Strong' },
        ];

        const lvl = levels[score];
        bar.style.width = lvl.w;
        bar.className   = 'progress-bar ' + lvl.cls;
        label.textContent = lvl.text;
    });

    // Confirm match
    document.getElementById('passwordConfirm').addEventListener('input', function () {
        const msg = document.getElementById('matchMsg');
        if (this.value === document.getElementById('password').value) {
            msg.textContent = '✓ Passwords match';
            msg.className   = 'small text-success';
        } else {
            msg.textContent = '✗ Passwords do not match';
            msg.className   = 'small text-danger';
        }
    });
</script>
@endpush

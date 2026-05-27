@extends('layouts.auth')
@section('title', 'Sign In')

@section('content')

@php
    $ipLockKey = 'login_locked_ip_' . md5(request()->ip());
    $lockedUntil = session($ipLockKey);
    $isLocked = $lockedUntil && $lockedUntil > now()->timestamp;
    $lockSeconds = $isLocked ? ($lockedUntil - now()->timestamp) : 0;
@endphp

@if($isLocked)
<div class="alert alert-danger d-flex align-items-center gap-2 py-2 mb-3" id="lockoutAlert">
    <i class="fas fa-lock"></i>
    <span class="small">Too many failed attempts. Try again in <strong id="lockCountdown">{{ $lockSeconds }}</strong>s.</span>
</div>
@endif

<div class="mb-4">
    <h5 class="fw-700 mb-1" style="font-size:1.35rem;font-weight:700;color:#1e1b4b;">Welcome back</h5>
    <p class="text-muted mb-0" style="font-size:0.875rem;">Sign in to your account to continue</p>
</div>

<form method="POST" action="{{ route('login.post') }}">
    @csrf

    {{-- Role Selector --}}
    <div class="mb-4">
        <label class="form-label small fw-semibold text-secondary text-uppercase" style="letter-spacing:.05em;font-size:0.72rem;">Login as</label>
        <div class="row g-2" id="roleSelector">
            <div class="col-4">
                <input type="radio" class="btn-check" name="login_role" id="role_admin" value="admin"
                       {{ old('login_role') === 'admin' ? 'checked' : '' }}>
                <label class="btn w-100 role-btn" for="role_admin">
                    <i class="fas fa-user-shield d-block mb-1"></i>
                    <span>Admin</span>
                </label>
            </div>
            <div class="col-4">
                <input type="radio" class="btn-check" name="login_role" id="role_maintenance" value="maintenance"
                       {{ old('login_role') === 'maintenance' ? 'checked' : '' }}>
                <label class="btn w-100 role-btn" for="role_maintenance">
                    <i class="fas fa-screwdriver-wrench d-block mb-1"></i>
                    <span>Maintenance</span>
                </label>
            </div>
            <div class="col-4">
                <input type="radio" class="btn-check" name="login_role" id="role_faculty" value="faculty"
                       {{ (old('login_role') === 'faculty' || !old('login_role')) ? 'checked' : '' }}>
                <label class="btn w-100 role-btn" for="role_faculty">
                    <i class="fas fa-chalkboard-user d-block mb-1"></i>
                    <span>Faculty</span>
                </label>
            </div>
        </div>
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label class="form-label small fw-semibold" style="color:#374151;">Email Address</label>
        <div class="input-group input-group-modern">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   placeholder="your@email.com" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Password --}}
    <div class="mb-3">
        <label class="form-label small fw-semibold" style="color:#374151;">Password</label>
        <div class="input-group input-group-modern">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" name="password" id="password"
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••" required>
            <button type="button" class="input-group-text bg-white border-start-0 toggle-pw" onclick="togglePassword('password','eyeIcon')">
                <i class="fas fa-eye text-muted" id="eyeIcon"></i>
            </button>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- Remember + Forgot --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label small text-muted" for="remember">Remember me</label>
        </div>
        <a href="{{ route('password.request') }}" class="small fw-semibold" style="color:#4f46e5;text-decoration:none;">Forgot password?</a>
    </div>

    <button type="submit" class="btn btn-signin w-100 py-2 fw-semibold">
        <i class="fas fa-arrow-right-to-bracket me-2"></i>Sign In
    </button>
</form>

{{-- Register link (Faculty only) --}}
<div id="registerLink" class="mt-4 text-center" style="display:none;">
    <p class="text-muted small mb-0">
        Don't have an account?
        <a href="{{ route('register') }}" class="fw-semibold" style="color:#4f46e5;text-decoration:none;">Create an account</a>
    </p>
</div>

@endsection

@push('styles')
<style>
.role-btn {
    padding: 10px 6px;
    border-radius: 10px;
    border: 1.5px solid #e5e7eb;
    background: #fafafa;
    color: #6b7280;
    font-size: 0.75rem;
    font-weight: 500;
    transition: all 0.15s ease;
    line-height: 1.3;
}
.role-btn i { font-size: 1.1rem; color: #9ca3af; transition: color 0.15s; }
.btn-check:checked + .role-btn {
    background: #eef2ff;
    border-color: #4f46e5;
    color: #4f46e5;
}
.btn-check:checked + .role-btn i { color: #4f46e5; }
.role-btn:hover { border-color: #c7d2fe; background: #f5f3ff; }

.input-group-modern .input-group-text {
    background: #f9fafb;
    border-color: #e5e7eb;
    color: #9ca3af;
    border-right: none;
}
.input-group-modern .form-control {
    border-color: #e5e7eb;
    border-left: none;
    background: #f9fafb;
    font-size: 0.9rem;
    color: #111827;
    padding: 10px 14px;
}
.input-group-modern .form-control:focus {
    background: #fff;
    border-color: #4f46e5;
    box-shadow: none;
}
.input-group-modern .form-control:focus ~ .input-group-text,
.input-group-modern .input-group-text:has(~ .form-control:focus) {
    border-color: #4f46e5;
    background: #fff;
}
.toggle-pw {
    border-color: #e5e7eb;
    border-left: none;
    cursor: pointer;
}

.btn-signin {
    background: linear-gradient(135deg, #4f46e5, #4338ca);
    border: none;
    color: #fff;
    border-radius: 10px;
    font-size: 0.9rem;
    letter-spacing: 0.02em;
    transition: all 0.2s;
    box-shadow: 0 4px 14px rgba(79,70,229,0.35);
}
.btn-signin:hover {
    background: linear-gradient(135deg, #4338ca, #3730a3);
    color: #fff;
    box-shadow: 0 6px 20px rgba(79,70,229,0.45);
    transform: translateY(-1px);
}
.btn-signin:active { transform: translateY(0); }
</style>
@endpush

@push('scripts')
<script>
function togglePassword(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon  = document.getElementById(iconId);
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

function updateRegisterLink() {
    const selected = document.querySelector('input[name="login_role"]:checked')?.value;
    document.getElementById('registerLink').style.display = selected === 'faculty' ? 'block' : 'none';
}

document.querySelectorAll('input[name="login_role"]').forEach(r => r.addEventListener('change', updateRegisterLink));
updateRegisterLink();

const countdownEl = document.getElementById('lockCountdown');
if (countdownEl) {
    const submitBtn = document.querySelector('button[type="submit"]');
    if (submitBtn) submitBtn.disabled = true;
    let seconds = parseInt(countdownEl.textContent);
    const timer = setInterval(() => {
        seconds--;
        if (seconds <= 0) { clearInterval(timer); window.location.reload(); }
        else countdownEl.textContent = seconds;
    }, 1000);
}
</script>
@endpush

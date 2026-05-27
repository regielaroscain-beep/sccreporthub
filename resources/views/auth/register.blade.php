@extends('layouts.auth')
@section('title', 'Register')

@section('content')
<h5 class="text-center fw-semibold mb-1">Create Your Account</h5>
<p class="text-center text-muted small mb-4">For Faculty & Staff only. Admin and Maintenance accounts are created by the administrator.</p>

<form method="POST" action="{{ route('register.post') }}" enctype="multipart/form-data">
    @csrf

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">First Name <span class="text-danger">*</span></label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                   value="{{ old('first_name') }}" placeholder="Juan" required>
            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">Last Name <span class="text-danger">*</span></label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                   value="{{ old('last_name') }}" placeholder="Dela Cruz" required>
            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="mb-3 mt-3">
        <label class="form-label">Email Address <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="yourname@southernchristiancollege.edu.ph" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-text mt-1">
            <i class="fas fa-info-circle me-1"></i>
            Must use your institutional email (<code>@southernchristiancollege.edu.ph</code>)
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Department <span class="text-danger">*</span></label>
        <input type="text" name="department" class="form-control @error('department') is-invalid @enderror"
               value="{{ old('department') }}" placeholder="e.g. College of Education" required>
        @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Contact Number <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-phone text-muted"></i></span>
            <input type="text" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror"
                   value="{{ old('contact_number') }}" placeholder="09XXXXXXXXX" required>
            @error('contact_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Password <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Min. 8 characters" required>
            <button type="button" class="input-group-text bg-white border-start-0" onclick="togglePassword('password','eye1')">
                <i class="fas fa-eye text-muted" id="eye1"></i>
            </button>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="form-text mt-1">
            <i class="fas fa-info-circle me-1"></i>
            Must be at least 8 characters with uppercase, lowercase, number, and special character (e.g. <code>Pass@1234</code>)
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
            <input type="password" name="password_confirmation" id="password_confirmation"
                   class="form-control" placeholder="Repeat password" required>
            <button type="button" class="input-group-text bg-white border-start-0" onclick="togglePassword('password_confirmation','eye2')">
                <i class="fas fa-eye text-muted" id="eye2"></i>
            </button>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">Profile Photo <span class="text-muted small">(optional)</span></label>
        <input type="file" name="profile_photo" class="form-control @error('profile_photo') is-invalid @enderror"
               accept="image/jpg,image/jpeg,image/png">
        @error('profile_photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
        <i class="fas fa-user-plus me-2"></i>Create Account
    </button>
</form>

<hr class="my-4">
<p class="text-center text-muted small mb-0">
    Already have an account?
    <a href="{{ route('login') }}" class="text-primary fw-semibold">Sign in here</a>
</p>
@endsection

@push('scripts')
<script>
function togglePassword(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon  = document.getElementById(iconId);
    field.type  = field.type === 'password' ? 'text' : 'password';
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
}
</script>
@endpush

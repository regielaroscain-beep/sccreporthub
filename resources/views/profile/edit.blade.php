@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-circle-user me-2 text-primary"></i>Admin Profile</h4>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <!-- Profile Photo -->
                <div class="text-center mb-4">
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="Avatar" class="rounded-circle mb-3"
                         width="100" height="100" style="object-fit:cover;" id="profilePreview"
                         onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                    <div class="fw-semibold">{{ auth()->user()->full_name }}</div>
                    <div class="text-muted small">{{ auth()->user()->role->name }}</div>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                   value="{{ old('first_name', $user->first_name) }}" required>
                            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{ old('last_name', $user->last_name) }}" required>
                            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control bg-light" value="{{ $user->email }}" disabled>
                            <div class="form-text">Email cannot be changed here.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Department <span class="text-danger">*</span></label>
                            <input type="text" name="department" class="form-control @error('department') is-invalid @enderror"
                                   value="{{ old('department', $user->department) }}" required>
                            @error('department')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                            <input type="text" name="contact_number" class="form-control @error('contact_number') is-invalid @enderror"
                                   value="{{ old('contact_number', $user->contact_number) }}" required>
                            @error('contact_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Profile Photo <span class="text-muted small">(max 10MB)</span></label>
                            <input type="file" name="profile_photo" class="form-control @error('profile_photo') is-invalid @enderror"
                                   accept="image/*" onchange="previewProfile(this)">
                            @error('profile_photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Save Changes</button>
                        <a href="{{ route('password.change') }}" class="btn btn-outline-secondary"><i class="fas fa-key me-2"></i>Change Password</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewProfile(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById('profilePreview').src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

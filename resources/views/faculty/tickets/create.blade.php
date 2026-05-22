@extends('layouts.app')
@section('title', 'Create Ticket Request')

@section('content')
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-circle-plus me-2 text-primary"></i>Create Ticket Request</h4>
        <p class="text-muted small mb-0">Input location, describe the issue, upload photo evidence, then submit</p>
    </div>
    <a href="{{ route('faculty.tickets.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">

        <div class="card shadow-sm">
            <div class="card-body p-3 p-md-4">
                <form method="POST" action="{{ route('faculty.tickets.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Request Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" placeholder="e.g. Broken ceiling fan in Room 201" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Detailed Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                  rows="4" placeholder="Describe the issue in detail..." required>{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Facility Location</label>
                        <select name="location_id" class="form-select @error('location_id') is-invalid @enderror">
                            <option value="">-- Select a facility --</option>
                            @foreach($facilities as $facility)
                            <option value="{{ $facility->id }}" {{ old('location_id') == $facility->id ? 'selected' : '' }}>
                                {{ $facility->full_location }}
                            </option>
                            @endforeach
                        </select>
                        @error('location_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Photo Evidence <span class="text-muted fw-normal small">(optional, max 10MB)</span></label>
                        <input type="file" name="photo" id="photoInput" class="form-control @error('photo') is-invalid @enderror"
                               accept="image/jpg,image/jpeg,image/png,image/gif" onchange="previewPhoto(this)">
                        @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div id="photoPreview" class="mt-2 d-none">
                            <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height:200px; max-width:100%;">
                            <button type="button" class="btn btn-sm btn-outline-danger mt-2 d-block" onclick="clearPhoto()">
                                <i class="fas fa-times me-1"></i>Remove
                            </button>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Submit Request
                        </button>
                        <a href="{{ route('faculty.dashboard') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('photoPreview').classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function clearPhoto() {
    document.getElementById('photoInput').value = '';
    document.getElementById('photoPreview').classList.add('d-none');
}
</script>
@endpush

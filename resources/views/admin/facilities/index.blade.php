@extends('layouts.app')
@section('title', 'Facilities')

@section('content')
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-building me-2 text-primary"></i>Facilities Management</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFacilityModal">
        <i class="fas fa-plus me-2"></i>Add Facility
    </button>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="facilitiesTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Building Name</th>
                        <th>Room Number</th>
                        <th>Floor</th>
                        <th>Description</th>
                        <th>Tickets</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($facilities as $facility)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $facility->building_name }}</td>
                        <td>{{ $facility->room_number ?? '—' }}</td>
                        <td>{{ $facility->floor ?? '—' }}</td>
                        <td>{{ $facility->description ?? '—' }}</td>
                        <td><span class="badge bg-primary">{{ $facility->tickets_count }}</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editFacilityModal{{ $facility->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.facilities.destroy', $facility) }}" class="d-inline" onsubmit="return confirm('Delete this facility?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editFacilityModal{{ $facility->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('admin.facilities.update', $facility) }}">
                                    @csrf @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Facility</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Building Name <span class="text-danger">*</span></label>
                                            <input type="text" name="building_name" class="form-control" value="{{ $facility->building_name }}" required>
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="form-label">Room Number</label>
                                                <input type="text" name="room_number" class="form-control" value="{{ $facility->room_number }}">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Floor</label>
                                                <input type="text" name="floor" class="form-control" value="{{ $facility->floor }}">
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="2">{{ $facility->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No facilities found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($facilities->hasPages())
    <div class="card-footer bg-white">{{ $facilities->links() }}</div>
    @endif
</div>

<!-- Add Facility Modal -->
<div class="modal fade" id="addFacilityModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.facilities.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Add Facility</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Building Name <span class="text-danger">*</span></label>
                        <input type="text" name="building_name" class="form-control @error('building_name') is-invalid @enderror" value="{{ old('building_name') }}" required>
                        @error('building_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label">Room Number</label>
                            <input type="text" name="room_number" class="form-control" value="{{ old('room_number') }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Floor</label>
                            <input type="text" name="floor" class="form-control" value="{{ old('floor') }}">
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Add Facility</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>$(document).ready(function() { $('#facilitiesTable').DataTable({ paging: false, searching: true, info: false, order: [] }); });</script>
@endpush


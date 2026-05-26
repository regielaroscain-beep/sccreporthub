@extends('layouts.app')
@section('title', 'User Management')

@section('content')
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-users me-2 text-primary"></i>User Management</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fas fa-user-plus me-2"></i>Add User
    </a>
</div>

<!-- Filters -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search name, email, department..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="role" class="form-select form-select-sm">
                    <option value="">All Roles</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->slug }}" {{ request('role') == $role->slug ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="active"   {{ request('status') == 'active'   ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100"><i class="fas fa-search me-1"></i>Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm w-100">Clear</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="usersTable">
                <thead class="table-light">
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $user->profile_photo_url }}" alt="Avatar" class="rounded-circle" width="36" height="36" style="object-fit:cover;" onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}'">
                                <div>
                                    <div class="fw-semibold small">{{ $user->full_name }}</div>
                                    <div class="text-muted" style="font-size:0.75rem;">{{ $user->contact_number }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="small">{{ $user->email }}</td>
                        <td class="small">{{ $user->department }}</td>
                        <td><span class="badge bg-secondary">{{ $user->role->name }}</span></td>
                        <td>
                            <span class="badge bg-{{ $user->status === 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td class="small">{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-{{ $user->status === 'active' ? 'warning' : 'success' }}" title="{{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}">
                                        <i class="fas fa-{{ $user->status === 'active' ? 'ban' : 'check' }}"></i>
                                    </button>
                                </form>
                                @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
    <div class="card-footer bg-white">{{ $users->withQueryString()->links() }}</div>
    @endif
</div>
@endsection

@push('scripts')
<script>$(document).ready(function() { $('#usersTable').DataTable({ paging: false, searching: false, info: false, order: [] }); });</script>
@endpush

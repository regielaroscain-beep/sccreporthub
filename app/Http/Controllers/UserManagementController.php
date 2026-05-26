<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserManagementController extends Controller
{
    // ─── List Users ───────────────────────────────────────────────────────────

    public function index(Request $request)
    {
        $query = User::with('role');

        if ($request->filled('role')) {
            $query->whereHas('role', fn($q) => $q->where('slug', $request->role));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(15);
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    // ─── Show Create Form ─────────────────────────────────────────────────────

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    // ─── Store New User ───────────────────────────────────────────────────────

    public function store(Request $request)
    {
        $request->validate([
            'role_id'        => ['required', 'exists:roles,id'],
            'first_name'     => ['required', 'string', 'max:100'],
            'last_name'      => ['required', 'string', 'max:100'],
            'email'          => ['required', 'email', 'unique:users,email'],
            'department'     => ['required', 'string', 'max:150'],
            'specialization' => ['nullable', 'string', 'max:100'],
            'contact_number' => ['required', 'string', 'max:20'],
            'password'       => ['required', 'confirmed', Password::min(8)],
            'profile_photo'  => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:10240'],
        ]);

        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $uploaded = cloudinary()->upload($request->file('profile_photo')->getRealPath(), [
                'folder' => 'scc-reporthub/profile_photos',
            ]);
            $photoPath = $uploaded->getSecurePath();
        }

        User::create([
            'role_id'        => $request->role_id,
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'department'     => $request->department,
            'specialization' => $request->specialization,
            'contact_number' => $request->contact_number,
            'profile_photo'  => $photoPath ?? null,
            'status'         => 'active',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // ─── Show Edit Form ───────────────────────────────────────────────────────

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // ─── Update User ──────────────────────────────────────────────────────────

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role_id'        => ['required', 'exists:roles,id'],
            'first_name'     => ['required', 'string', 'max:100'],
            'last_name'      => ['required', 'string', 'max:100'],
            'email'          => ['required', 'email', 'unique:users,email,' . $user->id],
            'department'     => ['required', 'string', 'max:150'],
            'specialization' => ['nullable', 'string', 'max:100'],
            'contact_number' => ['required', 'string', 'max:20'],
            'status'         => ['required', 'in:active,inactive'],
            'profile_photo'  => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:10240'],
        ]);

        $data = $request->only('role_id', 'first_name', 'last_name', 'email', 'department', 'specialization', 'contact_number', 'status');

        if ($request->hasFile('profile_photo')) {
            $uploaded = cloudinary()->upload($request->file('profile_photo')->getRealPath(), [
                'folder' => 'scc-reporthub/profile_photos',
            ]);
            $data['profile_photo'] = $uploaded->getSecurePath();
        }

        if ($request->filled('password')) {
            $request->validate(['password' => ['confirmed', Password::min(8)]]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // ─── Toggle User Status ───────────────────────────────────────────────────

    public function toggleStatus(User $user)
    {
        $user->update([
            'status' => $user->status === 'active' ? 'inactive' : 'active',
        ]);

        $statusLabel = $user->status === 'active' ? 'activated' : 'deactivated';
        return back()->with('success', "User account {$statusLabel} successfully.");
    }

    // ─── Delete User ──────────────────────────────────────────────────────────

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    // ─── Profile (own) ────────────────────────────────────────────────────────

    public function profile()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'first_name'     => ['required', 'string', 'max:100'],
            'last_name'      => ['required', 'string', 'max:100'],
            'department'     => ['required', 'string', 'max:150'],
            'contact_number' => ['required', 'string', 'max:20'],
            'profile_photo'  => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:10240'],
        ]);

        $data = $request->only('first_name', 'last_name', 'department', 'contact_number');

        if ($request->hasFile('profile_photo')) {
            $uploaded = cloudinary()->upload($request->file('profile_photo')->getRealPath(), [
                'folder' => 'scc-reporthub/profile_photos',
            ]);
            $data['profile_photo'] = $uploaded->getSecurePath();
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }
}


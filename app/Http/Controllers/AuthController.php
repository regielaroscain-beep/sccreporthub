<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ─── Show Login Form ──────────────────────────────────────────────────────

    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('auth.login');
    }

    // ─── Process Login ────────────────────────────────────────────────────────

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->status !== 'active') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account has been deactivated. Contact the administrator.',
                ])->onlyInput('email');
            }

            return $this->redirectByRole($user);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // ─── Show Registration Form ───────────────────────────────────────────────

    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('auth.register');
    }

    // ─── Process Registration (Faculty only — admin/maintenance are created by admin) ──

    public function register(Request $request)
    {
        $request->validate([
            'first_name'     => ['required', 'string', 'max:100'],
            'last_name'      => ['required', 'string', 'max:100'],
            'email'          => ['required', 'email', 'unique:users,email'],
            'department'     => ['required', 'string', 'max:150'],
            'contact_number' => ['required', 'string', 'max:20'],
            'password'       => ['required', 'confirmed', Password::min(8)],
            'profile_photo'  => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:10240'],
        ]);

        $facultyRole = Role::where('slug', 'faculty')->first();

        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $uploaded = cloudinary()->upload($request->file('profile_photo')->getRealPath(), [
                'folder' => 'scc-reporthub/profile_photos',
            ]);
            $photoPath = $uploaded->getSecurePath();
        }

        $user = User::create([
            'role_id'        => $facultyRole->id,
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'department'     => $request->department,
            'contact_number' => $request->contact_number,
            'profile_photo'  => $photoPath,
            'status'         => 'active',
        ]);

        Auth::login($user);

        return redirect()->route('faculty.dashboard')
            ->with('success', 'Welcome to SCC ReportHub! Your account has been created.');
    }

    // ─── Logout ───────────────────────────────────────────────────────────────

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

    // ─── Show Forgot Password Form ────────────────────────────────────────────

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // ─── Process Forgot Password ──────────────────────────────────────────────

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        // In a real deployment, send a password reset email.
        // For this local system, we show a success message.
        return back()->with('success', 'If an account with that email exists, a reset link has been sent.');
    }

    // ─── Show Change Password Form ────────────────────────────────────────────

    public function showChangePassword()
    {
        return view('auth.change-password');
    }

    // ─── Process Change Password ──────────────────────────────────────────────

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return back()->with('success', 'Password changed successfully.');
    }

    // ─── Helper: Redirect by Role ─────────────────────────────────────────────

    private function redirectByRole(User $user)
    {
        return match (true) {
            $user->isAdmin()       => redirect()->route('admin.dashboard'),
            $user->isMaintenance() => redirect()->route('maintenance.dashboard'),
            default                => redirect()->route('faculty.dashboard'),
        };
    }
}

<?php

namespace App\Http\Controllers;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    // ─── Show Login Form ──────────────────────────────────────────────────────

    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        // ── Pass lockout info to view if locked ───────────────────────────────
        $lockKey = 'login_locked_' . md5('');
        // We pass the lock expiry so the view can show countdown
        return view('auth.login');
    }

    // ─── Process Login ────────────────────────────────────────────────────────

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ── Track failed attempts via session ─────────────────────────────────
        $sessionKey = 'login_attempts_' . md5(Str::lower($request->email));
        $lockKey    = 'login_locked_' . md5(Str::lower($request->email));
        $ipLockKey  = 'login_locked_ip_' . md5($request->ip());

        // Check if locked out (by email or IP)
        $lockedUntil = session($lockKey) ?? session($ipLockKey);
        if ($lockedUntil && $lockedUntil > now()->timestamp) {
            $seconds = $lockedUntil - now()->timestamp;
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$seconds} seconds.",
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Clear attempts on success
            session()->forget([$sessionKey, $lockKey, $ipLockKey]);
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

        // ── Increment failed attempts ─────────────────────────────────────────
        $attempts = session($sessionKey, 0) + 1;
        session([$sessionKey => $attempts]);

        $remaining = max(0, 5 - $attempts);

        if ($attempts >= 5) {
            // Lock for 60 seconds — store with IP-based key so it persists on refresh
            $ipLockKey = 'login_locked_ip_' . md5($request->ip());
            session([$lockKey => now()->addSeconds(60)->timestamp]);
            session([$ipLockKey => now()->addSeconds(60)->timestamp]);
            session()->forget($sessionKey);
            return back()->withErrors([
                'email' => 'Too many failed attempts. Please wait 1 minute before trying again.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => "The provided credentials do not match our records. {$remaining} attempt(s) remaining.",
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
            'email'          => ['required', 'email', 'unique:users,email', 'ends_with:@southernchristiancollege.edu.ph'],
            'department'     => ['required', 'string', 'max:150'],
            'contact_number' => ['required', 'string', 'max:20'],
            'password'       => ['required', 'confirmed', Password::min(8)
                                    ->mixedCase()
                                    ->numbers()
                                    ->symbols()
                                    ->uncompromised()],
            'profile_photo'  => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:10240'],
        ]);

        $facultyRole = Role::where('slug', 'faculty')->first();

        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $cloudinary = new Cloudinary(Configuration::instance(env('CLOUDINARY_URL')));
            $result = $cloudinary->uploadApi()->upload($request->file('profile_photo')->getRealPath(), ['folder' => 'scc-reporthub/profile_photos']);
            $photoPath = $result['secure_url'];
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
            ->with('success', 'Account created successfully! Welcome to SCC ReportHub.');
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
            'password'         => ['required', 'confirmed', Password::min(8)
                                    ->mixedCase()
                                    ->numbers()
                                    ->symbols()],
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

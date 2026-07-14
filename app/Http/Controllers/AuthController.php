<?php

namespace App\Http\Controllers;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

            // Block unverified faculty from logging in
            if (! $user->hasVerifiedEmail() && $user->isFaculty()) {
                Auth::logout();
                return redirect()->route('verification.notice')
                    ->with('sent_email', $user->email)
                    ->with('error', 'Please verify your email address before logging in.');
            }

            return $this->redirectByRole($user);
        }

        // ── Increment failed attempts ─────────────────────────────────────────
        $attempts = session($sessionKey, 0) + 1;
        session([$sessionKey => $attempts]);

        $remaining = max(0, 5 - $attempts);

        if ($attempts >= 5) {
            // Lock for 60 seconds
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

        // Send verification email via Brevo
        $this->sendVerificationEmail($user);

        return redirect()->route('verification.notice')
            ->with('sent_email', $user->email);
    }

    // ─── Show Email Verified Success Page ────────────────────────────────────

    public function verificationSuccess()
    {
        return view('auth.email-verified');
    }

    // ─── Show Email Verification Notice ──────────────────────────────────────

    public function verificationNotice()
    {
        if (Auth::check() && Auth::user()->hasVerifiedEmail()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('auth.verify-email');
    }

    // ─── Verify Email via Signed Link ────────────────────────────────────────

    public function verifyEmail(Request $request, int $id, string $hash)
    {
        $user = User::findOrFail($id);

        if (! hash_equals(sha1($user->email), $hash)) {
            abort(403, 'Invalid verification link.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')
                ->with('success', 'Your email is already verified. Please log in.');
        }

        $user->markEmailAsVerified();

        return redirect()->route('verification.success');
    }

    // ─── Resend Verification Email ────────────────────────────────────────────

    public function resendVerification(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        $user = User::where('email', $request->email)->first();

        if ($user && ! $user->hasVerifiedEmail()) {
            $this->sendVerificationEmail($user);
        }

        return back()->with('success', true)->with('sent_email', $request->email);
    }

    // ─── Send Verification Email via Brevo ───────────────────────────────────

    private function sendVerificationEmail(User $user): void
    {
        $hash       = sha1($user->email);
        $verifyUrl  = route('verification.verify', [
            'id'   => $user->id,
            'hash' => $hash,
        ]);

        $this->sendBrevoEmail(
            toEmail:     $user->email,
            toName:      $user->first_name,
            subject:     'SCC ReportHub – Verify Your Email Address',
            htmlContent: $this->buildVerificationEmailHtml($user->first_name, $verifyUrl),
        );
    }

    // ─── Build Verification Email HTML ───────────────────────────────────────

    private function buildVerificationEmailHtml(string $userName, string $verifyUrl): string
    {
        return view('emails.verify-email', [
            'userName'  => $userName,
            'verifyUrl' => $verifyUrl,
        ])->render();
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
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $request->email)->first();

        // Always show the same message to prevent email enumeration
        if ($user) {
            // Delete any existing token for this email
            DB::table('password_reset_tokens')->where('email', $user->email)->delete();

            // Generate a secure token
            $token = Str::random(64);

            DB::table('password_reset_tokens')->insert([
                'email'      => $user->email,
                'token'      => Hash::make($token),
                'created_at' => now(),
            ]);

            $resetUrl = route('password.reset', [
                'token' => $token,
                'email' => $user->email,
            ]);

            $this->sendBrevoEmail(
                toEmail: $user->email,
                toName:  $user->first_name,
                subject: 'SCC ReportHub – Password Reset Request',
                htmlContent: $this->buildResetEmailHtml($user->first_name, $resetUrl),
            );
        }

        return back()->with('success', true)->with('sent_email', $request->email);
    }

    // ─── Send Email via Brevo HTTP API (bypasses SMTP port restrictions) ──────

    private function sendBrevoEmail(string $toEmail, string $toName, string $subject, string $htmlContent): void
    {
        $client = new \GuzzleHttp\Client();

        $client->post('https://api.brevo.com/v3/smtp/email', [
            'headers' => [
                'accept'      => 'application/json',
                'api-key'     => env('BREVO_API_KEY'),
                'content-type'=> 'application/json',
            ],
            'json' => [
                'sender'      => [
                    'name'  => config('mail.from.name'),
                    'email' => config('mail.from.address'),
                ],
                'to'          => [['email' => $toEmail, 'name' => $toName]],
                'subject'     => $subject,
                'htmlContent' => $htmlContent,
            ],
        ]);
    }

    // ─── Build Reset Email HTML ───────────────────────────────────────────────

    private function buildResetEmailHtml(string $userName, string $resetUrl): string
    {
        return view('emails.password-reset', [
            'userName' => $userName,
            'resetUrl' => $resetUrl,
        ])->render();
    }

    // ─── Show Reset Password Form ─────────────────────────────────────────────

    public function showResetPassword(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    // ─── Process Reset Password ───────────────────────────────────────────────

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => ['required'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed', Password::min(8)
                            ->mixedCase()
                            ->numbers()
                            ->symbols()],
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        // Check token exists, matches, and is not older than 60 minutes
        if (! $record
            || ! Hash::check($request->token, $record->token)
            || now()->diffInMinutes($record->created_at) > 60
        ) {
            return back()->withErrors([
                'email' => 'This password reset link is invalid or has expired. Please request a new one.',
            ])->withInput(['email' => $request->email]);
        }

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'No account found for this email.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        // Delete the used token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')
            ->with('success', 'Your password has been reset successfully. You can now log in.');
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

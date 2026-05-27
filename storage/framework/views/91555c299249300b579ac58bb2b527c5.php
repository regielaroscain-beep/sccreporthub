
<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>


<?php
    $ipLockKey = 'login_locked_ip_' . md5(request()->ip());
    $lockedUntil = session($ipLockKey);
    $isLocked = $lockedUntil && $lockedUntil > now()->timestamp;
    $lockSeconds = $isLocked ? ($lockedUntil - now()->timestamp) : 0;
?>

<?php if($isLocked): ?>
<div class="alert alert-danger d-flex align-items-center gap-2 mb-3" id="lockoutAlert">
    <i class="fas fa-lock"></i>
    <span>Too many failed attempts. Try again in <strong id="lockCountdown"><?php echo e($lockSeconds); ?></strong> second(s).</span>
</div>
<?php endif; ?>


<div class="text-center mb-3">
    <div class="auth-logo-wrap mx-auto mb-2">
        <img src="<?php echo e(asset('images/scc-logo.png')); ?>" alt="SCC Logo"
             id="authLogo"
             style="width:85px;height:85px;object-fit:contain;"
             onerror="this.style.display='none'">
    </div>
    <h4 class="fw-bold mb-0" style="background:linear-gradient(135deg,#4f46e5,#06b6d4);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">SCC ReportHub</h4>
    <p class="text-muted small mb-0">Southern Christian College</p>
    <p class="text-muted small mb-0">Campus Facility Status Report & Monitoring System</p>
</div>
<hr class="mb-3">

<h5 class="text-center fw-semibold mb-4">Sign In to Your Account</h5>

<form method="POST" action="<?php echo e(route('login.post')); ?>">
    <?php echo csrf_field(); ?>

    
    <div class="mb-4">
        <label class="form-label">Login as</label>
        <div class="row g-2" id="roleSelector">
            <div class="col-4">
                <input type="radio" class="btn-check" name="login_role" id="role_admin" value="admin"
                       <?php echo e(old('login_role') === 'admin' ? 'checked' : ''); ?>>
                <label class="btn btn-outline-secondary w-100 role-btn" for="role_admin">
                    <i class="fas fa-user-shield d-block mb-1" style="font-size:1.3rem;"></i>
                    <span style="font-size:0.78rem;">Admin</span>
                </label>
            </div>
            <div class="col-4">
                <input type="radio" class="btn-check" name="login_role" id="role_maintenance" value="maintenance"
                       <?php echo e(old('login_role') === 'maintenance' ? 'checked' : ''); ?>>
                <label class="btn btn-outline-secondary w-100 role-btn" for="role_maintenance">
                    <i class="fas fa-screwdriver-wrench d-block mb-1" style="font-size:1.3rem;"></i>
                    <span style="font-size:0.78rem;">Maintenance</span>
                </label>
            </div>
            <div class="col-4">
                <input type="radio" class="btn-check" name="login_role" id="role_faculty" value="faculty"
                       <?php echo e((old('login_role') === 'faculty' || !old('login_role')) ? 'checked' : ''); ?>>
                <label class="btn btn-outline-secondary w-100 role-btn" for="role_faculty">
                    <i class="fas fa-chalkboard-user d-block mb-1" style="font-size:1.3rem;"></i>
                    <span style="font-size:0.78rem;">Faculty/Staff</span>
                </label>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   value="<?php echo e(old('email')); ?>" placeholder="your@email.com" required autofocus>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
            <input type="password" name="password" id="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   placeholder="••••••••" required>
            <button type="button" class="input-group-text bg-white border-start-0" onclick="togglePassword('password', 'eyeIcon')">
                <i class="fas fa-eye text-muted" id="eyeIcon"></i>
            </button>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label small" for="remember">Remember me</label>
        </div>
        <a href="<?php echo e(route('password.request')); ?>" class="text-primary small">Forgot password?</a>
    </div>

    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
        <i class="fas fa-arrow-right-to-bracket me-2"></i>Sign In
    </button>
</form>


<div id="registerLink" class="mt-4 text-center" style="display:none;">
    <hr class="mb-3">
    <p class="text-muted small mb-0">
        Don't have an account?
        <a href="<?php echo e(route('register')); ?>" class="text-primary fw-semibold">Create an account</a>
    </p>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.role-btn {
    padding: 12px 6px;
    border-radius: 10px;
    transition: all 0.15s;
    border-color: #e2e8f0;
    color: #64748b;
}
.btn-check:checked + .role-btn {
    background: #eef2ff;
    border-color: #4f46e5;
    color: #4f46e5;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
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
    const link = document.getElementById('registerLink');
    link.style.display = selected === 'faculty' ? 'block' : 'none';
}

// Run on load and on change
document.querySelectorAll('input[name="login_role"]').forEach(r => {
    r.addEventListener('change', updateRegisterLink);
});
updateRegisterLink();

// ── Lockout Countdown ─────────────────────────────────────────────────────────
const countdownEl = document.getElementById('lockCountdown');
if (countdownEl) {
    // Disable submit button while locked
    const submitBtn = document.querySelector('button[type="submit"]');
    if (submitBtn) submitBtn.disabled = true;

    let seconds = parseInt(countdownEl.textContent);
    const timer = setInterval(() => {
        seconds--;
        if (seconds <= 0) {
            clearInterval(timer);
            // Reload page to clear lockout banner and re-enable form
            window.location.reload();
        } else {
            countdownEl.textContent = seconds;
        }
    }, 1000);
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/auth/login.blade.php ENDPATH**/ ?>
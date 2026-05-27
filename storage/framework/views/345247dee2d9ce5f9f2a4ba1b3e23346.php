
<?php $__env->startSection('title', 'Verify Email'); ?>

<?php $__env->startSection('content'); ?>

<div class="text-center mb-4">
    <div class="mb-3">
        <span style="font-size:3rem;">📧</span>
    </div>
    <h4 class="fw-bold mb-1">Verify Your Email</h4>
    <p class="text-muted small">We sent a verification link to your email address. Please check your inbox and click the link to activate your account.</p>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="alert alert-info small">
    <i class="fas fa-info-circle me-2"></i>
    Didn't receive the email? Check your spam folder or click the button below to resend.
</div>

<form method="POST" action="<?php echo e(route('verification.send')); ?>">
    <?php echo csrf_field(); ?>
    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
        <i class="fas fa-paper-plane me-2"></i>Resend Verification Email
    </button>
</form>

<div class="mt-3 text-center">
    <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-link text-muted small p-0">
            <i class="fas fa-arrow-left me-1"></i>Back to Login
        </button>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/auth/verify-email.blade.php ENDPATH**/ ?>
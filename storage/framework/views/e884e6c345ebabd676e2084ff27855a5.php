
<?php $__env->startSection('title', 'Submit Feedback'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <h4 class="fw-bold mb-0"><i class="fas fa-star me-2 text-warning"></i>Submit Feedback</h4>
    <a href="<?php echo e(route('faculty.tickets.show', $ticket)); ?>" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">

        <!-- Ticket Info -->
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-12 col-sm-4">
                        <div class="text-muted small">Ticket #</div>
                        <div class="fw-semibold"><code><?php echo e($ticket->ticket_number); ?></code></div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="text-muted small">Title</div>
                        <div class="small fw-semibold"><?php echo e(Str::limit($ticket->title, 40)); ?></div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="text-muted small">Assigned To</div>
                        <div class="small"><?php echo e($ticket->assignedStaff?->full_name ?? '—'); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback Form -->
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h6 class="fw-semibold mb-4 text-center">How would you rate the maintenance service?</h6>

                <form method="POST" action="<?php echo e(route('faculty.feedback.store', $ticket)); ?>">
                    <?php echo csrf_field(); ?>

                    <!-- Star Rating -->
                    <div class="mb-4 text-center">
                        <div class="d-flex justify-content-center gap-2 mb-2" id="starRating">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star text-muted star-btn" data-value="<?php echo e($i); ?>"
                               style="cursor:pointer; font-size:2rem;"></i>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" name="rating" id="ratingInput" value="<?php echo e(old('rating')); ?>" required>
                        <div class="text-muted small mt-1" id="ratingLabel">Click a star to rate</div>
                        <?php $__errorArgs = ['rating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Comments <span class="text-muted fw-normal small">(optional)</span></label>
                        <textarea name="comment" class="form-control" rows="3"
                                  placeholder="Share your experience..."><?php echo e(old('comment')); ?></textarea>
                        <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 fw-semibold">
                        <i class="fas fa-paper-plane me-2"></i>Submit Feedback
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const stars = document.querySelectorAll('.star-btn');
const ratingInput = document.getElementById('ratingInput');
const ratingLabel = document.getElementById('ratingLabel');
const labels = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];

function setStars(val) {
    stars.forEach((s, i) => {
        s.classList.toggle('text-warning', i < val);
        s.classList.toggle('text-muted', i >= val);
    });
}

stars.forEach(star => {
    star.addEventListener('click', function() {
        const val = parseInt(this.dataset.value);
        ratingInput.value = val;
        ratingLabel.textContent = labels[val];
        setStars(val);
    });
    star.addEventListener('mouseover', function() {
        setStars(parseInt(this.dataset.value));
    });
    star.addEventListener('mouseout', function() {
        setStars(parseInt(ratingInput.value) || 0);
    });
});

const prev = parseInt(ratingInput.value);
if (prev) { ratingLabel.textContent = labels[prev]; setStars(prev); }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/faculty/feedback/create.blade.php ENDPATH**/ ?>
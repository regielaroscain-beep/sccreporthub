
<?php $__env->startSection('title', 'Create Ticket Request'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-circle-plus me-2 text-primary"></i>Create Ticket Request</h4>
        <p class="text-muted small mb-0">Input location, describe the issue, upload photo evidence, then submit</p>
    </div>
    <a href="<?php echo e(route('faculty.tickets.index')); ?>" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">

        <div class="card shadow-sm">
            <div class="card-body p-3 p-md-4">
                <form method="POST" action="<?php echo e(route('faculty.tickets.store')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Issue Category <span class="text-danger">*</span></label>
                        <select name="issue_category" class="form-select <?php $__errorArgs = ['issue_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">-- Select a category --</option>
                            <?php $__currentLoopData = \App\Models\Ticket::CATEGORIES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value); ?>" <?php echo e(old('issue_category') == $value ? 'selected' : ''); ?>>
                                <?php echo e($label); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['issue_category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Facility Location</label>
                        <select name="location_id" class="form-select <?php $__errorArgs = ['location_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">-- Select a facility --</option>
                            <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($facility->id); ?>" <?php echo e(old('location_id') == $facility->id ? 'selected' : ''); ?>>
                                <?php echo e($facility->full_location); ?>

                            </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['location_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Request Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('title')); ?>" placeholder="e.g. Broken ceiling fan in Room 201" required>
                        <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Detailed Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  rows="4" placeholder="Describe the issue in detail..." required><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Photo Evidence <span class="text-muted fw-normal small">(optional, max 10MB)</span></label>

                        
                        <div id="uploadArea" class="upload-area border rounded p-3 text-center" style="cursor:pointer; border-style:dashed !important; border-color:#6c757d; background:#f8f9fa;" onclick="document.getElementById('photoInput').click()">
                            <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                            <p class="mb-0 text-muted small">Click to browse or drag & drop a photo here</p>
                            <p class="mb-0 text-muted" style="font-size:0.72rem;">Any image format (JPG, PNG, WEBP, GIF, etc.) — max 10MB</p>
                        </div>
                        <input type="file" name="photo" id="photoInput" class="d-none <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               accept="image/*" onchange="previewPhoto(this)">
                        <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback d-block"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        
                        <div id="photoPreview" class="mt-3 d-none">
                            <div class="d-flex justify-content-center">
                                <div class="position-relative" style="width:180px;">
                                    <img id="previewImg" src="" alt="Preview"
                                         class="rounded shadow-sm w-100"
                                         style="height:240px; object-fit:cover; object-position:center; display:block;">
                                    <button type="button"
                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 rounded-circle p-0"
                                            style="width:24px;height:24px;line-height:1;"
                                            onclick="clearPhoto()" title="Remove photo">
                                        <i class="fas fa-times" style="font-size:0.65rem;"></i>
                                    </button>
                                </div>
                            </div>
                            <p id="photoFileName" class="text-center text-muted mt-1 mb-0" style="font-size:0.75rem;"></p>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Submit Request
                        </button>
                        <a href="<?php echo e(route('faculty.dashboard')); ?>" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('photoFileName').textContent = file.name;
            document.getElementById('photoPreview').classList.remove('d-none');
            document.getElementById('uploadArea').classList.add('d-none');
        };
        reader.readAsDataURL(file);
    }
}

function clearPhoto() {
    document.getElementById('photoInput').value = '';
    document.getElementById('photoPreview').classList.add('d-none');
    document.getElementById('uploadArea').classList.remove('d-none');
}

// Drag & drop support
document.addEventListener('DOMContentLoaded', function () {
    const area = document.getElementById('uploadArea');
    const input = document.getElementById('photoInput');

    area.addEventListener('dragover', e => {
        e.preventDefault();
        area.style.borderColor = '#0d6efd';
        area.style.background = '#e8f0fe';
    });
    area.addEventListener('dragleave', () => {
        area.style.borderColor = '#6c757d';
        area.style.background = '#f8f9fa';
    });
    area.addEventListener('drop', e => {
        e.preventDefault();
        area.style.borderColor = '#6c757d';
        area.style.background = '#f8f9fa';
        if (e.dataTransfer.files.length) {
            input.files = e.dataTransfer.files;
            previewPhoto(input);
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\scc-reporthub\resources\views/faculty/tickets/create.blade.php ENDPATH**/ ?>
<?php if (session()->get('success')): ?>
    <div class="d-flex justify-content-center" style="position: absolute; top: 20px; left: 0; width: 100%; z-index: 100;">
        <div class="bs-toast toast alert-success shadow-lg border-0 py-3" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="text-center">
                <p class="px-3 m-0 text-white"><?= session()->get('success'); ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php if (session()->get('danger')): ?>
    <div class="d-flex justify-content-center" style="position: absolute; top: 20px; left: 0; width: 100%; z-index: 100;">
        <div class="bs-toast toast alert-danger shadow-lg border-0 py-3" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="text-center">
                <p class="px-3 m-0 text-white"><?= session()->get('danger'); ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->get('access')): ?>
    <div class="d-flex justify-content-center" style="position: absolute; top: 20px; left: 0; width: 100%; z-index: 100;">
        <div class="bs-toast toast alert-danger shadow-lg border-0 py-3" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="text-center">
                <p class="px-3 m-0 text-white"><?= session()->get('access'); ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php if (session()->get('warning')): ?>
    <div class="d-flex justify-content-center" style="position: absolute; top: 20px; left: 0; width: 100%; z-index: 100;">
        <div class="bs-toast toast alert-warning shadow-lg border-0 py-3" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="text-center">
                <p class="px-3 m-0 text-white"><?= session()->get('warning'); ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>


<script>
    setTimeout(function() {
        var toastElement = document.querySelector('.toast');
        var toast = new bootstrap.Toast(toastElement);
        toast.show(); // Show the toast
        setTimeout(function() {
            toast.hide(); // Hide the toast
        }, 3000); // Hide after 30 seconds
    }, 99); // Show after 99 milliseconds
</script>
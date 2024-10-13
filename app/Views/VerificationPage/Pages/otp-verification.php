<?= $this->extend('/VerificationPage/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div class="vh-100 d-flex flex-column justify-content-center align-items-center">
    <div class="page-heading">
        <div class="text-center">
            <img src="/assets/tcu/logo-square.png" style="max-height: 100px; width: auto;" alt="Philsca Logo">

            <h1 class="mb-0 mt-2">Email Verification</h1>
            <p>Please check your email for OTP Code. You have attempted <strong><?= session('otp_attempts') ?? 0; ?></strong> out of 5 attempts.</p>
        </div>
    </div>

    <div class="page-content">
        <form action="#" method="post">
            <div class="mt-3">
                <input type="text" class="form-control form-control-lg text-center" name="verification_code" placeholder="OTP Code" id="verification_code" oninput="validateNumber(this)" autofocus>

                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    OTP is Incorrect
                </div>
            </div>

            <input type="hidden" name="check_attempt" value="true">

            <button type="submit" class="btn btn-primary btn-block btn-md shadow-lg mt-3">Confirm</button>
            <div class="text-center mt-3">
                <a href="/LoginController/CancelRegistration" class="text-decoration-none">
                    <span class="text-sm text-muted">
                        <i class="bi bi-chevron-left"></i> Cancel
                    </span>
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function validateNumber(input) {
        input.value = input.value.replace(/[^0-9]/g, '').slice(0, 6);
    }
</script>

<?= $this->endSection(); ?>
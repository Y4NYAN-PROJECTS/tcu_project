<?= $this->extend('/LoginPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div class="col-md-5 d-flex justify-content-center align-items-center">
    <div class="container p-5">
        <div>
            <h1 class="mb-0">Forgot Password</h1>
            <p class="mb-0">Input username and email then check your email for your temporary password.</p>
            <small class="text-muted mb-0">Incorrect username or email, shall not recieve temporary password.</small>
        </div>

        <hr class="mb-0">

        <form action="/LoginController/ResetPassword" method="post">
            <div class="form-group position-relative has-icon-left mt-3">
                <input type="text" class="form-control form-control-lg" name="forgot_username" placeholder="Username" id="username" autofocus required>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
            </div>

            <div class="form-group position-relative has-icon-left mt-3">
                <input type="text" class="form-control form-control-lg" name="forgot_email" placeholder="johndoe@gmail.com" id="email" required>
                <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>

            <input type="hidden" name="check_login" value="true">

            <button type="submit" class="btn btn-primary btn-block btn-md shadow-lg mt-3">Reset Password</button>
        </form>

        <div class="text-center mt-2">
            <a href="/LoginController/UserTypePage" class="text-decoration-none">
                <span class="text-sm text-muted">
                    <i class="bi bi-chevron-left"></i> Cancel
                </span>
            </a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
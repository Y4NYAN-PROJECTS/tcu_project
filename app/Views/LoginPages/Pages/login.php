<?= $this->extend('/LoginPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div class="col-md-5 d-flex justify-content-center align-items-center my-5">
    <div class="container p-5">
        <div class="d-flex align-items-center">
            <div class="col-auto pr-0 me-3" style="height: 80px;">
                <img src="/assets/tcu/logo-square.png" style="max-height: 100%; width: auto;" alt="">
            </div>
            <div class="col pl-0">
                <h1 class="mb-0">Log in.</h1>
                <p class="mb-0">Log in with your data that you entered during registration.</p>
            </div>
        </div>
        <hr class="mb-0">

        <?php if ($user_type_id == 0): ?>
            <div class="pt-3 pb-2 text-center">
                <span class="badge bg-primary px-3 py-2">Administrator Login</span>
            </div>
        <?php elseif ($user_type_id == 1): ?>
            <div class="pt-3 pb-2 text-center">
                <span class="badge bg-primary px-3 py-2">Student Login</span>
            </div>
        <?php endif; ?>

        <form action="/LoginController/LoginPage/<?= $user_type_id ?>" method="post">
            <div class="form-group position-relative has-icon-left mt-3">
                <input type="text" class="form-control form-control-lg" name="username" placeholder="Username" id="username" autofocus required>
                <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div>
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    Incorrect Username
                </div>
            </div>

            <div class="form-group position-relative has-icon-left mt-3">
                <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" id="password" required>
                <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    Wrong Password
                </div>
            </div>

            <div class="text-end ">
                <a href="/LoginController/ForgotPasswordPage"><small class="text-muted">Forgot Password?</small></a>
            </div>

            <input type="hidden" name="check_login" value="true">

            <button type="submit" class="btn btn-primary btn-block btn-md shadow-lg mt-3">Log in</button>
        </form>

        <div class="text-center mt-2">
            <p>Don't have an account? <a href="/LoginController/RegisterPage/<?= $user_type_id ?>" class="font-bold">Register Now</a></p>
            <a href="/LoginController/UserTypePage" class="text-decoration-none">
                <span class="text-sm text-muted">
                    <i class="bi bi-chevron-left"></i> Return
                </span>
            </a>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        var username = <?= json_encode($username) ?>;
        var usernameError = <?= json_encode($usernameError) ?>;
        var passwordError = <?= json_encode($passwordError) ?>;
        var checkLogin = <?= json_encode($checkLogin) ?>;

        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');

        if (checkLogin) {
            if (usernameError && passwordError) {
                usernameInput.focus();
                usernameInput.classList.add("is-invalid");
                passwordInput.classList.add("is-invalid");

                usernameInput.addEventListener('input', function () {
                    usernameInput.classList.remove("is-invalid");
                    passwordInput.classList.remove("is-invalid");
                });
            } else if (passwordError) {
                usernameInput.value = username;
                passwordInput.focus();
                usernameInput.classList.remove("is-invalid");
                passwordInput.classList.add("is-invalid");
                passwordInput.addEventListener('input', function () {
                    passwordInput.classList.remove("is-invalid");
                });
            } else {
                usernameInput.classList.remove("is-invalid");
                passwordInput.classList.remove("is-invalid");
            }
        }
    });
</script>


<?= $this->endSection(); ?>
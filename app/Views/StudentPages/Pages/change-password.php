<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mt-5">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Change Password</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/StudentController/DashboardPage">Dashboard</a></li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body mb-3">
                <form action="/StudentController/ChangePasswordPage" method="post">
                    <div class="row d-flex justify-content-center align-items-center mt-3">
                        <div class="col-md-8">
                            <small>Note: Remember your password. To change your password kindly fill up the form below.</small>
                            <hr class="text-primary mt-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="newPassword">New Password</label>
                                        <input type="password" class="form-control mt-2" id="newPassword" name="new_password" autofocus>
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Password must be 8 characters long.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label for="oldPassword">Current Password</label>
                                        <input type="password" class="form-control mt-2" id="oldPassword" name="old_password">
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Password does not match.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="password_check" value="true">
                            <button type="submit" class="btn btn-primary form-control mt-3" id="submitButton">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var passwordError = <?= json_encode($isPasswordError) ?>;
        var checkPassword = <?= json_encode($isPasswordCheck) ?>;

        const newPasswordInput = document.getElementById('oldPassword');

        if (checkPassword) {
            newPasswordInput.addEventListener('input', function () {
                newPasswordInput.classList.remove("is-invalid");
            });
            if (passwordError) {
                newPasswordInput.focus();
                newPasswordInput.classList.add("is-invalid");
            } else {
                newPasswordInput.classList.remove("is-invalid");
            }
        }
    });

    const newPasswordInput = document.getElementById('newPassword');
    const submitButton = document.getElementById('submitButton');

    newPasswordInput.addEventListener('input', function () {
        if (newPasswordInput.value.length >= 8) {
            newPasswordInput.classList.remove("is-invalid");
            submitButton.disabled = false;
        } else {
            newPasswordInput.classList.add("is-invalid");
            submitButton.disabled = true;
        }
    });
</script>

<?= $this->endSection(); ?>
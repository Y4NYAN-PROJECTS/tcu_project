<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Change Email</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/StudentController/DashboardPage">Dashboard</a></li>
                            <li class="breadcrumb-item active">Change Email</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body mb-3">
                <form action="/StudentController/ChangeEmailPage" method="post">
                    <div class="row d-flex justify-content-center align-items-center mt-3">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="newEmail">New Email</label>
                                        <input type="text" class="form-control" id="newEmail" name="new_email" autofocus>
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Invalid Email.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="confirmEmail">Confirm Email</label>
                                        <input type="text" class="form-control" id="confirmEmail" name="confirm_email">
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Email does not match.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="email_check" value="true">
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

    const newEmailInput = document.getElementById('newEmail');
    const confirmEmailInput = document.getElementById('confirmEmail');
    const submitButton = document.getElementById('submitButton');

    newEmailInput.addEventListener('input', function () {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (emailPattern.test(newEmailInput.value)) {
            if (newEmailInput.value == confirmEmailInput.value) {
                confirmEmailInput.classList.remove("is-invalid");
                submitButton.disabled = false;
            }
            newEmailInput.classList.remove("is-invalid");
            submitButton.disabled = false;
        } else {
            newEmailInput.classList.add("is-invalid");
            submitButton.disabled = true;
        }
    });



    confirmEmailInput.addEventListener('input', function () {
        if (newEmailInput.value == confirmEmailInput.value) {
            confirmEmailInput.classList.remove("is-invalid");
            submitButton.disabled = false;
        } else {
            confirmEmailInput.classList.add("is-invalid");
            submitButton.disabled = true;
        }
    });
</script>

<?= $this->endSection(); ?>
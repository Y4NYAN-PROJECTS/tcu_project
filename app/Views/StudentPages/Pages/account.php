<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mt-5">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Account Profile</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-last">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Account Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body mb-3">
                <div class="row d-flex justify-content-center align-items-center mt-3">
                    <div class="text-center mb-3">
                        <img src="<?= session()->get('logged_profile') ?>" class="rounded-circle mx-auto mb-3" style="width: 15%; object-fit: cover; aspect-ratio: 1/1;">
                        <h2><?= session()->get('logged_fullname') ?></h2>
                        <small>Student No. <?= session()->get('logged_student_id') ?></small>
                    </div>
                    <hr class="mb-5">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-xl-4">
                                <div class="form-group">
                                    <div class="form-group mb-4">
                                        <label class="text-sm" for="">First Name</label>
                                        <input type="text" class="form-control" value="<?= session()->get('logged_firstname') ?>" disabled>
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Contains special characters or numbers
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-4">
                                <div class="form-group">
                                    <div class="form-group mb-3">
                                        <label class="text-sm" for="">Middle Name</label>
                                        <input type="text" class="form-control" value="<?= session()->get('logged_middlename') ?>" disabled>
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Contains special characters or numbers
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-4">
                                <div class="form-group">
                                    <div class="form-group mb-3">
                                        <label class="text-sm" for="">Last Name</label>
                                        <input type="text" class="form-control" value="<?= session()->get('logged_lastname') ?>" disabled>
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Contains special characters or numbers
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-xl-6">
                                <div class="form-group">
                                    <div class="form-group mb-4">
                                        <label class="text-sm" for="">Department</label>
                                        <input type="text" class="form-control" value="<?= $department['department_title'] ?>" disabled>
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Contains special characters or numbers
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-6">
                                <div class="form-group">
                                    <div class="form-group mb-3">
                                        <label class="text-sm" for="">Program</label>
                                        <input type="text" class="form-control" value="<?= $program['program_title'] ?>" disabled>
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            Contains special characters or numbers
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    const nameInput = document.getElementById('new_full_name');
    nameInput.addEventListener('input', function () {
        const namePattern = /^[a-zA-Z\s]+$/;
        if (namePattern.test(nameInput.value)) {
            nameInput.classList.remove("is-invalid");
            submitButton.disabled = false;
        } else {
            nameInput.classList.add("is-invalid");
            submitButton.disabled = true;
        }
    });
</script>

<?= $this->endSection(); ?>
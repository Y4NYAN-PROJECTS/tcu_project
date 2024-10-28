<?= $this->extend('/AdminPages/Components/main-layout'); ?>
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
            <div class="card-body mb-3">>
                <div class="row d-flex justify-content-center align-items-center mt-3">
                    <div class="text-center mb-3">
                        <img src="<?= $profile['profile_path'] ?>" class="rounded-circle mx-auto mb-3"
                            style="width: 15%; object-fit: cover; aspect-ratio: 1/1;">
                        <h3><?= $profile['full_name'] ?></h3>
                    </div>
                    <hr class="mb-5">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-xl-4">
                                <div class="form-group">
                                    <div class="form-group mb-4">
                                        <label class="text-sm" for="">First Name</label>
                                        <input type="text" class="form-control"
                                            value="<?= $profile['first_name'] ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-4">
                                <div class="form-group">
                                    <div class="form-group mb-3">
                                        <label class="text-sm" for="">Middle Name</label>
                                        <input type="text" class="form-control"
                                            value="<?= $profile['middle_name'] ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-4">
                                <div class="form-group">
                                    <div class="form-group mb-3">
                                        <label class="text-sm" for="">Last Name</label>
                                        <input type="text" class="form-control"
                                            value="<?= $profile['last_name'] ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-xl-6">
                                <div class="form-group">
                                    <div class="form-group mb-4">
                                        <label class="text-sm" for="">Department</label>
                                        <input type="text" class="form-control"
                                            value="<?= $department['department_acronym'] ?>" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-xl-6">
                                <div class="form-group">
                                    <div class="form-group mb-3">
                                        <label class="text-sm" for="">Program</label>
                                        <input type="text" class="form-control"
                                            value="<?= $program['program_acronym'] ?>" disabled>
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
<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Update Profile</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/StudentController/DashboardPage">Dashboard</a></li>
                            <li class="breadcrumb-item active">Update Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body mb-3">
                <form action="/StudentController/ProfileUpdate" method="post" enctype="multipart/form-data">
                    <div class="row d-flex justify-content-center align-items-center mt-3">
                        <div class="text-center mb-3">
                            <img src="<?= session()->get('logged_profile') ?>" class="rounded-circle mx-auto mb-3" style="width: 15%; object-fit: cover; aspect-ratio: 1/1;">
                            <h3><?= session()->get('logged_fullname') ?></h3>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group mb-3">
                                            <label class="text-sm" for="">Full Name</label>
                                            <input type="text" id="new_full_name" class="form-control" name="new_name" placeholder="Change name" autofocus>
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                Contains special characters or numbers
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="confirmEmail">Change Profile Image</label>
                                        <small class="text-muted">(Formats: JPG, PNG | Max size: 5MB)</small>
                                        <input type="file" class="image-crop-filepond" image-crop-aspect-ratio="1:1" data-max-file-size="5MB" data-max-files="1" name="new_profile">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="email_check" value="true">
                            <button type="submit" class="btn btn-primary form-control mt-3" id="submitButton" onclick="return confirm('Are you sure you want to update profile?');">Save Changes</button>
                        </div>
                    </div>
                </form>
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
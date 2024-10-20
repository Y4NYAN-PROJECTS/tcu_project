<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Program</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Program</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Program List</h5>
                <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#new_program_modal">New Program</button>
            </div>

            <hr class="mt-1">

            <div class="card-body">
                <div class="table-responsive table-hover table-bordered">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>Program Acronym</th>
                                <th>Program Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($programs as $program): ?>
                                <tr>
                                    <td><?= $program['department_title'] ?></td>
                                    <td><?= $program['program_acronym'] ?></td>
                                    <td><?= $program['program_title'] ?></td>
                                    <td>
                                        <div class="">
                                            <button class="btn btn-primary btn-sm dropdown-toggle me-1" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown">
                                                <i class="bi bi-error-circle"></i> Actions
                                            </button>
                                            <div class="dropdown-menu shadow-lg">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#update_program_modal" data-program-id="<?= $program['program_id'] ?>" data-program-code="<?= $program['program_acronym'] ?>" data-program-name="<?= $program['program_title'] ?>">
                                                    <i class="bi bi-pencil-square me-3"></i> Update</a>

                                                <a class="dropdown-item" href="/AdminController/ProgramDelete/<?= $program['program_id'] ?>" onclick="return confirm('Are you sure you want to delete this program? This action cannot be undone.');">
                                                    <i class="bi bi-trash3 me-3"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="new_program_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2>New Program</h2>
                            <small class="text-muted mb-0">Please fill this form to add a new program.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="/AdminController/ProgramCreate" method="post">
                        <div class="modal-body m-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Institute</label>
                                        <select class="form-select" name="department_id" id="" required>
                                            <option value="">Select Institute</option>
                                            <?php foreach ($departments as $department): ?>
                                                <option value="<?= $department['department_id'] ?>"><?= $department['department_title'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Program Acronym</label>
                                        <input type="text" class="form-control" name="program_acronym" id="" placeholder="Program Acronym" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Program Name</label>
                                <input type="text" class="form-control" name="program_title" id="" placeholder="Program Name" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Cancel</span>
                            </button>
                            <button type="submit" class="btn btn-primary ms-1">
                                <span class="px-3">Submit</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="update_program_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2>Update Program</h2>
                            <small class="text-muted mb-0">Make sure to click "Save Changes" to ensure your updates are applied.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="/AdminController/ProgramUpdate" method="post">
                        <div class="modal-body m-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Department</label>
                                        <select class="form-select" name="department_id" id="" required>
                                            <option value="">Select Department</option>
                                            <?php foreach ($departments as $department): ?>
                                                <option value="<?= $department['department_id'] ?>"><?= $department['department_title'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Program Acronym</label>
                                        <input type="text" class="form-control" name="program_acronym" id="modal-program-acronym" placeholder="Program Acronym" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Program Name</label>
                                <input type="text" class="form-control" name="program_title" id="modal-program-name" placeholder="Program Name" required>
                            </div>
                        </div>

                        <input type="hidden" name="program_id" id="modal-program-id" value="">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Cancel</span>
                            </button>
                            <button type="submit" class="btn btn-primary ms-1">
                                <span class="px-3">Save Changes</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var updateModal = document.getElementById('update_program_modal');
        updateModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var programId = button.getAttribute('data-program-id');
            var programCode = button.getAttribute('data-program-code');
            var programName = button.getAttribute('data-program-name');

            var modalProgramId = updateModal.querySelector('#modal-program-id');
            var modalProgramCode = updateModal.querySelector('#modal-program-acronym');
            var modalProgramName = updateModal.querySelector('#modal-program-name');

            modalProgramId.value = programId;
            modalProgramCode.value = programCode;
            modalProgramName.value = programName;
        });
    });
</script>


<?= $this->endSection(); ?>
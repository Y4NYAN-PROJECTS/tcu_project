<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mb-3">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Admin Accounts</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Accounts</li>
                            <li class="breadcrumb-item active">Admin</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header mb-0 pb-0 text-center">
                <h5>Admin Account List</h5>
            </div>

            <hr class="mt-1">

            <div class="card-body">
                <?php if (empty($admin_list)): ?>
                    <div class="text-center">
                        <h2 class="fst-italic mb-0">No Admin Accounts Found!</h2>
                        <small>No records available.</small>
                    </div>
                <?php else: ?>
                    <div class="table-responsive table-hover table-bordered ">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email Adrress</th>
                                    <th>Username</th>
                                    <th>Department</th>
                                    <th>Program</th>
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($admin_list as $user): ?>
                                    <tr>
                                        <td><?= $user['full_name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['username'] ?></td>
                                        <td>
                                            <?php
                                            foreach ($departments as $department):
                                                if ($user['department_id'] == $department['department_id']) {
                                                    echo $department['department_acronym'];
                                                }
                                            endforeach;
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            foreach ($programs as $program):
                                                if ($user['program_id'] == $program['program_id']) {
                                                    echo $program['program_acronym'];
                                                }
                                            endforeach;
                                            ?>
                                        </td>
                                        <td><?= $user['date_created'] ?></td>
                                        <td>
                                            <div class="">
                                                <button class="btn btn-primary btn-sm dropdown-toggle me-1" type="button"
                                                    id="dropdownMenuButtonIcon" data-bs-toggle="dropdown">
                                                    <i class="bi bi-error-circle"></i> Actions
                                                </button>
                                                <div class="dropdown-menu shadow-lg">
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#view_profile" data-image="<?= $user['profile_path'] ?>"
                                                        data-student-id="<?= $user['student_id'] ?>"
                                                        data-first-name="<?= $user['first_name'] ?>"
                                                        data-middle-name="<?= $user['middle_name'] ?>"
                                                        data-last-name="<?= $user['last_name'] ?>" data-department="<?php
                                                          foreach ($departments as $department) {
                                                              if ($user['department_id'] == $department['department_id']) {
                                                                  echo $department['department_acronym'];
                                                                  break;
                                                              }
                                                          }
                                                          ?>" data-program=" <?php
                                                          foreach ($programs as $program) {
                                                              if ($user['program_id'] == $program['program_id']) {
                                                                  echo $program['program_acronym'];
                                                                  break;
                                                              }
                                                          }
                                                          ?>"><i class="bi bi-box-arrow-in-up-right me-3"></i> View
                                                        Profile</a>
                                                    <a class="dropdown-item text-danger"
                                                        href="/AdminController/DeleteAccountAdmin/<?= $user['user_id'] ?>"><i
                                                            class="bi bi-x me-3"></i> Remove</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="view_profile" tabindex="-1" data-bs-toggle="modal"
    data-bs-target="#view_details_equipment_modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="mx-3 mt-3">
                    <h3 class="ms-2">Profile View</h3>
                </div>


                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body m-3">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <img src="" id="modal-profile-image" class="rounded-circle mx-auto mb-3"
                            style="width: 100%; max-width: 100%; max-height: 270px; object-fit: contain;" srcset="">
                        <h4 class="text-center"></h4>
                    </div>

                    <div class="col-sm-12 col-md-6 ">
                        <div class="ms-3">
                            <small>First Name: <h5 id="modal-first-name"></h5></small>
                            <small>Middle Name: <h5 id="modal-middle-name"></h5></small>
                            <small>Last Name: <h5 id="modal-last-name"></h5></small>
                            <small>Department: <h5 id="modal-department"></h5></small>
                            <small>Program: <h5 id="modal-program"></h5></small>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewProfileLinks = document.querySelectorAll('.dropdown-item[data-bs-target="#view_profile"]');

        viewProfileLinks.forEach(link => {
            link.addEventListener('click', function () {
                const image = link.getAttribute('data-image');
                const firstName = link.getAttribute('data-first-name');
                const middleName = link.getAttribute('data-middle-name');
                const lastName = link.getAttribute('data-last-name');
                const department = link.getAttribute('data-department');
                const program = link.getAttribute('data-program');

                document.getElementById('modal-profile-image').src = image;
                document.getElementById('modal-first-name').textContent = firstName;
                document.getElementById('modal-middle-name').textContent = middleName;
                document.getElementById('modal-last-name').textContent = lastName;
                document.getElementById('modal-department').textContent = department;
                document.getElementById('modal-program').textContent = program;
            });
        });
    });
</script>

<?= $this->endSection(); ?>
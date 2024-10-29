<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mt-5">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Pending Accounts</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-last">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item">Accounts</li>
                            <li class="breadcrumb-item active">Pending</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h5 class="mb-0">Pending Accounts List</h5>
                <small>Waiting for approval.</small>
            </div>

            <hr class="mt-0">

            <div class="card-body">
                <?php if (empty($pendings)): ?>
                    <div class="text-center my-5">
                        <h2 class="fst-italic mb-0">No Pending Accounts Found!</h2>
                        <small>No records available.</small>
                    </div>
                <?php else: ?>
                    <div class="table-responsive table-hover table-bordered ">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>User Type</th>
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
                                <?php foreach ($pendings as $user): ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($user['user_type'] == 2) {
                                                echo 'Student';
                                            } elseif ($user['user_type'] == 1) {
                                                echo 'Admin';
                                            }
                                            ?>
                                        </td>
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
                                                <button class="btn btn-primary btn-sm dropdown-toggle me-1" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown">
                                                    <i class="bi bi-error-circle"></i> Actions
                                                </button>
                                                <div class="dropdown-menu shadow-lg">
                                                    <a class="dropdown-item" href="/AdminController/AccountView/<?= $user['user_id'] ?>"><i class="bi bi-box-arrow-in-up-right me-3"></i> View Profile</a>
                                                    <a class="dropdown-item text-danger" href="/AdminController/AccountDecline/<?= $user['user_id'] ?>"><i class="bi bi-x me-3"></i> Decline</a>
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

<?= $this->endSection(); ?>
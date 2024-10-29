<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mt-5">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Administrator Accounts</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-last">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item">Accounts</li>
                            <li class="breadcrumb-item active">Administrator</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h5 class="mb-0 mt-2">Administrator Accounts List</h5>
                <small>List of all administrators.</small>
            </div>
            <hr class="mt-0">
            <div class="card-body">
                <?php if (empty($admin_list)): ?>
                    <div class="text-center my-5">
                        <h2 class="fst-italic mb-0">No Admin Accounts Found!</h2>
                        <small>No records available.</small>
                    </div>
                <?php else: ?>
                    <div class="table-responsive table-hover table-bordered ">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th class="col-3">Full Name</th>
                                    <th class="col-4">Email Adrress</th>
                                    <th class="col-2">Username</th>
                                    <th class="col-2">Date Created</th>
                                    <th class="col-1">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($admin_list as $user): ?>
                                    <tr>
                                        <td><?= $user['full_name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['username'] ?></td>
                                        <td><?= $user['date_created'] ?></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-danger px-3">Remove</a>
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

<div class="modal fade" id="view_profile" tabindex="-1" data-bs-toggle="modal" data-bs-target="#view_details_equipment_modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
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
                        <img src="" id="modal-profile-image" class="rounded-circle mx-auto mb-3" style="width: 100%; max-width: 100%; max-height: 270px; object-fit: contain;" srcset="">
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
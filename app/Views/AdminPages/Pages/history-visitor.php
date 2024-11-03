<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="vh-100">
        <div class="page-heading mt-5">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-first">
                        <h3>History</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-last">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item">History</li>
                                <li class="breadcrumb-item active">Visitor</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card shadow-sm">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                            <h4 class="mb-0">History Log List</h4>
                            <small>Below are your list of log history.</small>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3 text-sm-end">
                            <a href="/AdminController/VisitorLogsGeneratePDF" class="btn btn-primary px-5" target="_blank"><i class="bi bi-printer me-2"></i> Print</a>
                        </div>
                    </div>
                </div>

                <hr class="mt-1">

                <div class="card-body">
                    <?php if (empty($visitor_logs)): ?>
                        <div class="text-center my-5">
                            <h2 class="fst-italic mb-0">No History Found!</h2>
                            <small>No data found. Have a nice day.</small>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive table-hover table-bordered">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th class="col-2">Name</th>
                                        <th class="col-7">Equipments</th>
                                        <th class="col-2">Terms and Condition</th>
                                        <th class="col-1">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($visitor_logs as $log): ?>
                                        <tr>
                                            <td><?= $log['full_name']; ?></td>
                                            <td>
                                                <?php
                                                $equipments = explode('./', $log['visitor_equipments']);

                                                foreach ($equipments as $equipment_code) {
                                                    foreach ($visitor_equipments as $equipment) {
                                                        if ($equipment_code === $equipment['visitor_equipment_code']) {
                                                            echo '<a 
                                                            href="#" 
                                                            class="equipment-link" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#view_details_equipment_modal"
                                                            data-modal-name="' . $equipment['equipment_name'] . '"
                                                            data-modal-model="' . $equipment['model'] . '"
                                                            data-modal-color="' . $equipment['color'] . '"
                                                            data-modal-description="' . $equipment['description'] . '"
                                                            data-modal-imagepath="' . $equipment['image_path'] . '"
                                                            data-modal-datecreated="' . $equipment['date_created'] . '"
                                                            >';
                                                            echo " [" . $equipment['equipment_name'] . " " . $equipment['model'] . "]";
                                                            echo '</a>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>Agree</td>
                                            <td><?= $equipment['date_created'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <div class="modal fade" id="view_details_equipment_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2 class="mb-0">Equipment Details</h2>
                            <small>Below are more details about the equipment.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-5 text-center">
                                <img id="modal-imagepath" alt="Image" class="mb-3 bg-white" style="width: 100%; max-width: 100%; max-height: 140px; object-fit: contain;">
                                <small id="modal-datecreated"></small>
                            </div>

                            <div class="col-sm-12 col-md-7">
                                <div class="row">
                                    <div class="col-6 col-sm-6 col-md-6">
                                        <small>Name: <h5 id="modal-name"></h5></small>
                                    </div>

                                    <div class="col-6 col-sm-6 col-md-6">
                                        <small>Color: <h5 id="modal-color"></h5></small>
                                    </div>

                                    <div class="col-6 col-sm-12 col-md-12">
                                        <small>Model: <h5 id="modal-model"></h5></small>
                                    </div>

                                    <div class="col-6 col-sm-12 col-md-12">
                                        <small>Description: <h5 id="modal-description"></h5></small>
                                    </div>
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
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('view_details_equipment_modal');
        modal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;

            var name = button.getAttribute('data-modal-name');
            var model = button.getAttribute('data-modal-model');
            var color = button.getAttribute('data-modal-color');
            var description = button.getAttribute('data-modal-description');
            var imagepath = button.getAttribute('data-modal-imagepath');
            var datecreated = button.getAttribute('data-modal-datecreated');

            var modalName = modal.querySelector('#modal-name');
            var modalModel = modal.querySelector('#modal-model');
            var modalColor = modal.querySelector('#modal-color');
            var modalDescription = modal.querySelector('#modal-description');
            var modalImagepath = modal.querySelector('#modal-imagepath');
            var modalDatecreated = modal.querySelector('#modal-datecreated');

            modalName.textContent = name;
            modalModel.textContent = model;
            modalColor.textContent = color;
            modalDescription.textContent = description;
            modalImagepath.src = imagepath;
            modalDatecreated.textContent = datecreated;
        });
    });
</script>

<?= $this->endSection(); ?>
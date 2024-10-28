<?= $this->extend('/StudentPages/Components/main-layout'); ?>
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
                                <li class="breadcrumb-item active">History</li>
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
                            <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#new_equipment_modal"><i class="bi bi-printer me-2"></i> Print</button>
                        </div>
                    </div>
                </div>

                <hr class="mt-1">

                <div class="card-body">
                    <?php if (!empty($logs)): ?>
                        <div class="text-center">
                            <h2 class="fst-italic mb-0">No History Found!</h2>
                            <small>No data found. Have a nice day.</small>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive table-hover table-bordered">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>July 24, 2024</td>
                                        <td>10:46 AM</td>
                                        <td>04:21 PM</td>
                                    </tr>
                                    <tr>
                                        <td>July 25, 2024</td>
                                        <td>09:32 AM</td>
                                        <td>05:01 PM</td>
                                    </tr>
                                    <tr>
                                        <td>July 26, 2024</td>
                                        <td>06:52 AM</td>
                                        <td>08:21 PM</td>
                                    </tr>
                                    <tr>
                                        <td>August 2, 2024</td>
                                        <td>05:16 PM</td>
                                        <td>07:51 PM</td>
                                    </tr>
                                    <tr>
                                        <td>September 13, 2024</td>
                                        <td>06:36 AM</td>
                                        <td>05:21 PM</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
</div>

<?= $this->endSection(); ?>
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
                            <a href="/AdminController/LogsGeneratePDF" class="btn btn-primary px-5" target="_blank"><i class="bi bi-printer me-2"></i> Print</a>
                        </div>
                    </div>
                </div>

                <hr class="mt-1">

                <div class="card-body">
                    <?php if (empty($logs)): ?>
                        <div class="text-center my-5">
                            <h2 class="fst-italic mb-0">No History Found!</h2>
                            <small>No data found. Have a nice day.</small>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive table-hover table-bordered">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($logs as $log): ?>
                                        <tr>
                                            <td><?= (new DateTime($log['date_created']))->format('F j, Y') ?></td>
                                            <td><?= $log['full_name']; ?></td>
                                            <td><?= (new DateTime($log['time_in']))->format('g:i A') ?></td>
                                            <td><?= (new DateTime($log['time_out']))->format('g:i A') ?></td>
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
</div>

<?= $this->endSection(); ?>
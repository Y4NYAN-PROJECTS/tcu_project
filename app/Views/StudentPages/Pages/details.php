<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="vh-100">
        <div class="page-heading my-5">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>History</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
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
                <div class="card-header mb-0 pb-0 text-center">
                    <h1>History Lists</h1>
                </div>

                <hr class="mt-1">

                <div class="card-body">
                    <label class="text-dark"><b>User Code:</b> <?= $equimentDetails['user_code'] ?> </label><br>
                    <label class="text-dark"><b>Name:</b> <?= $equimentDetails['full_name'] ?> </label><br>
                    <label class="text-dark"><b>Equipment Code:</b> <?= $equimentDetails['equipment_code'] ?> </label><br>
                    <label class="text-dark"><b>Equipment Name:</b> <?= $equimentDetails['equipment_name'] ?> </label><br>
                    <label class="text-dark"><b>Equipment Model:</b> <?= $equimentDetails['model'] ?> </label><br>
                    <label class="text-dark"><b>Equipment Color:</b> <?= $equimentDetails['color'] ?> </label><br>
                    <label class="text-dark"><b>Equipment Description:</b> <?= $equimentDetails['description'] ?> </label><br>

                    <img alt="Image" src="<?= $equimentDetails['image_path'] ?>">

  </div>
            </div>
        </section>
    </div>
</div>

<?= $this->endSection(); ?>
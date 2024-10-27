<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mt-5">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Dashboard</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-last">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-header mb-0 pb-0 text-center">
                        <h1>Dashboard Page</h1>
                    </div>
                    <hr class="mt-1">
                    <div class="card-body text-center">
                        <p>Welcome back to Digital Equipment and Appliances Logging System! Your journey continues here. <span>&#128640;</span></p>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<?= $this->endSection(); ?>
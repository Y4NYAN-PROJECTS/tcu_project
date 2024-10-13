<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Dashboard</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
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
            <div class="col-lg-7">
                <div class="card shadow-sm">
                    <div class="card-header mb-0 pb-0 text-center">
                        <h1>Dashboard Page</h1>
                    </div>
                    <hr class="mt-1">
                    <div class="card-body text-center">
                        <p>Welcome back to Repository System! Your journey continues here. <span>&#128640;</span></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm">
                    <div class="card-body py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xl mx-5">
                                <img src="<?= session()->get('logged_profile')?>" alt="Profile Picture" style="width: 115px; height: auto;"/>
                            </div>

                            <div class="ms-3 name">
                                <h5 class="font-bold">Name: <?= session()->get('logged_fullname')?></h5>
                                <h6 class="text-muted mb-1">Email: <?= session()->get('logged_email')?></h6>
                                <h6 class="text-muted mb-1">Department: <?= session()->get('logged_department')?></h6>
                                <h6 class="text-muted mb-1">Program: <?= session()->get('logged_program')?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
</div>

<?= $this->endSection(); ?>
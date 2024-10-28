<?= $this->extend('/UserTypePage/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div class="vh-100 d-flex flex-column justify-content-center align-items-center">
    <div class="page-heading">
        <div class="text-center">
            <img src="/assets/tcu/logo-square.png" style="max-height: 100px; width: auto;" alt="TCU Logo">

            <h1 class="mb-0 mt-2">Digital Equipment and Appliances Logging System</h1>
            <p>Taguig City University</p>
        </div>
    </div>

    <div class="page-content">
        <div class="row ">
            <div class="col-md-4 col-sm-12 mb-3">
                <a href="/LoginController/LoginPage/2" class="type-select">
                    <div id="user-type" class="card border-0 rounded h-100">
                        <div class="card-body pb-0 px-5 d-flex flex-column align-items-center">
                            <img src="/assets/tcu/student.jpg" class="img-fluid" style="height: 100px;" alt="Student">
                            <h4 class="mt-4 font-weight-bold">Student</h4>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-sm-12 mb-3">
                <a href="/LoginController/LoginPage/1" class="type-select">
                    <div id="user-type" class="card border-0 rounded h-100">
                        <div class="card-body pb-0 px-5 d-flex flex-column align-items-center">
                            <img src="/assets/tcu/admin.jpg" class="img-fluid" style="height: 100px;" alt="Administrator">
                            <h4 class="mt-4 font-weight-bold">Administrator</h4>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 col-sm-12 mb-3">
                <a href="/VisitorController/EquipmentForm" class="type-select">
                    <div id="user-type" class="card border-0 rounded h-100">
                        <div class="card-body pb-0 px-5 d-flex flex-column align-items-center">
                            <img src="/assets/tcu/visitor.jpg" class="img-fluid" style="height: 100px;" alt="Visitor">
                            <h4 class="mt-4 font-weight-bold">Visitor</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .type-select {
        text-decoration: none;
    }

    .type-select #user-type {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .type-select:hover #user-type {
        transform: scale(1.05);
        box-shadow: 3px 3px 12px rgba(0, 0, 0, 0.2);
    }
</style>

<?= $this->endSection(); ?>
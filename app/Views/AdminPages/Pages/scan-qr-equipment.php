<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mt-5">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>School Equipment Scan</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-last">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item">Equipment</li>
                            <li class="breadcrumb-item active">Scan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h4 class="mb-0">School Equipments Scan</h4>
                <small>Scan equipment qr to see more details.</small>
            </div>

            <hr class="mt-0">

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="text-center">
                            <h3 class="mb-0 mt-3">QR Code Scanning</h3>
                            <small>Ready for Scanning...</small>
                            <span class="d-none" id="scanned-qr-code-value-display"></span>
                            <div class="d-flex justify-content-center my-2" id="camera-scanner">
                                <div id="reader" style="width: 100%; max-width: 400px; height: auto;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 d-flex justify-content-center align-items-center" id="equipmentTableContainer">
                        <?php if ($scanned == 0): ?>
                            <div class="text-center">
                                <h2 class="fst-italic mb-0">No Equipments Found!</h2>
                                <small>No data found.</small>
                            </div>
                        <?php else: ?>
                            <form action="" id="school-equipment">
                                <?php $found = false; ?>
                                <?php foreach ($equipments as $equipment): ?>
                                    <?php if ($equipment['school_equipment_code'] == $scanned): ?>
                                        <?php $found = true; ?>
                                        <div class="">
                                            <h4 class="mt-3">Equipments Details:</h4>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                                    <div class="form-group mb-3">
                                                        <label for="school_equipment_serial_number">Serial Number</label>
                                                        <input type="text" class="form-control mt-1" value="<?= $equipment['serial_number']; ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                                    <div class="form-group mb-3">
                                                        <label for="">Building</label>
                                                        <input type="text" class="form-control mt-1" value="<?= $equipment['building']; ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                                    <div class="form-group mb-3">
                                                        <label for="">Room Number</label>
                                                        <input type="text" class="form-control mt-1" value="<?= $equipment['room_number']; ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                                    <div class="form-group mb-3">
                                                        <label for="">Equipment</label>
                                                        <input type="text" class="form-control mt-1" value="<?= $equipment['equipment_name']; ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                                    <div class="form-group mb-3">
                                                        <label for="">Brand and Model</label>
                                                        <input type="text" class="form-control mt-1" value="<?= $equipment['brand_model']; ?>" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="">Color</label>
                                                        <input type="text" class="form-control mt-1" value="<?= $equipment['color']; ?>" id="color" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="">Status</label>
                                                        <input type="text" class="form-control mt-1" value="<?= $equipment['status']; ?>" id="status" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-6" id="description-container">
                                                    <div class="form-group mb-3">
                                                        <label for="">More Description</label>
                                                        <input type="text" class="form-control mt-1" value="<?= $equipment['description']; ?>" id="description" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if (!$found): ?>
                                    <div class="text-center">
                                        <h2 class="fst-italic mb-0">No Match Found!</h2>
                                        <small>The equipment is not registered.</small>
                                    </div>
                                <?php endif; ?>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    const qrCodeSuccessCallback = (decodedText) => {
        // Create a new form element
        const form = document.createElement("form");
        form.action = `/AdminController/ScanQREquipment/${decodedText}`;
        form.method = "post";

        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "scanned_qr_code_value";
        input.value = decodedText;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    };

    const qrCodeErrorCallback = (errorMessage) => {
        console.log("Error: ", errorMessage);
    };

    const html5QrCode = new Html5Qrcode("reader");

    html5QrCode.start({
            facingMode: "environment"
        }, {
            fps: 30,
        },
        qrCodeSuccessCallback,
        qrCodeErrorCallback
    ).catch(err => {
        console.error("Error starting QR Code scan: ", err);
    });
</script>


<?= $this->endSection(); ?>
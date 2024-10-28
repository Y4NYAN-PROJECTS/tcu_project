<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="vh-100">
        <div class="page-heading mt-5">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-first">
                        <h3>Scan Now</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-last">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Scan Now</li>
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
                            <h4 class="mb-0">Entrance Scanning</h4>
                            <small>Scan QR Code to log equipments.</small>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3 text-sm-end">
                            <button type="button" class="btn btn-primary px-5">History</button>
                        </div>
                    </div>
                </div>

                <hr class="mt-1">

                <div class="card-body text-center">
                    <h3 class="mb-0">QR Code Scanning</h3>
                    <small>Value: <small id="scanned-qr-code-value">Scanning QR</small></small>
                    <div class="d-flex justify-content-center my-2" id="camera-scanner">
                        <div id="reader" style="width: 100%; max-width: 600px; height: auto;"></div>
                    </div>

                    <div class="d-flex justify-content-center my-5 d-none" id="barcode-scanner">
                        <input type="text" class="form-control form-control-xl text-center" name="barcode_input"
                            id="barcode-input" placeholder="Scanning..." oninput="validateNumber(this)" autofocus>
                    </div>

                    <form id="qrForm" action="/AdminController/scannedQRCode" method="POST">
                        <input type="hidden" name="scanned-qr-code-value" id="scanned-qr-code-value">
                    </form>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-6">
                    <button type="button" class="btn btn-primary w-100" id="camera-button">
                        <i class="bi bi-camera2 fs-2"></i><br>
                        <small>Camera Scanner</small>
                    </button>
                </div>

                <div class="col-6">
                    <button type="button" class="btn btn-primary w-100" id="barcode-button">
                        <i class="bi bi-upc-scan fs-2"></i><br>
                        <small>Barcode Scanner</small>
                    </button>
                </div>
            </div>

        </section>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    var barcodeScanner = document.getElementById('barcode-scanner');
    var cameraScanner = document.getElementById('camera-scanner');
    var cameraButton = document.getElementById('camera-button');
    var barcodeButton = document.getElementById('barcode-button');
    var barcodeInput = document.getElementById('barcode-input');

    function toggleScanners(isCameraScanner) {
        if (isCameraScanner) {
            cameraScanner.classList.remove('d-none');
            barcodeScanner.classList.add('d-none');
        } else {
            cameraScanner.classList.add('d-none');
            barcodeScanner.classList.remove('d-none');
            setTimeout(() => barcodeInput.focus(), 0);
        }
    }

    cameraButton.addEventListener('click', function () {
        toggleScanners(true);
    });

    barcodeButton.addEventListener('click', function () {
        toggleScanners(false);
    });

    toggleScanners(true);

    // Barcode Scanner
    function validateNumber(input) {
        input.value = input.value.replace(/[^0-9]/g, '').slice(0, 12);
    }

    function setFocusOnBarcodeInput() {
        barcodeInput.focus();
    }

    barcodeInput.addEventListener('blur', setFocusOnBarcodeInput);
    barcodeInput.addEventListener('input', function () {
        if (barcodeInput.value.length >= 6) {
            document.getElementById("qrForm").submit();
        }
    });

    // Camera Scanner
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        document.getElementById('scanned-qr-code-value').textContent = decodedText;
        document.getElementById('qrForm').submit();
    };

    const qrCodeErrorCallback = (errorMessage) => {
        console.log("Error: ", errorMessage);
    };

    const html5QrCode = new Html5Qrcode("reader");

    html5QrCode.start(
        { facingMode: "environment" },
        {
            fps: 60,
            qrbox: 250
        },
        qrCodeSuccessCallback,
        qrCodeErrorCallback
    ).catch(err => {
        console.error("Error starting QR Code scan: ", err);
    });
</script>
<?= $this->endSection(); ?>
<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="vh-100">
        <div class="page-heading mt-5">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-first">
                        <h3>Camera QR Code Scanner</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-last">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item">Scan Now!</li>
                                <li class="breadcrumb-item active">Camera</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">QR Code Scanning</h4>
                    <small>Use the camera to scan QR codes.</small>
                </div>

                <hr class="mt-1">

                <div class="card-body text-center">
                    <h3 class="mb-0 mt-3">QR Code Scanning</h3>
                    <small>Ready for Scanning...</small>
                    <div class="d-flex justify-content-center my-2" id="camera-scanner">
                        <div id="reader" style="width: 100%; max-width: 600px; height: auto;"></div>
                    </div>

                    <form id="qrFormScan" action="/AdminController/scannedQRCode" method="post">
                        <input type="hidden" name="scanned_qr_code_value" id="scanned-qr-code-value">
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        document.getElementById('scanned-qr-code-value').value = decodedText; // set hidden input value
        document.getElementById('scanned-qr-code-value-display').textContent = decodedText; // display scanned value
        document.getElementById('qrFormScan').submit(); // submit form
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
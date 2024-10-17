<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<style>
    #my-qr-reader {
        padding: 20px !important;
        border: 1.5px solid #b2b2b2 !important;
        border-radius: 8px;
    }

    #my-qr-reader img[alt="Info icon"] {
        display: none;
    }

    #my-qr-reader img[alt="Camera based scan"] {
        width: 100px !important;
        height: 100px !important;
    }

    #html5-qrcode-anchor-scan-type-change {
        text-decoration: none !important;
        color: #1d9bf0;
    }

    video {
        width: 100% !important;
        border: 1px solid #b2b2b2 !important;
        border-radius: 0.25em;
    }
</style>

<div id="main-content">
    <div class="vh-100">
        <div class="page-heading mt-5">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Scan Now</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="">
                        <h4 class="mb-0">Entrance Scanning</h4>
                        <small>Scan QR Code to log equipments.</small>
                    </div>
                    <button type="button" class="btn btn-primary px-5">History</button>
                </div>
                <hr class="mt-1">

                <div class="card-body text-center">
                    <h3 class="mb-0">QR Code Scanning</h3>
                    <small>Value: <small id="scanned-qr-code-value">Scanning QR</small></small>
                    <div class="d-flex justify-content-center mt-3">
                        <div id="reader" style="width: 600px;"></div>
                        <form id="qrForm" action="/studentcontroller/scannedQRCode" method="POST">
                            <input type="hidden" name="scanned-qr-code-value" id="scanned-qr-code-value">
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        document.getElementById('scanned-qr-code-value').textContent = decodedText;
        // document.getElementById('qrForm').submit();
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
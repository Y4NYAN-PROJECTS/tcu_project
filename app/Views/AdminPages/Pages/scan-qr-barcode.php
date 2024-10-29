<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="vh-100">
        <div class="page-heading mt-5">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-first">
                        <h3>Barcode Scanner</h3>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-last">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item">Scan Now!</li>
                                <li class="breadcrumb-item active">Barcode</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Barcode Scanning</h4>
                    <small>Enter or scan barcode to log equipment.</small>
                </div>

                <hr class="mt-1">

                <div class="card-body text-center">
                    <h3 class="mb-0 mt-3">Barcode Scanning</h3>
                    <small>Ready for Scanning...</small>
                    <div class=" my-5" id="barcode-scanner">
                        <form id="qrFormBarcode" action="/AdminController/scannedQRCode" method="post">
                            <input type="text" class="form-control form-control-xl text-center" name="scanned_qr_code_value" id="barcode-input" placeholder="Scanning..." autofocus>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>
    function validateNumber(input) {
        input.value = input.value.replace(/[^0-9]/g, '').slice(0, 12);
    }

    function setFocusOnBarcodeInput() {
        document.getElementById('barcode-input').focus();
    }

    const barcodeInput = document.getElementById('barcode-input');
    barcodeInput.addEventListener('blur', setFocusOnBarcodeInput);

    barcodeInput.addEventListener('input', function () {
        if (barcodeInput.value.length >= 6) {
            document.getElementById("qrFormBarcode").submit();
        }
    });
</script>
<?= $this->endSection(); ?>
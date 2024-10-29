<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mt-5">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Equipment Registration</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-last">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Equipment Registration</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header mb-0 pb-0 text-center">
                <h5>Register School Equipment</h5>
            </div>
            <hr class="mt-1">
            <div class="card-body mb-3">
                <form action="/AdminController/EquipmentRegister" id="school-equipment" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body m-3">
                        <div class="row">

                            <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                <div class="form-group mb-3">
                                    <label for="school_equipment_serial_number">Serial Number</label>
                                    <input type="text" class="form-control mt-1" name="serial_number"
                                        id="school_equipment_serial_number" placeholder="Ex. 123ABC" required>
                                    <div id="serialNumberFeedback" class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        Invalid Serial Number
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                <div class="form-group mb-3">
                                    <label for="">Building</label>
                                    <input type="text" class="form-control mt-1" name="building"
                                        placeholder="Ex. Main Building" required>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                <div class="form-group mb-3">
                                    <label for="">Room Number</label>
                                    <input type="text" class="form-control mt-1" name="room_number"
                                        placeholder="Ex. Room 001" required>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                <div class="form-group mb-3">
                                    <label for="">Equipment</label>
                                    <input type="text" class="form-control mt-1" name="equipment_type"
                                        placeholder="Ex. Electricfan" required>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                <div class="form-group mb-3">
                                    <label for="">Brand and Model</label>
                                    <input type="text" class="form-control mt-1" name="model"
                                        placeholder="Ex. Logitech 1520" required>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label for="">Color</label>
                                    <input type="text" class="form-control mt-1" name="color" id=""
                                        placeholder="Equipment Color" required>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                <div class="form-group mb-3">
                                    <label for="equipment_status">Equipment Status</label>
                                    <select class="form-select" name="status" id="equipment_status" required>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="Working">Working</option>
                                        <option value="Damaged">Damaged</option>
                                        <option value="Lost">Lost</option>
                                        <option value="Out of Service">Out of Service</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6" id="description-container">
                                <div class="form-group mb-3">
                                    <label for="">More Description</label>
                                    <small class="text-muted">(Input N/A if no futher description.)</small>
                                    <input type="text" class="form-control mt-1" name="description" id=""
                                        placeholder="Ex. RGB Lights" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label for="confirmEmail">Picture</label>
                                    <small class="text-muted">(Formats: JPG, PNG | Max size: 5MB)</small>
                                    <input type="file" class="image-crop-filepond" image-crop-aspect-ratio="1:1"
                                        data-max-file-size="5MB" data-max-files="1" name="equipment_image">
                                </div>
                            </div>

                            <!-- <input type="file" id="qr-file" name="qrcode_file" class="d-none">
                                <input type="hidden" id="qr-file-name" name="qrcode_file_name"> -->

                            <!-- <div class="col-md-12 d-none" id="school-equipment-qrcode">
                                    <div class="text-center">
                                        <div id="qrcode" class="mt-4 d-flex justify-content-center"></div>
                                    </div>
                                </div> -->
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1">
                            <span class="px-3">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script src="/assets/compiled/js/qrcode/config.js"></script>

<script>
    const nameInput = document.getElementById('new_full_name');
    nameInput.addEventListener('input', function () {
        const namePattern = /^[a-zA-Z\s]+$/;
        if (namePattern.test(nameInput.value)) {
            nameInput.classList.remove("is-invalid");
            submitButton.disabled = false;
        } else {
            nameInput.classList.add("is-invalid");
            submitButton.disabled = true;
        }
    });

    // S E R I A L  N U M B E R  V A L I D A T I O N
    document.getElementById('school_equipment_serial_number').addEventListener('input', function () {
        const serialNumberPattern = /^[^\s]+$/;;
        const serialNumberInput = this;
        const feedbackElement = document.getElementById('serialNumberFeedback');

        if (serialNumberPattern.test(serialNumberInput.value)) {
            feedbackElement.style.display = 'none';
            serialNumberInput.classList.remove('is-invalid');
            serialNumberInput.classList.add('is-valid');
        } else {
            feedbackElement.style.display = 'block';
            serialNumberInput.classList.remove('is-valid');
            serialNumberInput.classList.add('is-invalid');
        }
    });

    document.getElementById('equipment').addEventListener('submit', function (event) {
        let codeInput = document.querySelector('input[name="equipment_type_code"]');
        codeInput.value = generateCode();
        codeInput.disabled = false;
    });

    // E Q U I P M E N T  F O R M

    function showEquipmentDetails() {
        const equipmentSelect = document.getElementById('equipmentSelect');
        const selectedValue = equipmentSelect.value;
        const equipmentDetailsHeader = document.getElementById('equipmentDetailsHeader');
        const equipmentDetailsTitle = document.getElementById('equipmentDetailsTitle');
        const equipmentDetailsSection = document.querySelector('input[name="equipment_name"]');
        const equipmentDetailsRow = equipmentDetailsSection.closest('.row');

        if (selectedValue) {
            // Show all the equipment details fields when the "Add" button is clicked
            equipmentDetailsHeader.classList.remove('hidden');
            equipmentDetailsTitle.classList.remove('hidden');
            equipmentDetailsRow.classList.remove('hidden');

            // Split the selected value to extract the equipment ID and name
            const [equipmentId, equipmentName] = selectedValue.split(':');

            // Display the selected equipment name in the title
            equipmentDetailsTitle.innerText = equipmentName;
            equipmentDetailsSection.value = selectedValue;
        } else {
            equipmentDetailsHeader.classList.add('hidden');
            equipmentDetailsTitle.classList.add('hidden');
            equipmentDetailsSection.closest('.row').classList.add('hidden');
            equipmentDetailsSection.value = '';
        }
    }

    function previewImage(event) {
        const file = event.target.files[0]; // Get the selected file
        const preview = document.getElementById('imagePreview'); // Get the preview image element
        const link = document.getElementById('imagePreviewLink'); // Get the link element for the preview

        if (file) {
            const reader = new FileReader(); // Create a FileReader object
            reader.onload = function (e) {
                preview.src = e.target.result; // Set the preview image source to the file
                link.href = e.target.result; // Set the link href to the file for clicking
                preview.style.display = 'block'; // Show the image
                link.style.display = 'block'; // Show the link
            }
            reader.readAsDataURL(file); // Read the file as a data URL
        } else {
            preview.src = '#'; // Reset the image source
            link.href = '#'; // Reset the link href
            preview.style.display = 'none'; // Hide the image
            link.style.display = 'none'; // Hide the link
        }
    }
</script>

<?= $this->endSection(); ?>
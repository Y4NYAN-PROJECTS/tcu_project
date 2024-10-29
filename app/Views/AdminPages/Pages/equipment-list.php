<?= $this->extend('/AdminPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mt-5">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Equipments List</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Equipments</li>
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
                    <h4 class="mb-0">Equipments Table</h4>
                    <small>Below are the University's equipments.</small>
                </div>
                <div>
                    <a type="button" class="btn btn-primary px-5" href="/AdminController/GeneratePDF">
                        <i class="bi bi-printer me-2 mb-2"></i>
                        Print
                    </a>
                </div>
            </div>


            <hr class="mt-0">

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <?php if (empty($school_equipments)): ?>
                            <div class="text-center">
                                <h2 class="fst-italic mb-0">No Equipments Found!</h2>
                                <small>No data found. Kindly register equipments first.</small>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive table-hover table-bordered">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th class="col-2">Serial #</th>
                                            <th class="col-2">Building</th>
                                            <th class="col-2">Room #</th>
                                            <th class="col-3">Equipment</th>
                                            <th class="col-2">Status</th>
                                            <th class="col-1">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($school_equipments as $equipment): ?>
                                            <tr>
                                                <td><?= $equipment['serial_number'] ?></td>
                                                <td><?= $equipment['building'] ?></td>
                                                <td><?= $equipment['room_number'] ?></td>
                                                <td><?= $equipment['equipment_name'] ?></td>
                                                <td><?= $equipment['status'] ?></td>
                                                <td>
                                                    <div class="">
                                                        <button class="btn btn-primary btn-sm me-1" type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown">
                                                            <i class="bi bi-error-circle"></i> Actions
                                                        </button>
                                                        <div class="dropdown-menu shadow-lg">
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#update_equipment_modal" data-equipment-id="<?= $equipment['school_equipment_id'] ?>" data-serial-number="<?= $equipment['serial_number'] ?>" data-building="<?= $equipment['building'] ?>" data-room-number="<?= $equipment['room_number'] ?>" data-equipment-name="<?= $equipment['equipment_name'] ?>" data-brand-model="<?= $equipment['brand_model'] ?>" data-color="<?= $equipment['color'] ?>" data-description="<?= $equipment['description'] ?>" data-status="<?= $equipment['status'] ?>">
                                                                <i class="bi bi-pencil-square me-3"></i> Update Status</a>

                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#view_details_equipment_modal" data-view-image="<?= $equipment['image_path'] ?>" data-view-serial-number="<?= $equipment['serial_number'] ?>" data-view-building="<?= $equipment['building'] ?>" data-view-room-number="<?= $equipment['room_number'] ?>" data-view-equipment-name="<?= $equipment['equipment_name'] ?>" data-view-brand-model="<?= $equipment['brand_model'] ?>" data-view-color="<?= $equipment['color'] ?>" data-view-description="<?= $equipment['description'] ?>" data-view-status="<?= $equipment['status'] ?>">
                                                                <i class="bi bi-box-arrow-in-up-right me-3"></i> More
                                                                Details</a>

                                                            <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#show_qrcode" data-qrcode-serial-number="<?= $equipment['serial_number'] ?>" data-qrcode-equipment-name="<?= $equipment['equipment_name'] ?>" data-qrcode-equipment-code="<?= $equipment['school_equipment_code'] ?>"><i class="bi bi-qr-code-scan me-3"></i> Show QR Code</a>
                                                            <a class="dropdown-item text-danger" href="/AdminController/DeleteSchoolEquipment/<?= $equipment['school_equipment_id'] ?>"><i class="bi bi-trash me-3"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="update_equipment_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2>Update Equipment</h2>
                            <small class="text-muted mb-0">Please fill this form to update the equipment status.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>

                    </div>

                    <form action="/AdminController/UpdateSchoolEquipment" method="post">
                        <div class="modal-body m-3">
                            <div class="row">

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Serial Number</label>
                                        <input type="text" class="form-control mt-1" name="serial_number" id="modal-update-serial-number" placeholder="" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Building</label>
                                        <input type="text" class="form-control mt-1" name="building" id="modal-update-building" placeholder="" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Room Number</label>
                                        <input type="text" class="form-control mt-1" name="room_number" id="modal-update-room-number" placeholder="" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Equipment</label>
                                        <input type="text" class="form-control mt-1" name="equipment_type" id="modal-update-equipment-name" placeholder="" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Brand and Model</label>
                                        <input type="text" class="form-control mt-1" name="model" id="modal-update-model" placeholder="" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Color</label>
                                        <input type="text" class="form-control mt-1" name="color" id="modal-update-color" placeholder="" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                    <div class="form-group mb-3">
                                        <label for="equipment_status">Equipment Status</label>
                                        <select class="form-select" name="update_status" id="update_status" required>
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
                                        <input type="text" class="form-control mt-1" name="update_description" id="modal-update-description" placeholder="" required>
                                    </div>
                                </div>

                                <div class="col-md-12 d-none" id="school-equipment-qrcode">
                                    <div class="text-center">
                                        <div id="qrcode" class="mt-4 d-flex justify-content-center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="school_equipment_id" id="modal-update-school-equipment-id" value="">

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
        </div>

        <div class="modal fade" id="view_details_equipment_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2> Equipment Details</h2>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-5 mt-3">
                                <img src="" id="modal-view-image" alt="Logo" style="width: 100%; max-width: 100%; max-height: 270px; object-fit: contain;" srcset="">
                            </div>

                            <div class="col-sm-12 col-md-7">
                                <div class="row mt-3">
                                    <div class="col-sm-12 col-md-6">
                                        <small>Serial Number: <h5 id="modal-view-serial-number"></h5></small>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <small>Equipment: <h5 id="modal-view-equipment-name"></h5></small>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <small>Building: <h5 id="modal-view-building"></h5></small>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <small>Room Number: <h5 id="modal-view-room-number"></h5></small>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <small>Brand / Model: <h5 id="modal-view-model"></h5></small>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <small>Color: <h5 id="modal-view-color"></h5></small>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <small>Description: <h5 id="modal-view-description"></h5></small>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <small>Status: <h5 id="modal-view-status"></h5></small>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="school_equipment_id" id="modal-view-school-equipment-id" value="">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Cancel</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1">
                            <span class="px-3">Submit</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="show_qrcode" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2 id="modal-qrcode-equipment-name"></h2>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body mb-3">
                        <div class="col-sm-12 col-md-12">
                            <div class="text-center">
                                <div id="modal_qrcode_school_equipment" class="mt-4 d-flex justify-content-center">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>

                        <button type="submit" id="modal-qrcode-download" class="btn btn-success d-flex align-items-center" onclick="downloadQRCode()">
                            <i class="bi bi-download me-2 mb-2"></i>
                            <span>Download</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<script src="/assets/compiled/js/qrcode/config.js"></script>

<script>
    // U P D A T E   E Q U I P M E N T   S T A T U S
    document.addEventListener('DOMContentLoaded', function () {
        var updateModal = document.getElementById('update_equipment_modal');
        updateModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var schoolEquipmentId = button.getAttribute('data-equipment-id');
            var serialNumber = button.getAttribute('data-serial-number');
            var building = button.getAttribute('data-building');
            var roomNumber = button.getAttribute('data-room-number');
            var equipmentName = button.getAttribute('data-equipment-name');
            var model = button.getAttribute('data-brand-model');
            var color = button.getAttribute('data-color');
            var description = button.getAttribute('data-description');
            var status = button.getAttribute('data-status');

            var modalSchoolEquipmentId = updateModal.querySelector('#modal-update-school-equipment-id');
            var modalSerialNumber = updateModal.querySelector('#modal-update-serial-number');
            var modalBuilding = updateModal.querySelector('#modal-update-building');
            var modalRoomNumber = updateModal.querySelector('#modal-update-room-number');
            var modalEquipmentName = updateModal.querySelector('#modal-update-equipment-name');
            var modalModel = updateModal.querySelector('#modal-update-model');
            var modalColor = updateModal.querySelector('#modal-update-color');
            var modalDescription = updateModal.querySelector('#modal-update-description');
            var modalStatus = updateModal.querySelector('#modal-update-status');

            modalSchoolEquipmentId.value = schoolEquipmentId;
            modalSerialNumber.value = serialNumber;
            modalBuilding.value = building;
            modalRoomNumber.value = roomNumber;
            modalEquipmentName.value = equipmentName;
            modalModel.value = model;
            modalColor.value = color;
            modalDescription.value = description;
            modalStatus.value = status;
        });
    });


    // V I E  W  E Q U I P M E N T  D E T A I L S
    document.addEventListener('DOMContentLoaded', function () {
        var viewModal = document.getElementById('view_details_equipment_modal');
        viewModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var viewImage = button.getAttribute('data-view-image');
            var viewSerialNumber = button.getAttribute('data-view-serial-number');
            var viewBuilding = button.getAttribute('data-view-building');
            var viewRoomNumber = button.getAttribute('data-view-room-number');
            var viewEquipmentName = button.getAttribute('data-view-equipment-name');
            var viewModel = button.getAttribute('data-view-brand-model');
            var viewColor = button.getAttribute('data-view-color');
            var viewDescription = button.getAttribute('data-view-description');
            var viewStatus = button.getAttribute('data-view-status');

            var modalViewSerialNumber = viewModal.querySelector('#modal-view-serial-number');
            var modalBuilding = viewModal.querySelector('#modal-view-building');
            var modalRoomNumber = viewModal.querySelector('#modal-view-room-number');
            var modalEquipmentName = viewModal.querySelector('#modal-view-equipment-name');
            var modalModel = viewModal.querySelector('#modal-view-model');
            var modalColor = viewModal.querySelector('#modal-view-color');
            var modalDescription = viewModal.querySelector('#modal-view-description');
            var modalStatus = viewModal.querySelector('#modal-view-status');

            modalViewSerialNumber.textContent = viewSerialNumber;
            modalBuilding.textContent = viewBuilding;
            modalRoomNumber.textContent = viewRoomNumber;
            modalEquipmentName.textContent = viewEquipmentName;
            modalModel.textContent = viewModel;
            modalColor.textContent = viewColor;
            modalDescription.textContent = viewDescription;
            modalStatus.textContent = viewStatus;

            var modalImage = viewModal.querySelector('#modal-view-image');
            modalImage.src = viewImage;
            modalImage.alt = viewEquipmentName;
        });
    });


    // Q R  C O D E
    document.addEventListener('DOMContentLoaded', function () {
        var viewModal = document.getElementById('show_qrcode');

        viewModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var qrCodeValue = button.getAttribute('data-qrcode-serial-number');
            var qrCodeEquipmentName = button.getAttribute('data-qrcode-equipment-name');
            var schoolEquipmentCode = button.getAttribute('data-qrcode-equipment-code');

            var modalQRCodeEquipmentName = document.getElementById('modal-qrcode-equipment-name');
            modalQRCodeEquipmentName.textContent = qrCodeEquipmentName;

            viewModal.setAttribute('data-qrcode-equipment-code', schoolEquipmentCode);
            viewModal.setAttribute('data-qrcode-serial-number', qrCodeValue);

            var qrCodeContainer = document.getElementById('modal_qrcode_school_equipment');
            qrCodeContainer.innerHTML = '';

            var qrCodeSerialNumber = new QRCode(qrCodeContainer);
            qrCodeSerialNumber.makeCode(qrCodeValue);
        });
    });

    // D O W N L O A  D   Q R C O D E
    function downloadQRCode() {
        var canvas = document.querySelector('#modal_qrcode_school_equipment canvas');
        var viewModal = document.getElementById('show_qrcode');

        var schoolEquipmentCode = viewModal.getAttribute('data-qrcode-equipment-code');
        var schoolEquipmentSerialNumber = viewModal.getAttribute('data-qrcode-serial-number');

        var fileName = `${schoolEquipmentCode}_${schoolEquipmentSerialNumber}.png`;

        if (canvas) {
            var image = canvas.toDataURL("image/png");
            var link = document.createElement('a');
            link.href = image;
            link.download = fileName;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } else {
            console.error("QR Code canvas not found.");
        }
    }


    // var qrcode = new QRCode('qrcode');

    // function generateQRCode() {
    //     var qrcodeValue = document.getElementById('school_equipment_serial_number').value;
    //     qrcode.makeCode(qrcodeValue);
    // }

    // var qrcodeInput = document.getElementById('school_equipment_serial_number');
    // qrcodeInput.addEventListener('input', generateQRCode);

    // var form = document.getElementById('school-equipment');
    // form.addEventListener('submit', function (event) {
    //     event.preventDefault();

    //     generateQRCode();

    //     var qrcodeDisplay = document.getElementById("qrcode").getElementsByTagName("canvas")[0];
    //     var qrcodeValue = document.getElementById("school_equipment_serial_number").value;
    //     var qrcodeFile = document.getElementById("qr-file");
    //     var qrcodeFileName = document.getElementById("qr-file-name");

    //     if (qrcodeDisplay) {
    //         qrcodeDisplay.toBlob(function (blob) {
    //             var fileName = `${ qrcodeValue }.png`;
    //             var file = new File([blob], fileName, { type: "image/png" });

    //             var dataTransfer = new DataTransfer();
    //             dataTransfer.items.add(file);
    //             qrcodeFile.files = dataTransfer.files;

    //             qrcodeFileName.value = fileName;
    //             form.submit();
    //         });
    //     } else {
    //         alert("QR code image is not available.");
    //     }
    // });

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
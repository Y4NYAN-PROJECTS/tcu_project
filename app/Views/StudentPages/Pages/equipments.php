<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading mt-5">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-first">
                    <h3>Equipments</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-last">
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
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3">
                        <h4 class="mb-0">Equipments List</h4>
                        <small>Below are your list of equipments.</small>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 mt-3 text-sm-end">
                        <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal"
                            data-bs-target="#new_equipment_modal">New Equipment</button>
                    </div>
                </div>
            </div>

            <hr class="mt-0">

            <div class="card-body">
                <div class="row">
                    <?php if (empty($student_equipments)): ?>
                        <div class="text-center">
                            <h2 class="fst-italic mb-0">No Equipments Found!</h2>
                            <small>No data found. Kindly add equipments first.</small>
                        </div>
                    <?php else: ?>
                        <div class="col-sm-12 col-md-4 d-none">
                            <div class="text-center">
                                <div id="qrcode" class="d-flex justify-content-center p-3 bg-white"></div>
                                <button type="button" class="btn btn-sm btn-primary px-5" data-bs-toggle="modal"
                                    data-bs-target="#show_qrcode">Show QR Code</button>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8" id="equipmentTableContainer">
                            <div class="table-responsive table-hover table-bordered">
                                <table class="table" id="table1" <?= !empty($student_equipments) ? 'data-has-data="true"' : '' ?>>
                                    <thead>
                                        <tr>
                                            <th>Equipment Code</th>
                                            <th>Type</th>
                                            <th>Model</th>
                                            <th>Color</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($student_equipments as $equipment): ?>
                                            <tr>
                                                <td><?= $equipment['student_equipment_code'] ?></td>
                                                <td><?= $equipment['equipment_name'] ?></td>
                                                <td><?= $equipment['model'] ?></td>
                                                <td><?= $equipment['color'] ?></td>
                                                <td><?= $equipment['description'] ?></td>
                                                <td>
                                                    <div class="">
                                                        <button class="btn btn-primary btn-sm dropdown-toggle me-1"
                                                            type="button" id="dropdownMenuButtonIcon" data-bs-toggle="dropdown">
                                                            <i class="bi bi-error-circle"></i> Actions
                                                        </button>
                                                        <div class="dropdown-menu shadow-lg">
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#view_details_equipment_modal"
                                                                data-view-equipment-name="<?= $equipment['equipment_name'] ?>"
                                                                data-view-brand-model="<?= $equipment['model'] ?>"
                                                                data-view-color="<?= $equipment['color'] ?>"
                                                                data-view-description="<?= $equipment['description'] ?>"
                                                                data-view-image="<?= $equipment['image_path'] ?>"><i
                                                                    class="bi bi-box-arrow-in-up-right me-3"></i> More
                                                                Details</a>
                                                            <a class="dropdown-item text-danger"
                                                                href="/StudentController/DeleteEquipment/<?= $equipment['student_equipment_id'] ?>"><i
                                                                    class="bi bi-trash me-3"></i> Delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="new_equipment_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3 mt-3">
                            <h2>Add Equipment</h2>
                            <small class="text-muted mb-0">Please fill this form to add a new equipment.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="/StudentController/StudentEquipmentCreate" method="post"
                        enctype="multipart/form-data">
                        <div class="modal-body m-3" style="max-height: 60vh; overflow-y: auto;">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="">Equipment Type</label>
                                        <select class="form-select mt-1" name="equipment_name" id="equipmentSelect"
                                            required>
                                            <option value="">Select Equipment</option>
                                            <?php foreach ($equipments as $equips): ?>
                                                <option
                                                    value="<?= $equips['equipment_id'] ?>:<?= $equips['equipment_name'] ?>:<?= $equips['equipment_code'] ?>">
                                                    <?= $equips['equipment_name'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                            <option value="other">Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6 d-none" id="other_equipment">
                                    <div class="form-group mb-3">
                                        <label for="">Other Equipment</label>
                                        <small class="text-muted"> (Please specify the equipment)</small>
                                        <input type="text" class="form-control mt-1" name="other_equipment" id=""
                                            placeholder="Other equipment" autofocus>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6" id="brandModelContainer">
                                    <div class="form-group mb-3">
                                        <label for="">Brand and Model</label>
                                        <input type="text" class="form-control mt-1" name="model" id="brandModelInput"
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
                                            data-max-file-size="5MB" data-max-files="1" name="equipment_image" required>
                                    </div>
                                </div>
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
        </div>

        <div class="modal fade" id="view_details_equipment_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="mx-3">
                            <h2 class="mb-0">Equipment Details</h2>
                            <small class="text-muted mb-0">Below are details of the equipment.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <div class="row">
                            <div class="col-sm-12 col-md-7">
                                <img src="" id="modal-view-image" alt="Logo"
                                    style="width: 100%; max-width: 100%; max-height: 270px; object-fit: contain;"
                                    srcset="">
                            </div>

                            <div class="col-sm-12 col-md-5">

                                <div class="ms-3">
                                    <small>Equipment: <h5 id="modal-view-equipment-name"></h5></small>
                                    <small>Brand / Model: <h5 id="modal-view-model"></h5></small>
                                    <small>Color: <h5 id="modal-view-color"></h5></small>
                                    <small>Description: <h5 id="modal-view-description"></h5></small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
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
                            <h2 class="mb-0">QR Code</h2>
                            <small>Show this to be scanned.</small>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body mb-3">
                        <div class="col-sm-12 col-md-12">
                            <div class="text-center">
                                <div id="modal-student-qrcode" class="mt-4 d-flex justify-content-center p-5 bg-white">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="modal-qrcode-download"
                            class="btn btn-success d-flex align-items-center" onclick="downloadQRCode()">
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

    // V I E  W  E Q U I P M E N T  D E T A I L S
    document.addEventListener('DOMContentLoaded', function () {
        var viewModal = document.getElementById('view_details_equipment_modal');
        viewModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var viewImage = button.getAttribute('data-view-image');
            var viewEquipmentName = button.getAttribute('data-view-equipment-name');
            var viewModel = button.getAttribute('data-view-brand-model');
            var viewColor = button.getAttribute('data-view-color');
            var viewDescription = button.getAttribute('data-view-description');

            var modalEquipmentName = viewModal.querySelector('#modal-view-equipment-name');
            var modalModel = viewModal.querySelector('#modal-view-model');
            var modalColor = viewModal.querySelector('#modal-view-color');
            var modalDescription = viewModal.querySelector('#modal-view-description');

            modalEquipmentName.textContent = viewEquipmentName;
            modalModel.textContent = viewModel;
            modalColor.textContent = viewColor;
            modalDescription.textContent = viewDescription;

            var modalImage = viewModal.querySelector('#modal-view-image');
            modalImage.src = viewImage;
            modalImage.alt = viewEquipmentName;
        });
    });

    // Q R  C O D E
    document.addEventListener('DOMContentLoaded', function () {
        var viewModal = document.getElementById('show_qrcode');

        viewModal.addEventListener('show.bs.modal', function (event) {
            var qrCodeValue = '<?= session()->get('logged_code') ?>';

            var qrCodeContainer = document.getElementById('modal-student-qrcode');
            qrCodeContainer.innerHTML = '';

            var qrCode = new QRCode(qrCodeContainer);
            qrCode.makeCode(qrCodeValue);
        });
    });

    // D O W N L O A  D   Q R C O D E
    function downloadQRCode() {
        var canvas = document.querySelector('#modal-student-qrcode canvas');
        var fileName = '<?= session()->get('logged_code') ?>.png';

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

    document.addEventListener('DOMContentLoaded', function () {
        const table = document.querySelector('#table1');
        const qrCodeContainer = document.getElementById('qrcode');
        const qrCodeColumn = document.querySelector('.col-sm-12.col-md-4');
        const equipmentTableContainer = document.getElementById('equipmentTableContainer');

        if (table.getAttribute('data-has-data') === 'true') {
            qrCodeColumn.classList.remove('d-none');
            equipmentTableContainer.classList.remove('col-md-12');
            equipmentTableContainer.classList.add('col-md-8');

            // Generate QR code
            new QRCode(qrCodeContainer, "<?= session()->get('logged_code') ?>");
        } else {
            qrCodeColumn.classList.add('d-none');
            equipmentTableContainer.classList.remove('col-md-8');
            equipmentTableContainer.classList.add('col-md-12');
        }
    });

    const equipmentSelect = document.getElementById('equipmentSelect');
    const otherEquipmentContainer = document.getElementById('other_equipment');
    const descriptionContainer = document.getElementById('description-container');

    equipmentSelect.addEventListener('change', function () {
        if (equipmentSelect.value === 'other') {
            otherEquipmentContainer.classList.remove('d-none');
            descriptionContainer.classList.remove('col-md-6');
            descriptionContainer.classList.add('col-md-12');
        } else {
            otherEquipmentContainer.classList.add('d-none');
            descriptionContainer.classList.remove('col-md-12');
            descriptionContainer.classList.add('col-md-6');
        }
    });


    // G E N E R A T E   C O D E

    // function generateCode() {
    //     const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    //     let code = '';
    //     for (let i = 0; i < 12; i++) {
    //         code += characters.charAt(Math.floor(Math.random() * characters.length));
    //     }
    //     return code;
    // }

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
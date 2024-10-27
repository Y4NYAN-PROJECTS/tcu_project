<?php $this->extend('/VisitorPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Visitor Equipment Form</h4>
        <small>Kindly fill all the necessary information.</small>
    </div>
    <hr class="mt-0">

    <form action="/VisitorController/EquipmentLog" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <input type="hidden" name="equipment_count" id="equipment_count" value="1">
            <div class="row mt-3">
                <h3>Visitor Information</h3>
                <div class="col-sm-12 col-md-6" id="brandModelContainer">
                    <div class="form-group mb-3">
                        <label for="">Full Name</label>
                        <input type="text" class="form-control mt-1" name="full_name" placeholder="John Doe" required>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6">
                    <div class="form-group mb-3">
                        <label for="confirmEmail">Valid ID</label>
                        <small class="text-muted">(Formats: JPG, PNG | Max size: 5MB)</small>
                        <input type="file" class="form-control" data-max-file-size="5MB" data-max-files="1" name="valid_id_image" required>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-0">
        <div class="card-body">
            <div class="row mt-3" id="equipment-1">
                <h3 id="equipment_no">Equipment No. 1</h3>
                <div class="col-sm-12 col-md-6" id="brandModelContainer">
                    <div class="form-group mb-3">
                        <label for="">Equipment Type</label>
                        <input type="text" class="form-control mt-1" name="equipment_name" placeholder="Ex. Laptop" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6" id="brandModelContainer">
                    <div class="form-group mb-3">
                        <label for="">Brand and Model</label>
                        <input type="text" class="form-control mt-1" name="model" placeholder="Ex. Logitech 1520" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="form-group mb-3">
                        <label for="">Color</label>
                        <input type="text" class="form-control mt-1" name="color" placeholder="Ex. Black" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6" id="description-container">
                    <div class="form-group mb-3">
                        <label for="">More Description</label>
                        <small class="text-muted">(Input N/A if no further description.)</small>
                        <input type="text" class="form-control mt-1" name="description" placeholder="Ex. RGB Lights" required>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12" id="input-form">
                    <div class="form-group mb-3">
                        <label for="confirmEmail">Picture</label>
                        <small class="text-muted">(Formats: JPG, PNG | Max size: 5MB)</small>
                        <input type="file" class="form-control" data-max-file-size="5MB" data-max-files="1" name="equipment_image" required>
                    </div>
                </div>
            </div>

            <div class="equipment-form-container"></div>

            <div id="delete-last" class="text-center text-sm mb-3 d-none">
                <a href="#" class="text-danger">Remove <i class="bi bi-plus-minus me-3"></i></a>
            </div>

            <div class="text-center text-sm my-3">
                <a href="#" id="add-more">Click here to add more equipments <i class="bi bi-plus-lg"></i></a>
            </div>
        </div>
        <div class="card-footer mt-0">
            <div class="text-center mb-4">
                <div class="form-group d-flex justify-content-center align-items-center">
                    <input type="checkbox" class="form-check-input form-check-primary me-2" name="agree_tac" required>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal_terms_and_condition" class="text-sm">I agree to the Terms and Condition</a>
                </div>
            </div>
            <button class="btn btn-primary form-control">Submit</button>
        </div>
    </form>
</div>

<div class="modal fade" id="modal_terms_and_condition" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="mx-3 mt-3">
                    <h2 class="mb-0">Terms and Condition</h2>
                    <small class="text-muted mb-0">Please click the checkbox if you accept the terms and condition.</small>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="/AdminController/DepartmentUpdate" method="post">
                <div class="modal-body m-3" style="max-height: 60vh; overflow-y: auto;">
                    <small>Efficient Resource Tracking in Education: Digital Equipment and Appliances Logging System for Taguig City University</small>
                    <h5>Terms and Conditions for Collecting Personal Information and Identification</h5>
                    <p>
                        <strong>1. Introduction</strong><br>
                        Welcome to the Efficient Resource Tracking in Education: Digital Equipment and Appliances Logging System (hereafter referred to as "the System"). By using the System, you agree to comply with and be bound by these Terms and Conditions.<br><br>

                        <strong>2. Information We Collect</strong><br>
                        We collect the following types of personal information from visitors bringing equipment or gadgets onto the campus:
                    <ul>
                        <li>Full Name</li>
                        <li>Contact Information (e.g., phone number, email address)</li>
                        <li>Identification Documents (e.g., government-issued ID)</li>
                        <li>Details of Equipment/Gadgets (e.g., type, serial number)</li>
                        <li>Date and Time of Entry and Exit</li>
                    </ul>

                    <strong>3. Purpose of Data Collection</strong><br>
                    The collected information is used to:
                    <ul>
                        <li>Verify your identity</li>
                        <li>Track and monitor the equipment or gadgets brought onto the campus</li>
                        <li>Maintain accurate records for security and accountability purposes</li>
                        <li>Communicate with you regarding any issues or concerns related to your equipment</li>
                    </ul>

                    <strong>4. Data Security</strong><br>
                    We prioritize the security of your personal information. Appropriate physical, electronic, and managerial procedures are in place to safeguard and secure the data we collect.<br><br>

                    <strong>5. Data Retention</strong><br>
                    Your personal information and identification documents will be retained only as long as necessary for the purposes outlined in these Terms and Conditions. Afterward, your data will be securely deleted or anonymized.<br><br>

                    <strong>6. Disclosure of Information</strong><br>
                    We do not sell, distribute, or lease your personal information to third parties without your consent unless required by law. We may share your information with third parties assisting in operating the System and providing services, under confidentiality agreements.<br><br>

                    <strong>7. Your Rights</strong><br>
                    You have the right to:
                    <ul>
                        <li>Access and review your personal information</li>
                        <li>Request corrections to inaccuracies in your personal information</li>
                        <li>Request deletion of your personal information, subject to legal and operational requirements</li>
                    </ul>

                    <strong>8. Changes to Terms and Conditions</strong><br>
                    We may update or change these Terms and Conditions at any time. Changes will be posted on the System, and it is your responsibility to review these Terms and Conditions periodically.<br><br>

                    <strong>9. Contact Information</strong><br>
                    For questions or concerns about these Terms and Conditions or the handling of your personal information, contact us at:
                    <ul>
                        <li>Email: support@taguigcityuniversity.edu</li>
                        <li>Phone: +63 2 1234 5678</li>
                    </ul>
                    Effective Date: [Insert Effective Date]<br><br>

                    By clicking "Accept" or using the System, you acknowledge that you have read, understood, and agree to these Terms and Conditions.<br>
                    </p>

                </div>

                <input type="hidden" name="department_id" id="modal-department-id" value="">

                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cancel</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        <span class="px-3">Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        let equipmentCount = 1;

        const equipmentNumber = document.getElementById("equipment_no");
        equipmentNumber.textContent = 'Equipment No. ' + equipmentCount;

        const deleteButton = document.getElementById("delete-last");
        const updateDeleteButtonVisibility = () => {
            if (equipmentCount > 1) {
                deleteButton.classList.remove('d-none');
            } else {
                deleteButton.classList.add('d-none');
            }
        };

        document.querySelector("#add-more").addEventListener("click", function (event) {
            event.preventDefault();
            equipmentCount++;

            const newEquipmentRow = document.getElementById("equipment-1").cloneNode(true);
            newEquipmentRow.id = "equipment-" + equipmentCount;

            const equipmentNumber = newEquipmentRow.querySelector("#equipment_no");
            if (equipmentNumber) {
                equipmentNumber.textContent = 'Equipment No. ' + equipmentCount;
            }

            const equipmentCountInput = document.getElementById("equipment_count");
            equipmentCountInput.value = equipmentCount;

            Array.from(newEquipmentRow.querySelectorAll("input, select")).forEach((input) => {
                const name = input.getAttribute("name");
                if (name) input.setAttribute("name", name + "_" + equipmentCount);

                if (input.tagName === "INPUT") input.value = "";
                if (input.tagName === "SELECT") input.selectedIndex = 0;
            });

            document.querySelector(".equipment-form-container").appendChild(newEquipmentRow);
            updateDeleteButtonVisibility();

            const firstInputField = newEquipmentRow.querySelector("input, select");
            if (firstInputField) {
                firstInputField.focus();
            }
        });

        deleteButton.addEventListener("click", function (event) {
            event.preventDefault();
            if (equipmentCount > 1) {
                const lastEquipmentRow = document.getElementById("equipment-" + equipmentCount);
                lastEquipmentRow.remove();
                equipmentCount--;

                const equipmentCountInput = document.getElementById("equipment_count");
                equipmentCountInput.value = equipmentCount;

                updateDeleteButtonVisibility();

                const newLastEquipmentRow = document.getElementById("equipment-" + equipmentCount);
                const firstInputField = newLastEquipmentRow.querySelector("input, select");
                if (firstInputField) {
                    firstInputField.focus();
                }
            }
        });
    });
</script>

<?= $this->endSection(); ?>
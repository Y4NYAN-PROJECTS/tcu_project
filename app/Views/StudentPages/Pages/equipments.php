<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Equipment</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Equipment</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header mb-0 pb-0 text-center">
                <h1>Equipments List</h1>
            </div>

            <hr class="mt-1">

             <div class="card-body">
        <div class="form-group">
            <h5 class="mb-3">Select Equipment</h5>
            <div class="row">
                <div class="col-10 col-md-6 col-lg-3">

                 <fieldset class="form-group">
                    <select class="form-select" name="equipment_name" id="equipmentSelect">
                        <option value="">Select Equipment</option>
                    <?php foreach ($equip as $equips): ?>
                        <option value="<?= $equips['equipment_id'] ?>:<?= $equips['equipment_name'] ?>:<?= $equips['equipment_code'] ?>">
                            <?= $equips['equipment_name'] ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
                </fieldset>

                </div>
                <div class="col-2 col-md-3 col-lg-2">
                    <button href="#" class="btn btn-primary" id="addButton" onclick="showEquipmentDetails()">Add</button>
                </div>
            </div>
        </div>

        <hr class="hidden" id="equipmentDetailsHeader">
        <h2 class="hidden section-title" id="equipmentDetailsTitle"></h2>
        <div class="row hidden" name="equipment_type" id="equipmentDetailsSection">
            <div class="col-6">
                <form id="equipment" method="post" action="/StudentController/AddEquipment" enctype="multipart/form-data"> 

                    <!-- [ Hidden Inputs ] -->
                    <input type="hidden" name="equipment_name" id="equipmentDetailsSection" value="">
                    <input type="hidden" name="equipment_type_code" value="">

                    <div class="form-group mt-3 mb-3">
                        <h6>Model</h6>
                        <input class="form-control" name="model" type="text" placeholder="">
                    </div>

                    <div class="form-group mb-3">
                       <h6>Color</h6>
                        <input class="form-control" name="color" type="text" placeholder="">
                    </div>
                    
                    <div class="form-group mb-4">
                    <h6 for="formFile" class="form-label">Image of Equipment</h6>
                    <input 
                    class="form-control" 
                    type="file" 
                    id="formFile"
                    accept=".png, .jpg, .jpeg" 
                    onchange="previewImage(event)" 
                    name="equipment_image">
                    </div>

                    <div class="form-group">
                        <h6>Description</h6>
                        <textarea class="form-control" name="description" required ></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>

                <!-- Error message container -->
                <div id="file-error" style="color: red; display: none;"></div>
            </div>

            <div class="col-6">
                <!-- Image Preview Section -->
                <div class="card-body mt-4">
                    <div class="chocolat-parent">
                        <a id="imagePreviewLink" href="#" class="chocolat-image ms-5" title="Preview Image" style="display: none;">
                            <div data-crop-image="285" class="image-cover">
                                <img id="imagePreview" alt="image" src="#" class="img-fluid" style="display: none;">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </section>
</div>

<script>

// G E N E R A T E   C O D E

function generateCode() {
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  let code = '';
  for (let i = 0; i < 12; i++) {
    code += characters.charAt(Math.floor(Math.random() * characters.length));
  }
  return code;
}

  document.getElementById('equipment').addEventListener('submit', function(event) {
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
    const equipmentDetailsRow = equipmentDetailsSection.closest('.row'); // Get the parent row element

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
        reader.onload = function(e) {
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
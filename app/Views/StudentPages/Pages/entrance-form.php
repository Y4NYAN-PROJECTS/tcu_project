<?= $this->extend('/StudentPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<style>
  .selected {
    background-color: blue;
    color: white;
    border-color: blue;
  }

  .selected::before {
    content: '✓'; 
    font-size: 16px;
    color: white;
    margin-right: 3px; 
  }

  /* Hide the QR code and related elements initially */
  #qrcode, #expirationContainer, #downloadButton {
    display: none; /* Initially hide these elements */
  }
</style>

<div id="main-content">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Entrance Form</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Entrance Form</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header mb-0 pb-0 text-center">
                <h1>Entrance Form</h1>
            </div>

            <hr class="mt-1">

           <div class="card-body">
    <form id="equipmentForm" method="POST" action="/StudentController/EntranceForm" enctype="multipart/form-data">
      <div class="row">
        <div class="col-8 col-md-8 col-lg-8">
          <!-- <h4 class="text-primary">Select Equipment & Generate QR Code</h4> -->
          <p>Click the equipment(s) to generate a QR code that must be presented to the guard upon entering the university.</p>
          
          <div class="buttons">
            <?php foreach ($studentEquipment as $studentEquipments): ?>
              <a href="#" class="btn btn-outline-primary mt-0 border-radius-20" 
                 style="border-radius: 20px;" onclick="toggleSelection(this, '<?= $studentEquipments['student_equipment_code'] ?>')">
                <?= $studentEquipments['equipment_name'] ?>
              </a>
              <!-- [ Hidden Inputs ] -->
              <input type="hidden" name="student_equipment[<?= $studentEquipments['student_equipment_code'] ?>]" value="<?= $studentEquipments['student_equipment_code'] ?>" disabled>
            <?php endforeach; ?>
          </div>
          <input type="hidden" name="form_code" class="form-control" id="gen_code" placeholder="Generated Code" required>
          <input type="hidden" name="equipment_count" value="0" id="equipmentCount">
          <input type="hidden" name="expiration_timestamp" value="">
          <input type="file" name="qr_code_file" id="qr_code_file" style="display: none;">
          <input type="hidden" name="qr_code_file_name" value="">

          <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </div>

        <div class="col-4 col-md-4 col-lg-4 m-0">
          <div class="card">
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label mb-3">Generated QR Code</label>
                <div class="d-flex justify-content-center align-items-center" id="qrcode"></div>
                <div id="expirationContainer" style="display: none;">
                  <label class="form-label mt-3 text-dark">Expiration Date: <span id="expirationDate"></span></label>
                </div>
                <button type="button" class="btn btn-success mt-3" id="downloadButton" onclick="downloadQRCode()">Download QR Code</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
</section>

 <section class="section">
        <div class="card shadow-sm">
            <div class="card-header mb-0 pb-0 text-center">
                <h1>Equipment Information Table</h1>
            </div>

            <hr class="mt-1">

               <div class="card">
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Form Code</th>
          <th>Full Name</th>
          <th>User Code</th>
          <th>Student Equipment Code</th>
          <th>Equipment Count</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($studentForm as $data): ?>
          <tr>
            <td><?= $data['form_code']; ?></td>
            <td><?= $data['full_name']; ?></td>
            <td><?= $data['user_code']; ?></td>
           <td>
            <?php 
            $codes = explode('|', $data['student_equipment_code']); 
            foreach ($codes as $code): ?>
            <a href="/StudentController/EquipmentDetailsPage/<?= trim($code); ?>" style="display: block;"><?= trim($code); ?></a>
            <?php endforeach; ?>
            </td>
            <td><?= $data['equipment_count']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

            </div>
</section>
</div>

<script src="/assets/compiled/js/qrcode/config.js"></script>

<script>
// QR CODE
var qrcode = new QRCode('qrcode');

// Counter for selected equipment
let equipmentCount = 0; 

// Function to generate QR Code and set expiration date
function generateCode() {
  var qrcodeValue = document.getElementById("gen_code");

  // If no equipment is selected, show a default QR code with no data
  if (equipmentCount === 0) {
    qrcode.clear(); // Clear any existing QR code
    qrcode.makeCode("No equipment selected"); // Generate placeholder QR code
    document.getElementById('qrcode').style.display = 'block'; // Ensure QR code is displayed
    document.getElementById('expirationContainer').style.display = 'none';
    document.getElementById('downloadButton').style.display = 'none';

    // Clear QR code file data
    document.querySelector('input[name="qr_code_file_name"]').value = "";
    document.getElementById('qr_code_file').files = null; // Clear file input
    
    return; // Exit the function
  }

  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  let code = '';

  for (let i = 0; i < 12; i++) {
    code += characters.charAt(Math.floor(Math.random() * characters.length));
  }

  qrcodeValue.value = code;
  qrcode.makeCode(code); // Generate the QR code

  // Set the expiration date to today at 11:59 PM
  const expirationTime = new Date();
  expirationTime.setHours(23, 59, 0, 0); // Set to today at 11:59 PM
  document.querySelector('input[name="expiration_timestamp"]').value = expirationTime.getTime();
  document.getElementById('expirationDate').textContent = expirationTime.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' });

  // Show QR code and related elements
  document.getElementById('qrcode').style.display = 'block';
  document.getElementById('expirationContainer').style.display = 'block';
  document.getElementById('downloadButton').style.display = 'block';
}

// Handle form submission to ensure QR code file is attached
document.getElementById('equipmentForm').addEventListener('submit', function(event) {
  // Prevent the form from submitting until we attach the QR code file
  event.preventDefault();

  // Generate the QR code image file from the canvas
  var canvas = document.querySelector('#qrcode canvas');
  var qrcodeValue = document.getElementById("gen_code"); // Get the generated code value
  if (canvas) {
    canvas.toBlob(function(blob) {
      // Use the generated code as the file name for the QR code
      const fileName = `${qrcodeValue.value}.png`;
      
      // Create the file object from the blob
      var file = new File([blob], fileName, { type: "image/png" });
      
      // Attach the file to the hidden file input
      var dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);
      document.getElementById('qr_code_file').files = dataTransfer.files; // Attach the file to the hidden file input
      
      // Set the file name in the hidden input field
      document.querySelector('input[name="qr_code_file_name"]').value = fileName; 

      // Now that the file is attached, submit the form
      event.target.submit();
    });
  } else {
    alert("QR code image is not available.");
  }
});

// Download the generated QR Code
function downloadQRCode() {
  var canvas = document.querySelector('#qrcode canvas');

  if (equipmentCount === 0) {
    alert("Please select at least one equipment before generating the code.");
    return;
  }
  if (!canvas) {
    alert("No QR Code generated yet!");
    return;
  }

  var image = canvas.toDataURL("image/png");
  var link = document.createElement('a');
  link.href = image;
  link.download = `${document.getElementById("gen_code").value}.png`;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

// Toggle equipment selection
function toggleSelection(element, studentEquipmentCode) {
  element.classList.toggle('selected'); 
  let input = document.querySelector(`input[name="student_equipment[${studentEquipmentCode}]"]`);

  if (input.disabled) {
    input.disabled = false; 
    equipmentCount++; 
  } else {
    input.disabled = true;
    equipmentCount--; 
  }

  document.getElementById('equipmentCount').value = equipmentCount; 

  // Call generateCode to update QR code visibility
  generateCode();
}

</script>

<?= $this->endSection(); ?>

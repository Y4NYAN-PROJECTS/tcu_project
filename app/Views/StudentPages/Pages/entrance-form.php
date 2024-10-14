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

  #qrcode,
  #expirationContainer,
  #downloadButton {
    /* display: none; */
  }
</style>

<div id="main-content">
  <div class="page-heading mt-5">
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
        <div class="row d-flex justify-content-center align-items-center mt-3">
          <div class="col-md-8">

            <div class="text-center">
              <span>Select the equipment you are going to bring today. Click submit to get generatated QR-code that must be presented to the entrance.</span>
              <hr class="mt-1">
            </div>


            <?php if (empty($studentEquipment)): ?>
              <div class="text-center">
                <small class="text-primary fst-italic">No equipment found! Click the button to add equipment.</small><br>
                <a href="/StudentController/EquipmentsPage"><button class="btn btn-primary mt-2">Add Equipment</button></a>
              </div>
            <?php else: ?>
              <form id="entrance-form" method="POST" action="/StudentController/EntranceForm" enctype="multipart/form-data">
                <div class="text-center px-5">
                  <div id="selected-count" class="mb-3">Selected: 0</div>
                  <?php foreach ($studentEquipment as $studentEquipments): ?>
                    <a href="#" class="btn btn-outline-primary rounded-pill px-5 m-2" onclick="toggleSelection(this, '<?= $studentEquipments['student_equipment_code'] ?>')">
                      <?= $studentEquipments['equipment_name'] ?> [<?= $studentEquipments['model'] ?>]
                    </a>
                    <!-- [ Hidden Inputs ] -->
                    <input type="checkbox" id="equipment-<?= $studentEquipments['student_equipment_code'] ?>" name="student_equipment[]" value="<?= $studentEquipments['student_equipment_code'] ?>" class="d-none">
                  <?php endforeach; ?>
                </div>


                <input type="text" id="gen_code" name="form_code">
                <input type="text" id="equipment-count" name="equipment_count">
                <input type="file" id="qr-file" name="qr_code_file" class="d-none">
                <input type="text" id="qr-file-name" name="qr_code_file_name">

                <button type="submit" class="btn btn-primary form-control mt-3">Submit</button>
              </form>
            <?php endif; ?>
          </div>

          <div class="col-md-4">
            <div class="text-center">
              <div id="qrcode" class="d-flex justify-content-center align-items-center"></div>
              <div id="qr-expiration-container">
                <label class="form-label mt-3 text-dark">Expiration Date: <span id="qr-expiration-date"></span></label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr>
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
  var qrcode = new QRCode('qrcode');

  generateCode();

  function generateCode() {
    var qrcodeValue = document.getElementById("gen_code");
    var qrcodeExpirationDisplay = document.getElementById("qr-expiration-date");
    var qrcodeExpirationContainer = document.getElementById("qr-expiration-container");
    var qrcodeDisplay = document.getElementById("qrcode");


    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let code = '';
    for (let i = 0; i < 12; i++) {
      code += characters.charAt(Math.floor(Math.random() * characters.length));
    }

    qrcodeValue.value = code;
    qrcode.makeCode(code);

    // Expiration Date
    const expirationTime = new Date();
    expirationTime.setHours(23, 59, 0, 0);
    qrcodeExpirationDisplay.textContent = expirationTime.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' });

    qrcodeDisplay.style.display = 'block';
    qrcodeExpirationContainer.style.display = 'block';
  }

  var form = document.getElementById('entrance-form');
  form.addEventListener('submit', function (event) {
    event.preventDefault();

    var qrcodeDisplay = document.getElementById("qrcode").getElementsByTagName("canvas")[0];
    var qrcodeValue = document.getElementById("gen_code");
    var qrcodeFile = document.getElementById("qr-file");
    var qrcodeFileName = document.getElementById("qr-file-name");

    if (qrcodeDisplay) {
      qrcodeDisplay.toBlob(function (blob) {
        var fileName = `${qrcodeValue.value}.png`;
        var file = new File([blob], fileName, { type: "image/png" });

        var dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        qrcodeFile.files = dataTransfer.files;

        qrcodeFileName.value = fileName;
        event.target.submit();
      });
    } else {
      alert("QR code image is not available.");
    }
  });

  function toggleSelection(button, code) {
    const checkbox = document.getElementById('equipment-' + code);
    checkbox.checked = !checkbox.checked;
    button.classList.toggle('active', checkbox.checked);
    updateSelectedCount();
  }

  function updateSelectedCount() {
    var countInput = document.getElementById('equipment-count');
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    let count = 0;
    checkboxes.forEach(checkbox => {
      if (checkbox.checked) {
        count++;
      }
    });
    document.getElementById('selected-count').innerText = 'Selected: ' + count;
    countInput.value = count;
  }

  // // Counter for selected equipment
  // let equipmentCount = 0;

  // // Function to generate QR Code and set expiration date
  // function generateCode() {
  //   var qrcodeValue = document.getElementById("gen_code");

  //   // If no equipment is selected, show a default QR code with no data
  //   if (equipmentCount === 0) {
  //     qrcode.clear(); // Clear any existing QR code
  //     qrcode.makeCode("No equipment selected"); // Generate placeholder QR code
  //     document.getElementById('qrcode').style.display = 'block'; // Ensure QR code is displayed
  //     document.getElementById('expirationContainer').style.display = 'none';
  //     document.getElementById('downloadButton').style.display = 'none';

  //     // Clear QR code file data
  //     document.querySelector('input[name="qr_code_file_name"]').value = "";
  //     document.getElementById('qr_code_file').files = null; // Clear file input

  //     return; // Exit the function
  //   }

  //   const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  //   let code = '';

  //   for (let i = 0; i < 12; i++) {
  //     code += characters.charAt(Math.floor(Math.random() * characters.length));
  //   }

  //   qrcodeValue.value = code;
  //   qrcode.makeCode(code); // Generate the QR code

  //   // Set the expiration date to today at 11:59 PM
  //   const expirationTime = new Date();
  //   expirationTime.setHours(23, 59, 0, 0); // Set to today at 11:59 PM
  //   document.querySelector('input[name="expiration_timestamp"]').value = expirationTime.getTime();
  //   document.getElementById('expirationDate').textContent = expirationTime.toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' });

  //   // Show QR code and related elements
  //   document.getElementById('qrcode').style.display = 'block';
  //   document.getElementById('expirationContainer').style.display = 'block';
  //   document.getElementById('downloadButton').style.display = 'block';
  // }

  // // Handle form submission to ensure QR code file is attached
  // document.getElementById('entrance-form').addEventListener('submit', function (event) {
  //   // Prevent the form from submitting until we attach the QR code file
  //   event.preventDefault();

  //   // Generate the QR code image file from the canvas
  //   var canvas = document.querySelector('#qrcode canvas');
  //   var qrcodeValue = document.getElementById("gen_code"); // Get the generated code value
  //   if (canvas) {
  //     canvas.toBlob(function (blob) {
  //       // Use the generated code as the file name for the QR code
  //       const fileName = `${qrcodeValue.value}.png`;

  //       // Create the file object from the blob
  //       var file = new File([blob], fileName, { type: "image/png" });

  //       // Attach the file to the hidden file input
  //       var dataTransfer = new DataTransfer();
  //       dataTransfer.items.add(file);
  //       document.getElementById('qr_code_file').files = dataTransfer.files; // Attach the file to the hidden file input

  //       // Set the file name in the hidden input field
  //       document.querySelector('input[name="qr_code_file_name"]').value = fileName;

  //       // Now that the file is attached, submit the form
  //       event.target.submit();
  //     });
  //   } else {
  //     alert("QR code image is not available.");
  //   }
  // });

  // // Download the generated QR Code
  // function downloadQRCode() {
  //   var canvas = document.querySelector('#qrcode canvas');

  //   if (equipmentCount === 0) {
  //     alert("Please select at least one equipment before generating the code.");
  //     return;
  //   }
  //   if (!canvas) {
  //     alert("No QR Code generated yet!");
  //     return;
  //   }

  //   var image = canvas.toDataURL("image/png");
  //   var link = document.createElement('a');
  //   link.href = image;
  //   link.download = `${document.getElementById("gen_code").value}.png`;
  //   document.body.appendChild(link);
  //   link.click();
  //   document.body.removeChild(link);
  // }



</script>

<?= $this->endSection(); ?>
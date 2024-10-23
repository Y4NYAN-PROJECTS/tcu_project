<?= $this->extend('/LoginPages/Components/main-layout'); ?>
<?= $this->section('content'); ?>

<div class="col-md-5 d-flex justify-content-center align-items-center my-5">
    <div class="container px-5">
        <div class="d-flex align-items-center">
            <div class="col-auto pr-0 me-3" style="height: 80px;">
                <img src="/assets/profilePictures/default.jpg" style="max-height: 100%; width: auto;" alt="">
            </div>
            <div class="col pl-0">
                <h1 class="mb-0">Register</h1>
                <p class="mb-0">Please fill out the following fields to create your account.</p>
            </div>
        </div>
        <hr class="mb-0">

        <?php if ($userTypeId == 1): ?>
            <div class="pt-3 text-center">
                <span class="badge bg-primary px-3 py-2">Administrator Registration</span>
            </div>
        <?php elseif ($userTypeId == 2): ?>
            <div class="pt-3 text-center">
                <span class="badge bg-primary px-3 py-2">Student Registration</span>
            </div>
        <?php endif; ?>

        <form action="/LoginController/RegisterPage/<?= $userTypeId ?>" method="post">
            <?php if ($userTypeId == 2): ?>
                <div class="form-group mt-3">
                    <label class="text-sm" for="">Student ID</label>
                    <input type="text" id="student_id" class="form-control" name="student_id" placeholder="ex. 00-0000" autofocus required>
                    <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                        Invalid Student ID
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group mt-3">
                <label class="text-sm" for="">First Name</label>
                <input type="text" id="first_name" class="form-control" name="first_name" placeholder="John" autofocus required>
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    Contains special characters or numbers
                </div>
            </div>

            <div class="form-group mt-3">
                <label class="text-sm" for="">Middle Name</label>
                <input type="text" id="middle_name" class="form-control" name="middle_name" placeholder="Mercer" autofocus>
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    Contains special characters or numbers
                </div>
            </div>

            <div class="form-group mt-3">
                <label class="text-sm" for="">Last Name</label>
                <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Doe" autofocus required>
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    Contains special characters or numbers
                </div>
            </div>

            <?php if ($userTypeId == 1): ?>
                <div class="form-group mt-3">
                    <label class="text-sm" for="">Department</label>
                    <select class="form-control form-select" name="department" id="department" required>
                        <option value="">Select Department</option>
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= $department['department_id'] ?>"><?= $department['department_title'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>


            <?php if ($userTypeId == 2): ?>
                <div class="form-group mt-3">
                    <label class="text-sm" for="">Department</label>
                    <select class="form-control form-select" name="department" id="department" required>
                        <option value="">Select Department</option>
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= $department['department_id'] ?>"><?= $department['department_title'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label class="text-sm" for="">Program</label>
                    <select class="form-control form-select" name="program" id="program" required>
                        <option value="">Select Program</option>
                        <?php foreach ($programs as $program): ?>
                            <option value="<?= $program['program_id'] ?>" data-department-id="<?= $program['department_id'] ?>"><?= $program['program_title'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <div class="form-group mt-2">
                <label class="text-sm" for="">Email</label>
                <input type="text" id="email" class="form-control" name="email" placeholder="johndoe@email.com" required>
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    Invalid Email
                </div>
            </div>

            <div class="form-group mt-2">
                <label class="text-sm" for="">Username</label>
                <input type="text" id="username" class="form-control" name="username" placeholder="johndoe2024" required>
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    Username Already Exist
                </div>
            </div>

            <div class="form-group mt-2">
                <label class="text-sm" for="password">Password</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    Password must be 8 characters long.
                </div>
                <p><small class="text-muted" id="helpMessage">Password must be 8 characters long.</small></p>
            </div>

            <div class="form-group mt-2">
                <label class="text-sm" for="retypePassword">Retype Password</label>
                <input type="password" id="retypePassword" class="form-control" name="password" placeholder="Retype Password" required>
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                    Password does not match.
                </div>
            </div>

            <input type="hidden" name="check_register" value="true">

            <button type="submit" class="btn btn-primary btn-block btn-md shadow-lg mt-3" id="submitButton">Register</button>
        </form>

        <div class="text-center mt-2">
            <p>Already have an account? <a href="/LoginController/LoginPage/<?= $userTypeId ?>" class="font-bold">Login Now</a></p>
        </div>
    </div>
</div>


<script>
    document.getElementById('student_id').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/\D/g, '');

        if (value.length > 2) {
            value = value.slice(0, 2) + '-' + value.slice(2);
        }

        e.target.value = value;
    });

    document.addEventListener("DOMContentLoaded", function () {
        var firstName = <?= json_encode($firstName) ?>;
        var middleName = <?= json_encode($middleName) ?>;
        var lastName = <?= json_encode($lastName) ?>;
        var email = <?= json_encode($email) ?>;
        var username = <?= json_encode($username) ?>;
        var department = <?= json_encode($departmentId) ?>;
        var program = <?= json_encode($programId) ?>;
        var usernameError = <?= json_encode($usernameError) ?>;
        var checkRegister = <?= json_encode($checkRegister) ?>;

        const firstNameInput = document.getElementById('first_name');
        const middleNameInput = document.getElementById('middle_name');
        const lastNameInput = document.getElementById('last_name');
        const emailInput = document.getElementById('email');
        const departmentDropdown = document.getElementById("department");
        const programDropdown = document.getElementById("program");
        const usernameInput = document.getElementById('username');

        if (checkRegister) {
            if (usernameError) {
                usernameInput.focus();
                usernameInput.classList.add("is-invalid");

                firstNameInput.value = firstName;
                middleNameInput.value = middleName;
                lastNameInput.value = lastName;
                emailInput.value = email;
                departmentDropdown.value = department;
                programDropdown.value = department;
            } else {
                usernameInput.classList.remove("is-invalid");
            }
        }
    });

    const studentIdInput = document.getElementById('student_id');
    const firstNameInput = document.getElementById('first_name');
    const middleNameInput = document.getElementById('middle_name');
    const lastNameInput = document.getElementById('last_name');
    const emailInput = document.getElementById('email');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const retypePasswordInput = document.getElementById('retypePassword');
    const submitButton = document.getElementById('submitButton');
    const helpMessage = document.getElementById('helpMessage');
    const department = document.getElementById("department");
    const program = document.getElementById("program");

    studentIdInput.addEventListener('input', function () {
        const formatPattern = /^\d{2}-\d{5}$/;

        let value = studentIdInput.value.replace(/\D/g, '');
        if (value.length > 2) {
            value = value.slice(0, 2) + '-' + value.slice(2);
        }
        studentIdInput.value = value;

        if (formatPattern.test(studentIdInput.value)) {
            studentIdInput.classList.remove("is-invalid");
            submitButton.disabled = false;
        } else {
            studentIdInput.classList.add("is-invalid");
            submitButton.disabled = true;
        }
    });

    emailInput.addEventListener('input', function () {
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (emailPattern.test(emailInput.value)) {
            emailInput.classList.remove("is-invalid");
            submitButton.disabled = false;
        } else {
            emailInput.classList.add("is-invalid");
            submitButton.disabled = true;
        }
    });

    firstNameInput.addEventListener('input', function () {
        const namePattern = /^[a-zA-Z\s]+$/;
        if (namePattern.test(nameInput.value)) {
            nameInput.classList.remove("is-invalid");
            submitButton.disabled = false;
        } else {
            nameInput.classList.add("is-invalid");
            submitButton.disabled = true;
        }
    });

    middleNameInput.addEventListener('input', function () {
        const namePattern = /^[a-zA-Z\s]+$/;
        if (namePattern.test(nameInput.value)) {
            nameInput.classList.remove("is-invalid");
            submitButton.disabled = false;
        } else {
            nameInput.classList.add("is-invalid");
            submitButton.disabled = true;
        }
    });

    lastNameInput.addEventListener('input', function () {
        const namePattern = /^[a-zA-Z\s]+$/;
        if (namePattern.test(nameInput.value)) {
            nameInput.classList.remove("is-invalid");
            submitButton.disabled = false;
        } else {
            nameInput.classList.add("is-invalid");
            submitButton.disabled = true;
        }
    });

    usernameInput.addEventListener('input', function () {
        usernameInput.classList.remove("is-invalid");
    });

    passwordInput.addEventListener('input', function () {
        if (passwordInput.value.length >= 8) {
            passwordInput.classList.remove("is-invalid");
            submitButton.disabled = false;
            helpMessage.style.display = 'inline';
        } else {
            passwordInput.classList.add("is-invalid");
            submitButton.disabled = true;
            helpMessage.style.display = 'none';
        }
    });

    retypePasswordInput.addEventListener('input', function () {
        if (retypePasswordInput.value == passwordInput.value) {
            retypePasswordInput.classList.remove("is-invalid");
            submitButton.disabled = false;
        } else {
            retypePasswordInput.classList.add("is-invalid");
            submitButton.disabled = true;
        }
    });


    department.addEventListener('change', function () {
        const department_id = this.value;

        for (let i = 0; i < program.options.length; i++) {
            const option = program.options[i];
            const program_dept_id = option.getAttribute("data-department-id");

            if (program_dept_id == department_id || !program_dept_id) {
                option.style.display = '';
                console.log(option);
            } else {
                option.style.display = 'none';
            }
        }

        program.value = '';
    });
</script>

<?= $this->endSection(); ?>
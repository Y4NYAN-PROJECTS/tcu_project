<?php $nav_active = session()->get('nav_active'); ?>

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="logo text-center">
                <a href="#"><img src="/assets/tcu/logo-square.png" style="width: auto; height: 100px;" alt="Logo" srcset=""></a>
            </div>
            <h5 class="mt-3 text-center">Digital Equipment and Appliances Logging System</h5>
        </div>

        <hr class="m-0">

        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Account</li>

                <li class="sidebar-item <?= $nav_active == 'account' ? 'active' : '' ?>">
                    <a href="/AdminController/AccountPage" class='sidebar-link'>
                        <i class="bi bi-person"></i>
                        <span><?= session()->get('logged_firstname') ?></span>
                    </a>
                </li>

                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item <?= $nav_active == 'dashboard' ? 'active' : '' ?>">
                    <a href="/AdminController/DashboardPage" class='sidebar-link'>
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  <?= $nav_active == 'department' ? 'active' : '' ?>">
                    <a href="/AdminController/DepartmentPage" class='sidebar-link'>
                        <i class="bi bi-buildings"></i>
                        <span>Department</span>
                    </a>
                </li>

                <li class="sidebar-item  <?= $nav_active == 'program' ? 'active' : '' ?>">
                    <a href="/AdminController/ProgramPage" class='sidebar-link'>
                        <i class="bi bi-bar-chart-steps"></i>
                        <span>Program</span>
                    </a>
                </li>

                <li class="sidebar-item  <?= $nav_active == 'equipment' ? 'active' : '' ?>">
                    <a href="/AdminController/EquipmentPage" class='sidebar-link'>
                        <i class="bi bi-wrench-adjustable-circle"></i>
                        <span>Equipment Type</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub <?= $nav_active == 'scan' ? 'active' : '' ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-qr-code-scan"></i>
                        <span>Scan Now!</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/AdminController/ScanQRCamera" class="submenu-link">Camera</a>
                        </li>

                        <li class="submenu-item">
                            <a href="/AdminController/ScanQRBarcode" class="submenu-link">Barcode</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub <?= $nav_active == 'accounts' ? 'active' : '' ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-people"></i>
                        <span>Accounts</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/AdminController/AccountAdmin" class="submenu-link">Administrator</a>
                        </li>

                        <li class="submenu-item">
                            <a href="/AdminController/AccountStudents" class="submenu-link">Students</a>
                        </li>

                        <li class="submenu-item">
                            <a href="/AdminController/AccountsPendingPage" class="submenu-link">Pending</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub <?= $nav_active == 'history' ? 'active' : '' ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-hourglass-split"></i>
                        <span>History</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/AdminController/StudentHistoryPage" class="submenu-link">Student</a>
                        </li>

                        <li class="submenu-item">
                            <a href="/AdminController/VisitorHistoryPage" class="submenu-link">Visitor</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">School Equipments</li>

                <li class="sidebar-item has-sub <?= $nav_active == 'school-equipment' ? 'active' : '' ?>">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-newspaper"></i>
                        <span>Equipments</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="/AdminController/EquipmentRegisterPage" class="submenu-link">Registration</a>
                        </li>

                        <li class="submenu-item">
                            <a href="/AdminController/EquipmentListPage" class="submenu-link">List</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Settings</li>

                <li class="sidebar-item  <?= $nav_active == 'profile' ? 'active' : '' ?>">
                    <a href="/AdminController/UpdateProfilePage" class='sidebar-link'>
                        <i class="bi bi-gear"></i>
                        <span>Update Profile</span>
                    </a>
                </li>

                <li class="sidebar-item <?= $nav_active == 'email' ? 'active' : '' ?>">
                    <a href="/AdminController/ChangeEmailPage" class='sidebar-link'>
                        <i class="bi bi-pen"></i>
                        <span>Change Email</span>
                    </a>
                </li>

                <li class="sidebar-item  <?= $nav_active == 'password' ? 'active' : '' ?>">
                    <a href="/AdminController/ChangePasswordPage" class='sidebar-link'>
                        <i class="bi bi-key"></i>
                        <span>Change Password</span>
                    </a>
                </li>

                <br>

                <a href="/LoginController/Logout" class="btn btn-secondary w-100"><i class="bi bi-box-arrow-in-left me-2"></i><small>Logout</small></a>
            </ul>
        </div>
    </div>
</div>
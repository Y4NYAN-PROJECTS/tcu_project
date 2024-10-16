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
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item <?= $nav_active == 'dashboard' ? 'active' : '' ?>">
                    <a href="/AdminController/DashboardPage" class='sidebar-link'>
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  <?= $nav_active == 'form' ? 'active' : '' ?>">
                    <a href="/AdminController/EntranceFormPage" class='sidebar-link'>
                        <i class="bi bi-ui-checks"></i>
                        <span>Entrance Form</span>
                    </a>
                </li>

                <li class="sidebar-item  <?= $nav_active == 'equipments' ? 'active' : '' ?>">
                    <a href="/AdminController/EquipmentsPage" class='sidebar-link'>
                        <i class="bi bi-laptop"></i>
                        <span>Equipments</span>
                    </a>
                </li>

                <li class="sidebar-item  <?= $nav_active == 'history' ? 'active' : '' ?>">
                    <a href="/AdminController/HistoryPage" class='sidebar-link'>
                        <i class="bi bi-hourglass-split"></i>
                        <span>History</span>
                    </a>
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
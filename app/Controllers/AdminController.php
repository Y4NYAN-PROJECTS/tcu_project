<?php

namespace App\Controllers;
use App\Models\DepartmentModel;
use App\Models\ProgramModel;
use App\Models\UserModel;
use App\Models\EquipmentTypeModel;
use App\Models\EquipmentStudentModel;
use App\Models\FormModel;

class AdminController extends BaseController
{
    public function DashboardPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'dashboard');

        $logged_department = session()->get('logged_department');
        $departmentModel = new DepartmentModel();
        $department = $departmentModel->where('department_id', $logged_department)->first();

        $logged_program = session()->get('logged_program');
        $programModel = new ProgramModel();
        $program = $programModel->where('program_id', $logged_program)->first();

        $data = [
            'department' => $department,
            'program' => $program,
        ];

        return view('/AdminPages/Pages/dashboard', $data);
    }

    public function HistoryPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'history');

        return view('/AdminPages/Pages/history');
    }

    public function ScanQRPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'scan');

        return view('/AdminPages/Pages/scan-qr');
    }

     public function ProgramPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'program');

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $data = [
            'programs' => $program_list,
            'departments' => $department_list
        ];

        return view('/AdminPages/Pages/program', $data);
    }

    public function ProgramCreate()
    {
        $rqst_department_id = $this->request->getPost('department_id');
        $rqst_program_acronym = $this->request->getPost('program_acronym');
        $rqst_program_title = $this->request->getPost('program_title');
        
        $departmentModel = new DepartmentModel();   
        $department = $departmentModel->where('department_id', $rqst_department_id)->first();
        $department_title = $department['department_title'];

        $programModel = new ProgramModel();
        $program_data = [
            'department_id' => $rqst_department_id,
            'department_title' => $department_title,
            'program_acronym' => $rqst_program_acronym,
            'program_title' => $rqst_program_title,
        ];
        $programModel->save($program_data);

        session()->setFlashdata('success', 'New Program Added Successfully.');
        return redirect()->to('/AdminController/ProgramPage');
    }

    public function ProgramUpdate()
    {
        $rqst_program_id = $this->request->getPost('program_id');
        $rqst_department_id = $this->request->getPost('department_id');
        $rqst_program_acronym = $this->request->getPost('program_acronym');
        $rqst_program_title = $this->request->getPost('program_title');

        $departmentModel = new DepartmentModel();
        $department = $departmentModel->where('department_id', $rqst_department_id)->first();
        $department_title = $department['department_title'];

        $programModel = new ProgramModel();
        $program_data = [
            'department_id' => $rqst_department_id,
            'department_title' => $department_title,
            'program_acronym' => $rqst_program_acronym,
            'program_title' => $rqst_program_title,
        ];

        $update = $programModel->update($rqst_program_id, $program_data);

        if ($update) {
            session()->setFlashdata('success', 'Program Updated Successfully.');
        } else {
            session()->setFlashdata('danger', 'Program Update Failed.');
        }

        return redirect()->to('/AdminController/ProgramPage');
    }

   public function ProgramDelete($program_id)
    {
        $programModel = new ProgramModel();
        
        if ($programModel->where('program_id', $program_id)->delete()) {
            session()->setFlashdata('success', 'Program Deleted Successfully.');
        } else {
            session()->setFlashdata('danger', 'Program Deletion Failed.');
        }

        return redirect()->to('/AdminController/ProgramPage');
    }
    public function DepartmentPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'department');

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $data = [
            'departments' => $department_list,
        ];

        return view('/AdminPages/Pages/department', $data);
    }

    public function DepartmentCreate()
    {
        $rqst_department_acronym = $this->request->getPost('department_acronym');
        $rqst_department_title = $this->request->getPost('department_title');

        $departmentModel = new DepartmentModel();
        $department_data = [
            'department_title' => $rqst_department_title,
            'department_acronym' => $rqst_department_acronym,
        ];
        $departmentModel->save($department_data);

        session()->setFlashdata('success', 'New Department Added Successfully.');
        return redirect()->to('/AdminController/DepartmentPage');
    }

    public function DepartmentUpdate()
    {
        $rqst_department_id = $this->request->getPost('department_id');
        $rqst_department_acronym = $this->request->getPost('department_acronym');
        $rqst_department_title = $this->request->getPost('department_title');

        $departmentModel = new DepartmentModel();
        $department_data = [
            'department_acronym' => $rqst_department_acronym,
            'department_title' => $rqst_department_title,
        ];

        $update = $departmentModel->update($rqst_department_id, $department_data);
        if ($update) {
            session()->setFlashdata('success', 'Department Updated Successfully.');
        } else {
            session()->setFlashdata('danger', 'Department Update Failed.');
        }

        session()->setFlashdata('success', 'Department Updated Successfully.');
        return redirect()->to('/AdminController/DepartmentPage');
    }

    public function DepartmentDelete($department_id)
    {
        $departmentModel = new DepartmentModel();
        
        if ($departmentModel->where('department_id', $department_id)->delete()) {
            session()->setFlashdata('success', 'Department Deleted Successfully.');
        } else {
            session()->setFlashdata('danger', 'Department Deletion Failed.');
        }

        return redirect()->to('/AdminController/DepartmentPage');
    }

    public function EquipmentPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'equipment');

        $equipmentTypeModel = new EquipmentTypeModel();
        $equipment_type_list = $equipmentTypeModel->findAll();

        $data = [
            'equipments' => $equipment_type_list,
        ];

        return view('/AdminPages/Pages/equipment-type', $data);
    }

    public function EquipmentCreate()
    {

        $rqst_equipment_name = $this->request->getPost('equipment_name');

        $equipmentTypeModel = new EquipmentTypeModel();
        $equipment_data = [
            'equipment_name' => $rqst_equipment_name,
        ];
        $equipmentTypeModel->save($equipment_data);

        session()->setFlashdata('success', 'New Department Added Successfully.');
        return redirect()->to('/AdminController/EquipmentPage');
    }

    public function EquipmentUpdate()
    {
        $rqst_equipment_id = $this->request->getPost('equipment_id');
        $rqst_equipment_name = $this->request->getPost('equipment_name');

        $equipmentTypeModel = new EquipmentTypeModel();
        $equipment_data = [
            'equipment_name' => $rqst_equipment_name,
        ];

        $update = $equipmentTypeModel->update($rqst_equipment_id, $equipment_data);
        if ($update) {
            session()->setFlashdata('success', 'Equipment Updated Successfully.');
        } else {
            session()->setFlashdata('danger', 'Equipment Update Failed.');
        }

        session()->setFlashdata('success', 'equipment Updated Successfully.');
        return redirect()->to('/AdminController/EquipmentPage');
    }

    public function EquipmentDelete($equipment_id)
    {
        $equipmentTypeModel = new EquipmentTypeModel();
        
        if ($equipmentTypeModel->where('equipment_id', $equipment_id)->delete()) {
            session()->setFlashdata('success', 'Equipment Deleted Successfully.');
        } else {
            session()->setFlashdata('danger', 'Equipment Deletion Failed.');
        }

        return redirect()->to('/AdminController/EquipmentPage');
    }

    public function UpdateProfilePage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'profile');
        return view('/AdminPages/Pages/change-profile');
    }

    public function ProfileUpdate()
    {
        $user_id = session()->get('logged_id');
        $old_first_name = session()->get('logged_firstname');
        $old_middle_name = session()->get('logged_middlename');
        $old_last_name = session()->get('logged_lastname');
        $rqst_first_name = $this->request->getPost('new_first_name');
        $rqst_middle_name = $this->request->getPost('new_middle_name');
        $rqst_last_name = $this->request->getPost('new_last_name');
        $rqst_file = $this->request->getFile('new_profile');

        $image_path = "/profilePictures";
        $directoryPath = FCPATH . $image_path;

        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $updateData = [];
        if (!empty($rqst_first_name)) {
            if ($rqst_first_name !== $old_first_name) {
                $change_first_name = $rqst_first_name;
                $updateData['first_name'] = $rqst_first_name;
                session()->set('logged_firstname', $rqst_first_name);
            }
        }

        if (!empty($rqst_middle_name)) {
            if ($rqst_middle_name !== $old_middle_name) {
                $change_middle_name = $rqst_middle_name;
                $updateData['middle_name'] = $rqst_middle_name;
                session()->set('logged_middlename', $rqst_middle_name);
            }
        }

        if (!empty($rqst_last_name)) {
            if ($rqst_last_name !== $old_last_name) {
                $change_last_name = $rqst_last_name;
                $updateData['last_name'] = $rqst_last_name;
                session()->set('logged_lastname', $rqst_last_name);
            }
        }

        if (!empty($rqst_file)) {
            if ($rqst_file->isValid()) {
                $file_extension = $rqst_file->getClientExtension();
                $new_filename = session()->get('logged_code') . '.' . $file_extension;
                $profile_path = $image_path . "/$new_filename";
                $target_file_path = $directoryPath . "/" . $new_filename;

                if (file_exists($target_file_path)) {
                    unlink($target_file_path);
                }

                $updateData['profile_path'] = $profile_path;
                $rqst_file->move($directoryPath, $new_filename);
                session()->set('logged_profile', $profile_path);
            }
        }

        $first_name = $change_first_name ?? $old_first_name;
        $middle_name = $change_middle_name ?? $old_middle_name;
        $last_name = $change_last_name ?? $old_last_name;
        $new_full_name = "$last_name, $first_name $middle_name";

        if (!empty($updateData)) {
            $updateData['full_name'] = $new_full_name;
            $userModel = new UserModel();
            if ($userModel->update($user_id, $updateData)) {
                session()->set('logged_fullname', $new_full_name);
                session()->setFlashdata('success', 'Account Updated Successfully.');
            }
        }

        return redirect()->to('/AdminController/UpdateProfilePage');
    }

    public function ChangeEmailPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'email');

        $user_id = session()->get('logged_id');
        $rqst_new_email = $this->request->getPost('new_email');
        $rqst_check = $this->request->getPost('email_check');
        $old_email = session()->get('logged_email');

        $is_email_error = false;

        if ($rqst_check) {
            $userModel = new UserModel();
            if ($rqst_new_email !== $old_email) {
                if ($userModel->update($user_id, ['email' => $rqst_new_email])) {
                    session()->setFlashdata('success', 'Change Email Successfully.');
                    session()->set('logged_email', $rqst_new_email);
                } else {
                    session()->setFlashdata('danger', 'Change Email Failed.');
                }
            } else {
                $is_email_error = true;
                session()->setFlashdata('danger', 'Change Email Failed.');
            }
        }

        $data = [
            'isPasswordError' => $is_email_error,
            'isPasswordCheck' => $rqst_check
        ];

        return view('/AdminPages/Pages/change-email', $data);
    }

    public function ChangePasswordPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'password');

        $user_id = session()->get('logged_id');
        $rqst_new = $this->request->getPost('new_password');
        $hashedPassword = password_hash($rqst_new, PASSWORD_BCRYPT);
        $rqst_currrent = $this->request->getPost('old_password');
        $rqst_check = $this->request->getPost('password_check');

        $is_password_error = false;

        if ($rqst_check) {
            $userModel = new UserModel();
            $user_data = $userModel->where('user_id', $user_id)->first();

            if (password_verify($rqst_currrent, $user_data['password'])) {
                if ($userModel->update($user_id, ['password' => $hashedPassword])) {
                    session()->setFlashdata('success', 'Change Password Successfully.');
                } else {
                    session()->setFlashdata('danger', 'Change Password Failed.');
                }
            } else {
                $is_password_error = true;
                session()->setFlashdata('danger', 'Change Password Failed.');
            }
        }

        $data = [
            'isPasswordError' => $is_password_error,
            'isPasswordCheck' => $rqst_check
        ];

        return view('/AdminPages/Pages/change-password', $data);
    }



}

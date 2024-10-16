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

    public function EntranceFormPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'form');

        $_admin_user_code = session()->get('logged_code');

        $AdminEquipmentModel = new EquipmentStudentModel;
        $_admin_equipment = $AdminEquipmentModel->where('user_code', $_admin_user_code)->findAll();

        $FormModel = new FormModel();
        $_admin_form = $FormModel->where('user_code', $_admin_user_code)->findAll();


        $_data = [
            'equipments' => $_admin_equipment,
            'adminForm' => $_admin_form,
        ];

        return view('/AdminPages/Pages/entrance-form', $_data);
    }

    public function EquipmentsPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'equipments');

        $equipmentTypeModel = new EquipmentTypeModel();
        $equipment_list = $equipmentTypeModel->findAll();

        $user_code = session()->get('logged_code');

        $adminEquipmentModel = new EquipmentStudentModel();
        $admin_equipment_list = $adminEquipmentModel->where('user_code', $user_code)->findAll();

        $_data = [
            'equipments' => $equipment_list,
            'admin_equipments' => $admin_equipment_list,
        ];

        return view('/AdminPages/Pages/equipments', $_data);
    }

    public function AdminEquipmentCreate()
    {
        $adminEquipmentModel = new EquipmentStudentModel;

        $img_path = "adminEquipments/";
        $directoryPath = FCPATH . $img_path;

        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $user_id = session()->get('logged_id');
        $user_code = session()->get('logged_code');
        // $full_name = session()->get('logged_fullname');

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!@_-?';
        $characters_length = strlen($characters);
        $admin_equipment_code = '';

        for ($i = 0; $i < 12; $i++) {
            $admin_equipment_code .= $characters[rand(0, $characters_length - 1)];
        }

        $rqst_equipment_name = $this->request->getPost('equipment_name');
        $rqst_model = $this->request->getPost('model');
        $rqst_color = $this->request->getPost('color');
        $rqst_description = $this->request->getPost('description');
        $rqst_equipment_image = $this->request->getFile('equipment_image');

        $explode = explode(':', $rqst_equipment_name);

        if ($rqst_equipment_image && $rqst_equipment_image->isValid()) {
            $file_extension = $rqst_equipment_image->getClientExtension();
            $equipment_name = $admin_equipment_code . '.' . $file_extension;
            $equipment_path = $img_path . "/$equipment_name";
            $target_file_path = $directoryPath . "/" . $equipment_name;

            if (file_exists($target_file_path)) {
                unlink($target_file_path);
            }

            $rqst_equipment_image->move($directoryPath, $equipment_name);

            $equipment_image_data = [
                'user_id' => $user_id,
                'user_code' => $user_code,
                // 'full_name' => $full_name,
                'equipment_id' => $explode[0],
                'equipment_name' => $explode[1],
                'equipment_code' => $explode[2],
                'model' => $rqst_model,
                'color' => $rqst_color,
                'description' => $rqst_description,
                'image_path' => $equipment_path,
                'student_equipment_code' => $admin_equipment_code,
            ];
            $adminEquipmentModel->save($equipment_image_data);

            session()->setFlashdata('success', 'Successfully Added the Equipment');
            return redirect()->to('/AdminController/EquipmentsPage');
        } else {
            echo "fck";
        }
    }

    public function HistoryPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'history');

        return view('/AdminPages/Pages/history');
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

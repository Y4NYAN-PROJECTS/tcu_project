<?php

namespace App\Controllers;
use App\Models\DepartmentModel;
use App\Models\ProgramModel;
use App\Models\UserModel;
use App\Models\EquipmentTypeModel;
use App\Models\EquipmentStudentModel;
use App\Models\FormModel;

class StudentController extends BaseController
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

        return view('/StudentPages/Pages/dashboard', $data);
    }

    public function EntranceFormPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'form');

        $student_user_code = session()->get('logged_code');

        $studentEquipmentModel = new EquipmentStudentModel;
        $student_equipment = $studentEquipmentModel->where('user_code', $student_user_code)->findAll();

        $formModel = new FormModel();
        $form_history = $formModel->where('user_code', $student_user_code)->findAll();

        $equipmentTypeModel = new EquipmentTypeModel();
        $equipmentTypes = $equipmentTypeModel->findAll();

        $data = [
            'equipments' => $student_equipment,
            'equipmentTypes' => $equipmentTypes,
            'studentForm' => $form_history,
        ];

        return view('/StudentPages/Pages/entrance-form', $data);
    }

    public function EntranceForm()
    {
        $user_id = session()->get('logged_id');
        $user_code = session()->get('logged_code');
        $user_full_name = session()->get('logged_fullname');

        $rqst_form_code = $this->request->getPost('form_code');
        $rqst_selected_equipments = $this->request->getPost('student_equipment');
        $rqst_equipment_count = $this->request->getPost('equipment_count');
        $rqst_qrcode_image = $this->request->getFile('qr_code_file');
        $rqst_qrcode_file_name = $this->request->getPost('qr_code_file_name');

        if ($rqst_selected_equipments) {
            $equipment_codes = [];

            foreach ($rqst_selected_equipments as $id) {
                $equipment_codes[] = htmlspecialchars($id);
            }

            $student_equipment_code = implode('|', $equipment_codes);
            $img_path = "/qrCodes";
            $directoryPath = FCPATH . $img_path;

            if (!is_dir($directoryPath)) {
                mkdir($directoryPath, 0777, true);
            }

            if ($rqst_qrcode_image && $rqst_qrcode_image->isValid()) {
                $qr_image = $rqst_qrcode_file_name;
                $qrcode_path = "$img_path/$qr_image";

                $form_data = [
                    'form_code' => $rqst_form_code,
                    'user_id' => $user_id,
                    'user_code' => $user_code,
                    'full_name' => $user_full_name,
                    'student_equipment_code' => $student_equipment_code,
                    'equipment_count' => $rqst_equipment_count,
                    'image_path' => $qrcode_path,
                ];

                $formModel = new FormModel();
                $formModel->save($form_data);
                $rqst_qrcode_image->move($directoryPath, $qr_image);
                return redirect()->back();
            }
        }
    }

    public function EquipmentsPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'equipments');

        $equipmentTypeModel = new EquipmentTypeModel();
        $equipment_list = $equipmentTypeModel->findAll();

        $user_code = session()->get('logged_code');

        $studentEquipmentModel = new EquipmentStudentModel();
        $student_equipment_list = $studentEquipmentModel->where('user_code', $user_code)->findAll();

        $data = [
            'equipments' => $equipment_list,
            'student_equipments' => $student_equipment_list,
        ];

        return view('/StudentPages/Pages/equipments', $data);
    }

    public function StudentEquipmentCreate()
    {
        $studentEquipmentModel = new EquipmentStudentModel;

        $img_path = "studentEquipments/";
        $directoryPath = FCPATH . $img_path;

        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $user_id = session()->get('logged_id');
        $user_code = session()->get('logged_code');
        $full_name = session()->get('logged_fullname');

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!@_-?';
        $characters_length = strlen($characters);
        $student_equipment_code = '';

        for ($i = 0; $i < 12; $i++) {
            $student_equipment_code .= $characters[rand(0, $characters_length - 1)];
        }

        $rqst_equipment_name = $this->request->getPost('equipment_name');
        $rqst_model = $this->request->getPost('model');
        $rqst_color = $this->request->getPost('color');
        $rqst_description = $this->request->getPost('description');
        $rqst_equipment_image = $this->request->getFile('equipment_image');
        $rqst_other_equipment = $this->request->getPost('other_equipment');

        $explode = explode(':', $rqst_equipment_name);

        if ($rqst_equipment_image && $rqst_equipment_image->isValid()) {
            $file_extension = $rqst_equipment_image->getClientExtension();
            $equipment_name = $student_equipment_code . '.' . $file_extension;
            $equipment_path = $img_path . "$equipment_name";
            $target_file_path = $directoryPath . "/" . $equipment_name;

            if (file_exists($target_file_path)) {
                unlink($target_file_path);
            }

            $rqst_equipment_image->move($directoryPath, $equipment_name);

            if($rqst_equipment_name === "other"){

                $equipment_image_data = [
                'user_id' => $user_id,
                'user_code' => $user_code,
                'full_name' => $full_name,
                'equipment_name' => $rqst_other_equipment,
                'equipment_code' => "OTHERS",
                'model' => $rqst_model,
                'color' => $rqst_color,
                'description' => $rqst_description,
                'image_path' => $equipment_path,
                'student_equipment_code' => $student_equipment_code,
            ];
            $studentEquipmentModel->save($equipment_image_data);
            } else {
                $equipment_image_data = [
                'user_id' => $user_id,
                'user_code' => $user_code,
                'full_name' => $full_name,
                'equipment_id' => $explode[0],
                'equipment_name' => $explode[1],
                'equipment_code' => $explode[2],
                'model' => $rqst_model,
                'color' => $rqst_color,
                'description' => $rqst_description,
                'image_path' => $equipment_path,
                'student_equipment_code' => $student_equipment_code,
            ];
            $studentEquipmentModel->save($equipment_image_data);
            }
            

            session()->setFlashdata('success', 'Equipment Added Successfully');
            return redirect()->to('/StudentController/EquipmentsPage');
        } else {
            echo "fck";
        }
    }

    public function HistoryPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'history');

        return view('/StudentPages/Pages/history');
    }

    public function EquipmentDetailsPage($student_equipment_code)
    {
        $student_user_code = session()->get('logged_code');

        $StudentEquipmentModel = new EquipmentStudentModel;
        $student_equipment = $StudentEquipmentModel->where('student_equipment_code', $student_equipment_code)->where('user_code', $student_user_code)->first();

        if ($student_equipment) {
            $data = ['equimentDetails' => $student_equipment];
        }

        return view('/StudentPages/Pages/details', $data);
    }

    public function UpdateProfilePage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'profile');
        return view('/StudentPages/Pages/change-profile');
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



        return redirect()->to('/StudentController/UpdateProfilePage');
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

        return view('/StudentPages/Pages/change-email', $data);
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

        return view('/StudentPages/Pages/change-password', $data);
    }



}

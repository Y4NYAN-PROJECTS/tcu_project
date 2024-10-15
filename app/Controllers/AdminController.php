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
            'adminEquipment' => $_admin_equipment,
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

}

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

        $_student_user_code = session()->get('logged_code');

        $StudentEquipmentModel = new EquipmentStudentModel;
        $_student_equipment = $StudentEquipmentModel->where('user_code', $_student_user_code)->findAll();

        $FormModel = new FormModel();
        $_student_form = $FormModel->where('user_code', $_student_user_code)->findAll();


        $_data = [
            'studentEquipment' => $_student_equipment,
            'studentForm' => $_student_form,
        ];

        session()->setFlashdata('success', 'Welcome Back!');
        return view('/StudentPages/Pages/entrance-form', $_data);
    }

     public function EntranceForm()
    {
        $_user_id = session()->get('logged_id');
        $_user_code = session()->get('logged_code');
        $_user_full_name = session()->get('logged_fullname');

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
            $FormModel = new FormModel();

            $img_path = "/assets/qr_code";
            $directoryPath = FCPATH . $img_path;

            if (!is_dir($directoryPath)) {
                mkdir($directoryPath, 0777, true);
            }

            if($rqst_qrcode_image && $rqst_qrcode_image->isValid()){
                    $_qr_image=  $rqst_qrcode_file_name;
                    $_qrcode_path = "$img_path/$_qr_image";

                    $_form_data = [
                    'form_code' => $rqst_form_code,
                    'user_id' => $_user_id,
                    'user_code' => $_user_code,
                    'full_name' => $_user_full_name,
                    'student_equipment_code' => $student_equipment_code,
                    'equipment_count' => $rqst_equipment_count,
                    'image_path' => $_qrcode_path,
                ];
                $FormModel->insert($_form_data);
                $rqst_qrcode_image->move($directoryPath, $_qr_image);
                    return redirect()->back();
            }
        }
    }

    public function EquipmentsPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'equipments');

        $EquipmentTypeModel = new EquipmentTypeModel();
        $_display_equipment = $EquipmentTypeModel->findAll();

        $_data = [
            'equip' => $_display_equipment,
        ];
        session()->setFlashdata('success', 'Welcome Back!');
        return view('/StudentPages/Pages/equipments', $_data);
    }

    public function AddEquipment()
    {
        $StudentEquipmentModel = new EquipmentStudentModel;

        $img_path = "/assets/student-equipment/";
        $directoryPath = FCPATH . $img_path;

        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $_full_name = session()->get('logged_fullname');
        $_student_code = session()->get('logged_code');
        $_student_id = session()->get('logged_id');
        $_rqst_equipment_code = $this->request->getPost('equipment_type_code');
        $_rqst_equipment_name = $this->request->getPost('equipment_name');
        $_rqst_model = $this->request->getPost('model');
        $_rqst_color = $this->request->getPost('color');
        $_rqst_description = $this->request->getPost('description');
        $_rqst_equipment_image = $this->request->getFile('equipment_image');

        $_explode = explode(':', $_rqst_equipment_name);


        if ($_rqst_equipment_image && $_rqst_equipment_image->isValid()) {
            $_equipment_name = $_rqst_equipment_image->getName();
            $_equipment_path = "$img_path/$_equipment_name";

            $_equipment_image_data = [
                'user_id' => $_student_id,
                'user_code' => $_student_code,
                'full_name' => $_full_name,
                'equipment_id' => $_explode[0],
                'equipment_name' => $_explode[1],
                'equipment_code' => $_explode[2],
                'model' => $_rqst_model,
                'color' => $_rqst_color,
                'description' => $_rqst_description,
                'image_path' => $_equipment_path,
                'student_equipment_code' => $_rqst_equipment_code,
            ];
            session()->setFlashdata('success', 'Successfully Added the Equipment');
            $StudentEquipmentModel->insert($_equipment_image_data);
            $_rqst_equipment_image->move($directoryPath, $_equipment_name);
            return redirect()->back();
        }
    }

    public function HistoryPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'history');

        return view('/StudentPages/Pages/history');
    }

    public function EquipmentDetailsPage($_student_equipment_code)
    {
        $_student_user_code = session()->get('logged_code');

        $StudentEquipmentModel = new EquipmentStudentModel;
        $_student_equipment = $StudentEquipmentModel->where('student_equipment_code', $_student_equipment_code)->where('user_code', $_student_user_code)->first();

       if ($_student_equipment) {
            $_data = ['equimentDetails' => $_student_equipment];
        }

        return view('/StudentPages/Pages/details', $_data);
    }

}

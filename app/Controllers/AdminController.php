<?php

namespace App\Controllers;
use App\Models\DepartmentModel;
use App\Models\LogsVisitorModel;
use App\Models\ProgramModel;
use App\Models\UserModel;
use App\Models\EquipmentTypeModel;
use App\Models\EquipmentStudentModel;
use App\Models\EquipmentSchoolModel;
use App\Models\LogsModel;
use Dompdf\Dompdf;
use CodeIgniter\I18n\Time;

class AdminController extends BaseController
{
    public function DashboardPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'dashboard');

        $current_date = Time::today()->toDateString();

        $logsModel = new LogsModel();
        $student_total_logs = $logsModel->where('date_created', $current_date)->countAllResults();

        $logsVisitorModel = new LogsVisitorModel();
        $visitor_total_logs = $logsVisitorModel->where('date_created', $current_date)->countAllResults();

        $total_logs = $student_total_logs + $visitor_total_logs;

        // total visitor logs = total_logs_chart
        // student logs today = student_total_logs_chart
        // visitor logs today = visitor_total_logs_chart

        $data = [
            'student_total' => $student_total_logs,
            'visitor_total' => $visitor_total_logs,
            'overall_total' => $total_logs
        ];

        return view('/AdminPages/Pages/dashboard', $data);
    }

    public function HistoryPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'history');

        $logsModel = new LogsModel();
        $logs = $logsModel->orderBy('date_created', 'asc')->findAll();

        $data = [
            'logs' => $logs
        ];

        return view('/AdminPages/Pages/history', $data);
    }

    public function LogsGeneratePDF()
    {
        $logsModel = new LogsModel();
        $logs = $logsModel->orderBy('date_created', 'asc')->findAll();

        date_default_timezone_set('Asia/Manila');
        $current_date = date('F d, Y');

        $data = [
            'logs' => $logs,
            'date' => $current_date
        ];

        $filename = "Log History [$current_date] .pdf";

        $dompdf = new Dompdf();
        $html = view('/AdminPages/Pages/pdf-logs', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($filename, ['Attachment' => false]);
    }

    public function scannedQRCode()
    {
        $scanned_qr_code_value = $this->request->getPost('scanned_qr_code_value');

        $checkStudentEquipment = new UserModel();
        $user_information = $checkStudentEquipment->where('user_code', $scanned_qr_code_value)->first();

        $studentEquipment = new EquipmentStudentModel();
        $equipment_information = $studentEquipment->where('user_code', $scanned_qr_code_value)->findAll();

        if (!$equipment_information) {
            session()->setFlashdata('danger', 'No Equipments Found.');
            return redirect()->back();
        }
        $user_id = $user_information['user_id'];
        $user_code = $user_information['user_code'];
        $full_name = $user_information['full_name'];

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters_length = strlen($characters);
        $log_code = '';

        for ($i = 0; $i < 12; $i++) {
            $log_code .= $characters[rand(0, $characters_length - 1)];
        }

        date_default_timezone_set('Asia/Manila');
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');

        $logsModel = new LogsModel();
        $logs_check = $logsModel->where('date_created', $current_date)->where('user_code', $scanned_qr_code_value)->first();
        if (!$logs_check) {
            $logs_data = [
                'log_code' => $log_code,
                'user_id' => $user_id,
                'user_code' => $user_code,
                'full_name' => $full_name,
                'time_in' => $current_time,
            ];
            $logsModel->save($logs_data);
        } else {
            $logs_id = $logs_check['logs_id'];
            $logsModel->update($logs_id, ['time_out' => $current_time]);
        }
        session()->setFlashdata('success', 'Equipment Logged Successfully .');
        return redirect()->back();
    }

    public function ScanQRCamera()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'scan');

        return view('/AdminPages/Pages/scan-qr-camera');
    }

    public function ScanQRBarcode()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'scan');
        return view('/AdminPages/Pages/scan-qr-barcode');
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

        $programModel = new ProgramModel();
        $program_data = [
            'department_id' => $rqst_department_id,
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

        $userModel = new UserModel();
        $relation_user = $userModel->where('program_id', $program_id)->findAll();

        if (!$relation_user) {
            if ($programModel->delete($program_id)) {
                session()->setFlashdata('success', 'Program Deleted Successfully.');
            } else {
                session()->setFlashdata('danger', 'Program Deletion Failed.');
            }
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

        $userModel = new UserModel();
        $relation_user = $userModel->where('department_id', $department_id)->findAll();

        $progranModel = new ProgramModel();
        $relation_program = $progranModel->where('department_id', $department_id)->findAll();

        if (!$relation_program && !$relation_user) {
            $departmentModel = new DepartmentModel();
            $departmentModel->delete($department_id);

            if ($departmentModel->delete($department_id)) {
                session()->setFlashdata('success', 'Department Deleted Successfully.');
            } else {
                session()->setFlashdata('danger', 'Department Deletion Failed.');
            }

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

    // EQUIPMENT REGISTRATION

    public function EquipmentListPage()
    {

        // [ Active Navigation ]
        session()->set('nav_active', 'school-equipment');

        $user_code = session()->get('logged_code');

        $schoolEquipmentModel = new EquipmentSchoolModel();
        $school_equipment_list = $schoolEquipmentModel->findAll();

        $data = [
            'school_equipments' => $school_equipment_list,
        ];

        return view('/AdminPages/Pages/equipment-list', $data);
    }

    public function EquipmentRegisterPage()
    {
        return view('/AdminPages/Pages/equipment-register');
    }

    public function EquipmentRegister()
    {
        $rqst_building = $this->request->getPost('building');
        $rqst_room_number = $this->request->getPost('room_number');
        $rqst_equipment_type = $this->request->getPost('equipment_type');
        $rqst_serial_number = $this->request->getPost('serial_number');
        $rqst_model = $this->request->getPost('model');
        $rqst_color = $this->request->getPost('color');
        $rqst_status = $this->request->getPost('status');
        $rqst_description = $this->request->getPost('description');
        $rqst_equipment_image = $this->request->getFile('equipment_image');

        $img_path = "/$rqst_building/$rqst_room_number/$rqst_serial_number/";
        $directoryPath = FCPATH . $img_path;

        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!@_-?';
        $characters_length = strlen($characters);
        $school_equipment_code = '';

        for ($i = 0; $i < 12; $i++) {
            $school_equipment_code .= $characters[rand(0, $characters_length - 1)];
        }

        if ($rqst_equipment_image->isValid()) {

            $file_extension = $rqst_equipment_image->getClientExtension();
            $equipment_name = $rqst_equipment_type . '.' . $file_extension;

            $equipment_path = $img_path . $equipment_name;

            $target_equipment_path = $directoryPath . '/' . $equipment_name;

            if (file_exists($target_equipment_path)) {
                unlink($target_equipment_path);
            }

            $rqst_equipment_image->move($directoryPath, $equipment_name);

            $equipmentSchoolModel = new EquipmentSchoolModel();
            $equipment_image_data = [
                'school_equipment_code' => $school_equipment_code,
                'serial_number' => $rqst_serial_number,
                'building' => $rqst_building,
                'room_number' => $rqst_room_number,
                'equipment_name' => $rqst_equipment_type,
                'brand_model' => $rqst_model,
                'color' => $rqst_color,
                'description' => $rqst_description,
                'status' => $rqst_status,
                'image_path' => $equipment_path,
            ];
            $equipmentSchoolModel->save($equipment_image_data);

            session()->setFlashdata('success', 'Equipment Registered Successfully');
            return redirect()->back();
        }
    }

    public function GeneratePDF()
    {
        $schoolEquipmentModel = new EquipmentSchoolModel();
        $equipment_list = $schoolEquipmentModel->findAll();

        $data['equipment_list'] = $equipment_list;

        $dompdf = new Dompdf();
        $html = view('/AdminPages/Pages/pdf-template', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("output.pdf", ['Attachment' => false]);
    }

    public function UpdateSchoolEquipment()
    {

        $schoolEquipmentID = $this->request->getPost('school_equipment_id');
        $updateStatus = $this->request->getPost('update_status');
        $updateDesciption = $this->request->getPost('update_description');

        $schoolEquipmentModel = new EquipmentSchoolModel();
        $data = [
            'status' => $updateStatus,
            'description' => $updateDesciption,
        ];
        $schoolEquipmentModel->update($schoolEquipmentID, $data);
        session()->setFlashdata('success', 'Equipment Updated Successfully');
        return redirect()->back();

    }

    public function ViewDetailsSchoolEquipment($school_equipment_id)
    {

        $schoolEquipmentModel = new EquipmentSchoolModel();
        $schoolEquipmentModel->where('school_equipment_id', $school_equipment_id)->first();

        return redirect()->back();

    }

    public function DeleteSchoolEquipment($school_equipment_id)
    {
        $schoolEquipmentModel = new EquipmentSchoolModel();
        $equipment = $schoolEquipmentModel->find($school_equipment_id);

        if ($equipment) {
            $schoolEquipmentModel->where('school_equipment_id', $school_equipment_id)->delete();

            $img_path = FCPATH . $equipment['image_path'];

            if (file_exists($img_path)) {
                unlink($img_path);
            }
        }

        session()->setFlashdata('success', 'Equipment Deleted Successfully.');
        return redirect()->back();
    }


    public function AccountPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'account');

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

        return view('/AdminPages/Pages/account', $data);
    }

    public function AccountsPendingPage()
    {
        // [ Active Navigation ]
        session()->set('nav_active', 'accounts');

        $userModel = new UserModel();
        $user_pending_list = $userModel->where('user_type', 2)->where('is_approve', 0)->findAll();

        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $data = [
            'pendings' => $user_pending_list,
            'departments' => $department_list,
            'programs' => $program_list,
        ];

        return view('AdminPages/Pages/accounts-pending', $data);
    }

    public function AccountApprove($user_code)
    {
        $userModel = new UserModel();
        $userModel->update($user_code, ['is_approve' => 1]);

        session()->setFlashdata('success', 'Account Approved Successfully.');
        return redirect()->to("/AdminController/AccountsPendingPage");
    }

    public function AccountDecline($user_code)
    {
        $userModel = new UserModel();
        $userModel->update($user_code, ['is_approve' => 2]);

        session()->setFlashdata('success', 'Account Declined Successfully.');
        return redirect()->to("/AdminController/AccountsPendingPage");
    }

    public function AccountStudents()
    {
        $userModel = new UserModel();
        $user_student_list = $userModel->where('user_type', 2)->where('is_approve', 1)->findAll();


        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $data = [
            'student_list' => $user_student_list,
            'departments' => $department_list,
            'programs' => $program_list,
        ];
        return view('/AdminPages/Pages/accounts-students', $data);
    }

    public function DeleteAccountStudent($student_id)
    {
        $userModel = new UserModel();
        $userModel->where('user_code', $student_id)->delete();

        session()->setFlashdata('success', 'Student Account Deleted Successfully.');
        return redirect()->back();

    }

    public function AccountAdmin()
    {
        $userModel = new UserModel();
        $user_admin_list = $userModel->where('user_type', 1)->where('is_approve', 1)->findAll();


        $departmentModel = new DepartmentModel();
        $department_list = $departmentModel->findAll();

        $programModel = new ProgramModel();
        $program_list = $programModel->findAll();

        $data = [
            'admin_list' => $user_admin_list,
            'departments' => $department_list,
            'programs' => $program_list,
        ];
        return view('/AdminPages/Pages/accounts-admin', $data);
    }

    public function DeleteAccountAdmin($admin_id)
    {
        $userModel = new UserModel();
        $userModel->where('user_code', $admin_id)->delete();

        session()->setFlashdata('success', 'Admin Account Deleted Successfully.');
        return redirect()->back();

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

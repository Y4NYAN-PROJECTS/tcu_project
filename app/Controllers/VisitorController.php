<?php

namespace App\Controllers;
use App\Models\EquipmentTypeModel;
use App\Models\EquipmentVisitorModel;
use App\Models\LogsVisitorModel;

class VisitorController extends BaseController
{
    public function EquipmentForm()
    {
        $equipmentTypeModel = new EquipmentTypeModel();
        $equipment_list = $equipmentTypeModel->findAll();

        $data = [
            'equipments' => $equipment_list,
        ];

        return view('/VisitorPages/Pages/equipment-form', $data);
    }

    public function EquipmentLog()
    {
        $rqst_first_name = $this->request->getPost('first_name');
        $rqst_last_name = $this->request->getPost('last_name');
        $full_name = "$rqst_last_name, $rqst_first_name";
        $rqst_valid_id = $this->request->getFile('valid_id_image');
        $rqst_equipment_count = $this->request->getPost('equipment_count');
        $equipment_name = $this->request->getPost('equipment_name');
        $equipment_model = $this->request->getPost('model');
        $equipment_color = $this->request->getPost('color');
        $equipment_description = $this->request->getPost('description');
        $equipment_picture = $this->request->getFile('equipment_image');
        $equipments = [];
        $valid_id_file_path = '';
        $equipment_file_path = '';

        $generateEquipmentCode = function () {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $characters_length = strlen($characters);
            $equipment_code = '';
            for ($j = 0; $j < 12; $j++) {
                $equipment_code .= $characters[rand(0, $characters_length - 1)];
            }
            return $equipment_code;
        };

        // tbl_visitor_logs
        $visitor_log_code = $generateEquipmentCode();
        $visitor_valid_id_path = "/visitorValidID";
        $visitor_valid_id_directory = FCPATH . $visitor_valid_id_path;

        if (!is_dir($visitor_valid_id_directory)) {
            mkdir($visitor_valid_id_directory, 0777, true);
        }

        if (!empty($rqst_valid_id) && $rqst_valid_id->isValid()) {
            $file_extension = $rqst_valid_id->getClientExtension();
            $valid_id_filename = $visitor_log_code . '.' . $file_extension;
            $valid_id_target_path = $visitor_valid_id_directory . "/" . $valid_id_filename;
            $valid_id_file_path = $visitor_valid_id_path . "/$valid_id_filename";

            if (file_exists($valid_id_target_path)) {
                unlink($valid_id_target_path);
            }

            if ($rqst_valid_id->move($visitor_valid_id_directory, $valid_id_filename)) {
                echo "Valid ID moved successfully to " . $valid_id_target_path;
            } else {
                echo "Failed to move valid ID.";
            }
        }

        // tbl_equipment_visitor
        $visitor_equipment_path = "/visitorEquipments";
        $visitor_equipment_directory = FCPATH . $visitor_equipment_path;

        if (!is_dir($visitor_equipment_directory)) {
            mkdir($visitor_equipment_directory, 0777, true);
        }

        $equipment_code = $generateEquipmentCode();

        // [ Equipment Picture ]
        if (!empty($equipment_picture) && $equipment_picture->isValid()) {
            $file_extension = $equipment_picture->getClientExtension();
            $equipment_filename = $equipment_code . '.' . $file_extension;
            $equipment_target_path = $visitor_equipment_directory . "/" . $equipment_filename;
            $equipment_file_path = $visitor_equipment_path . "/$equipment_filename";

            if (file_exists($equipment_target_path)) {
                unlink($equipment_target_path);
            }
            $equipment_picture->move($visitor_equipment_directory, $equipment_filename);
        }

        $equipments = [$equipment_code];
        $equipmentData = [
            'visitor_equipment_code' => $equipment_code,
            'visitor_log_code' => $visitor_log_code,
            'equipment_name' => $equipment_name,
            'model' => $equipment_model,
            'color' => $equipment_color,
            'description' => $equipment_description,
            'image_path' => $equipment_file_path ?? '',
        ];
        $equipmentVisitorModel = new EquipmentVisitorModel();
        $equipmentVisitorModel->save($equipmentData);

        // [ More equipments ]
        for ($i = 2; $i <= $rqst_equipment_count; $i++) {
            $equipment_code = $generateEquipmentCode();

            $rqst_equipment_name = $this->request->getPost("equipment_name_$i");
            $rqst_equipment_model = $this->request->getPost("model_$i");
            $rqst_equipment_color = $this->request->getPost("color_$i");
            $rqst_equipment_description = $this->request->getPost("description_$i");
            $rqst_equipment_picture = $this->request->getFile("equipment_image_$i");

            if (!empty($rqst_equipment_picture) && $rqst_equipment_picture->isValid()) {
                $file_extension = $rqst_equipment_picture->getClientExtension();
                $equipment_filename = $equipment_code . '.' . $file_extension;
                $equipment_target_path = $visitor_equipment_directory . "/" . $equipment_filename;
                $equipment_file_path = $visitor_equipment_path . "/$equipment_filename";

                if (file_exists($equipment_target_path)) {
                    unlink($equipment_target_path);
                }
                $rqst_equipment_picture->move($visitor_equipment_directory, $equipment_filename);
            }

            $equipmentData = [
                'visitor_equipment_code' => $equipment_code,
                'visitor_log_code' => $visitor_log_code,
                'equipment_name' => $rqst_equipment_name,
                'model' => $rqst_equipment_model,
                'color' => $rqst_equipment_color,
                'description' => $rqst_equipment_description,
                'image_path' => $equipment_file_path ?? '',
            ];
            $equipmentVisitorModel->save($equipmentData);

            $equipments[] = $equipment_code;
        }

        $visitor_equipment_string = implode('./', $equipments);

        $visitorLogData = [
            'visitor_log_code' => $visitor_log_code,
            'full_name' => $full_name,
            'valid_id_path' => $valid_id_file_path,
            'visitor_equipments' => $visitor_equipment_string,
        ];
        $logVisitorModel = new LogsVisitorModel();
        $logVisitorModel->save($visitorLogData);

        session()->setFlashdata('success', 'Form Submitted Successfully.');
        return redirect()->to('/VisitorController/EquipmentForm');
    }

}

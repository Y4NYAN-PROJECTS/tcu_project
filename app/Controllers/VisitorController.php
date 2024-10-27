<?php

namespace App\Controllers;
use App\Models\EquipmentTypeModel;
use App\Models\EquipmentVisitorModel;
use App\Models\UserModel;

class VisitorController extends BaseController
{
    public function EquipmentForm()
    {
        $equipmentTypeModel = new EquipmentTypeModel();
        $equipment_list = $equipmentTypeModel->findAll();

        $data = [
            'equipments' => $equipment_list,
        ];

        session()->setFlashdata('success', 'Welcome Visitor');
        return view('/VisitorPages/Pages/equipment-form', $data);
    }

    public function EquipmentLog()
    {
        $rqst_full_name = $this->request->getPost('full_name');
        $rqst_valid_id = $this->request->getPost('valid_id_image');
        $rqst_equipment_count = $this->request->getPost('equipment_count');

        $equipment_name = [$this->request->getPost('equipment_name')];
        $equipment_model = [$this->request->getPost('model')];
        $equipment_color = [$this->request->getPost('color')];
        $equipment_description = [$this->request->getPost('description')];
        $equipment_picture = [$this->request->getPost('equipment_image')];

        $image_path = "/visitorEquipments";
        $directoryPath = FCPATH . $image_path;

        // Create directory if it doesn't exist
        if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // Helper function to generate unique equipment code
        $generateEquipmentCode = function () {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!@_-?';
            $characters_length = strlen($characters);
            $equipment_code = '';
            for ($j = 0; $j < 12; $j++) {
                $equipment_code .= $characters[rand(0, $characters_length - 1)];
            }
            return $equipment_code;
        };

        // Process first equipment item (common code for single and multiple cases)
        $equipment_code = $generateEquipmentCode();

        if (!empty($rqst_valid_id) && $rqst_valid_id->isValid()) {
            $file_extension = $rqst_valid_id->getClientExtension();
            $new_filename = $equipment_code . '.' . $file_extension;
            $target_file_path = $directoryPath . "/" . $new_filename;

            // Remove old file if it exists
            if (file_exists($target_file_path)) {
                unlink($target_file_path);
            }
            $rqst_valid_id->move($directoryPath, $new_filename);
        }

        // Collect equipment data for single or multiple entries
        $equipmentData = [
            'visitor_equipment_code' => $equipment_code,
            'full_name' => $rqst_full_name,
            'valid_id_path' => $new_filename ?? '',
            'equipment_name' => $equipment_name[0],
            'model' => $equipment_model[0],
            'color' => $equipment_color[0],
            'description' => $equipment_description[0],
            'image_path' => $equipment_picture[0] ?? '',
        ];

        // Initialize model and save
        $equipmentVisitorModel = new EquipmentVisitorModel();
        $equipmentVisitorModel->save($equipmentData);

        // Process additional equipment items if more than one
        for ($i = 2; $i <= $rqst_equipment_count; $i++) {
            $equipment_code = $generateEquipmentCode();

            $rqst_equipment_name = $this->request->getPost("equipment_name_$i");
            $rqst_equipment_model = $this->request->getPost("model_$i");
            $rqst_equipment_color = $this->request->getPost("color_$i");
            $rqst_equipment_description = $this->request->getPost("description_$i");
            $rqst_equipment_picture = $this->request->getPost("equipment_image_$i");

            // Add each additional equipment entry to the data array
            $equipmentData = [
                'visitor_equipment_code' => $equipment_code,
                'full_name' => $rqst_full_name,
                'valid_id_path' => $new_filename ?? '',
                'equipment_name' => $rqst_equipment_name,
                'model' => $rqst_equipment_model,
                'color' => $rqst_equipment_color,
                'description' => $rqst_equipment_description,
                'image_path' => $rqst_equipment_picture ?? '',
            ];
            $equipmentVisitorModel->save($equipmentData);
        }

        echo 'good';
    }

}

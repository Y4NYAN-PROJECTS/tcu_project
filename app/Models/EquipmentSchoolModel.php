<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentSchoolModel extends Model
{
    protected $table = 'tbl_equipment_school';
    protected $primaryKey = 'school_equipment_id';
    protected $allowedFields = ['school_equipment_code', 'serial_number', 'building', 'room_number', 'equipment_name', 'brand_model', 'color', 'description', 'status', 'school_equipment_image_path', 'date_updated', 'date_added'];
}

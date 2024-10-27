<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentVisitorModel extends Model
{
    protected $table = 'tbl_equipment_visitor';
    protected $primaryKey = 'visitor_equipment_id';
    protected $allowedFields = ['visitor_equipment_code', 'full_name', 'valid_id_path', 'equipment_name', 'model', 'color', 'description', 'image_path', 'date_created'];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentTypeModel extends Model
{
    protected $table = 'tbl_equipment_type';
    protected $primaryKey = 'equipment_id';
    protected $allowedFields = ['equipment_code', 'equipment_name'];
}

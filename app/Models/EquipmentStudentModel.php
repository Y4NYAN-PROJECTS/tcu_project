<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentStudentModel extends Model
{
    protected $table = 'tbl_equipment_student';
    protected $primaryKey = 'student_equipment_id';
    protected $allowedFields = ['student_equipment_code', 'user_id', 'user_code', 'equipment_id', 'equipment_code', 'equipment_name', 'model', 'color', 'description', 'image_path'];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class FormModel extends Model
{
    protected $table = 'tbl_form';
    protected $primaryKey = 'form_id';
    protected $allowedFields = ['form_code', 'user_id', 'user_code', 'full_name', 'student_equipment_code', 'equipment_count'];
}

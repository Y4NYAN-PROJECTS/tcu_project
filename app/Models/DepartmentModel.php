<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'tbl_department';
    protected $primaryKey = 'department_id';
    protected $allowedFields = ['department_code', 'department_acronym', 'department_title', 'date_created'];
}

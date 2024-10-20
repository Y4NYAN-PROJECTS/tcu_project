<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table = 'tbl_program';
    protected $primaryKey = 'program_id';
    protected $allowedFields = ['department_id', 'program_code', 'program_acronym', 'program_title', 'date_created'];
}

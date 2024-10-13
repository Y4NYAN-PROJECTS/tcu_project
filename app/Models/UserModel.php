<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_code', 'full_name', 'first_name', 'last_name', 'middle_name', 'department_id', 'department_code',' program_id', 'program_code', 'email', 'username', 'password', 'user_type', 'date_created'];

}

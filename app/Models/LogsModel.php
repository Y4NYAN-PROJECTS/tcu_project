<?php

namespace App\Models;

use CodeIgniter\Model;

class LogsModel extends Model
{
    protected $table = 'tbl_logs';
    protected $primaryKey = 'logs_id';
    protected $allowedFields = ['log_code', 'user_type', 'user_id', 'user_code', 'full_name', 'equipments_name', 'equipments_code'];
}

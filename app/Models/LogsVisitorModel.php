<?php

namespace App\Models;

use CodeIgniter\Model;

class LogsVisitorModel extends Model
{
    protected $table = 'tbl_logs_visitor';
    protected $primaryKey = 'visitor_log_id';
    protected $allowedFields = ['visitor_log_code', 'full_name', 'valid_id_path', 'visitor_equipments', 'terms_and_condition', 'date_created'];
}

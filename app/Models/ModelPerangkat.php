<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPerangkat extends Model
{
    protected $table = 'tbl_perangkat';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 'jabatan'
    ];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

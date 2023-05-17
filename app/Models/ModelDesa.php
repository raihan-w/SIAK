<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDesa extends Model
{
    protected $table = 'tbl_desa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kode_desa', 'desa', 'kecamatan', 'kabupaten', 'provinsi', 'kode_pos', 'alamat', 'logo'
    ];
    protected $useAutoIncrement = true;
}

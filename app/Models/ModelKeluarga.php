<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKeluarga extends Model
{
    protected $table = 'tbl_keluarga';
    protected $primaryKey = 'no_kk';
    protected $allowedFields = [
        'no_kk', 'alamat', 'rt', 'rw'
    ];
}

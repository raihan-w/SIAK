<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKependudukan extends Model
{
    protected $table = 'tbl_penduduk';
    protected $primaryKey = 'nik';
    protected $allowedFields = [
        'nik', 'kk', 'nama', 'pob', 'dob', 'gender', 'goldar', 'agama', 'pendidikan', 'pekerjaan', 'perkawinan', 'ayah', 'ibu', 'shdk', 'status'
    ];
}

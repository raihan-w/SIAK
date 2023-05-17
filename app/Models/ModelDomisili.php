<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDomisili extends Model
{
    protected $table = 'srt_domisili';
    protected $primaryKey = 'nomor';
    protected $allowedFields = [
        'nomor', 'nik', 'no_pengantar', 'tgl_pengantar', 'keterangan', 'domisili', 'penandatangan'
    ];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

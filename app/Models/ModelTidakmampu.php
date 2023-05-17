<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTidakmampu extends Model
{
    protected $table = 'srt_tidakmampu';
    protected $primaryKey = 'nomor';
    protected $allowedFields = [
        'nomor', 'nik', 'domisili', 'no_pengantar', 'tgl_pengantar', 'keterangan', 'penandatangan'
    ];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

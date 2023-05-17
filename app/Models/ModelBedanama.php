<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBedanama extends Model
{
    protected $table = 'srt_bedanama';
    protected $primaryKey = 'nomor';
    protected $allowedFields = [
        'nomor', 'nik', 'keterangan', 'penandatangan'
    ];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

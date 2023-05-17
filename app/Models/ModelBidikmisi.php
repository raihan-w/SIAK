<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBidikmisi extends Model
{
    protected $table = 'srt_bidikmisi';
    protected $primaryKey = 'nomor';
    protected $allowedFields = [
        'nomor', 'kk', 'nik_ort', 'nik_ank', 'penghasilan', 'penandatangan'
    ];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

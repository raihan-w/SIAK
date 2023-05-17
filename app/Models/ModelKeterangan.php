<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKeterangan extends Model
{
    protected $table = 'srt_keterangan';
    protected $primaryKey = 'nomor';
    protected $allowedFields = [
        'nomor', 'nik', 'keperluan', 'keterangan', 'due_date', 'penandatangan'
    ];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

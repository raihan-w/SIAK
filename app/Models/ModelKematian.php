<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKematian extends Model
{
    protected $table = 'srt_kematian';
    protected $primaryKey = 'nomor';
    protected $allowedFields = [
        'nomor', 'nik_pemohon', 'nik_meninggal', 'domisili', 'keperluan','keterangan', 'due_date', 'penandatangan'
    ];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

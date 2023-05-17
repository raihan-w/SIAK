<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelOutgoing extends Model
{
    protected $table = 'srt_keluar';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'no_srt', 'pemohon', 'perihal', 'keterangan', 'lampiran'
    ];
    
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDokumen extends Model
{
    protected $table = 'tbl_dokumen';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'pemilik', 'dokumen', 'file', 'deskripsi'
    ];
    protected $useAutoIncrement = true;
}

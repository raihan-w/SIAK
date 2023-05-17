<?php

namespace App\Controllers;

use App\Models\ModelKependudukan;

class Autofill extends BaseController
{
    protected $penduduk;
    public function __construct()
    {
        $this->penduduk = new ModelKependudukan();   
    }

    public function get_nik()
    {
        if ($this->request->isAJAX()) {
            $id = service('request')->getPost('id');
            $this->penduduk->join('tbl_keluarga', 'tbl_keluarga.no_kk = tbl_penduduk.kk');
            $data = $this->penduduk->find($id);
            echo json_encode($data);
        }
    }

    public function get_kk()
    {
        if ($this->request->isAJAX()) {
            $id = service('request')->getPost('id');
            $this->penduduk->select('nik, nama');
            $this->penduduk->join('tbl_keluarga', 'tbl_keluarga.no_kk = tbl_penduduk.kk');
            $this->penduduk->where('kk', $id);
            $data = $this->penduduk->findAll();
            echo json_encode($data);
        }
    }
}

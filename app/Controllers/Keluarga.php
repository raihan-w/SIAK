<?php

namespace App\Controllers;

use App\Models\ModelKeluarga;
use App\Models\ModelKependudukan;

class Keluarga extends BaseController
{
    protected $penduduk, $keluarga;
    public function __construct()
    {
        $this->penduduk     = new ModelKependudukan();
        $this->keluarga     = new ModelKeluarga();
    }

    public function index()
    {
        return view('keluarga/keluarga');
    }

    public function getData()
    {
        if ($this->request->isAJAX()) {
            $this->keluarga->select('*, count(kk) as jml, nama');
            $this->keluarga->join('tbl_penduduk', 'tbl_penduduk.kk = tbl_keluarga.no_kk', 'LEFT');
            $this->keluarga->groupBy('no_kk');
            $data['keluarga'] = $this->keluarga->findAll();

            $msg = [
                'data' => view('keluarga/view_data', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function kartu($id)
    {
        $this->penduduk->join('tbl_keluarga', 'tbl_keluarga.no_kk = tbl_penduduk.kk');
        $this->penduduk->join('tbl_pendidikan', 'tbl_pendidikan.id = tbl_penduduk.pendidikan');
        $this->penduduk->where('kk', $id);
        $this->penduduk->orderBy('shdk', 'desc');
        $data = [
            'kartu' => $this->keluarga->find($id),
            'list' => $this->penduduk->findAll()
        ];

        return view('keluarga/kartu_keluarga', $data);
    }

    public function update_form()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = [
                'data' => $this->keluarga->find($id)
            ];

            $msg = [
                'success' => view('keluarga/update_modal', $data),
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('no_kk');
            $data = array(
                'alamat' => $this->request->getPost('alamat'),
                'rt' => $this->request->getPost('rt'),
                'rw' => $this->request->getPost('rw'),
            );
            $this->keluarga->update($id, $data);

            $msg = [
                'success' => 'Biodata berhasil diperbarui',
            ];
            echo json_encode($msg);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $this->keluarga->delete($id);
            
            $msg = [
                'success' => true
            ];
            echo json_encode($msg);
        }
    }
}

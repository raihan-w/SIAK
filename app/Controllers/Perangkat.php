<?php

namespace App\Controllers;

use App\Models\ModelPerangkat;

class Perangkat extends BaseController
{
    protected $perangkat;
    public function __construct()
    {
        $this->perangkat    = new ModelPerangkat();
    }

    public function index()
    {
        return view('perangkat/perangkat');
    }

    public function getData()
    {
        if ($this->request->isAJAX()) {
            $data['perangkat'] = $this->perangkat->findAll();
            $msg = [
                'data' => view('perangkat/view_data', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function add_form()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('perangkat/add_modal')
            ];
            echo json_encode($msg);
        }
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'nama'  => [
                    'rules' => 'required',
                    'errors'    => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'jabatan'   => [
                    'rules' => 'required',
                    'errors'    => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ]
            ])) {
                $msg = [
                    'error' => [
                        'nama' => $this->validator->getError('nama'),
                        'jabatan' => $this->validator->getError('jabatan'),
                    ]
                ];
            } else {
                $this->perangkat->insert([
                    'nama'  => $this->request->getPost('nama'),
                    'jabatan'  => $this->request->getPost('jabatan'),
                ]);
                $msg = [
                    'success' => 'Data perangkat desa berhasil tersimpan',
                ];
            }
            echo json_encode($msg);
        }
    }

    public function update_form()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data['row'] = $this->perangkat->find($id);
            $msg = [
                'success' => view('perangkat/update_modal', $data),
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = array(
                'nama' => $this->request->getPost('nama'),
                'jabatan' => $this->request->getPost('jabatan'),
            );
            $this->perangkat->update($id, $data);
            $msg = [
                'success' => 'Data perangkat desa berhasil diperbarui',
            ];
            echo json_encode($msg);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $this->perangkat->delete($id);
            $msg = [
                'success' => true,
            ];
            echo json_encode($msg);
        }
    }
}

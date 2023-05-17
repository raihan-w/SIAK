<?php

namespace App\Controllers;

use App\Models\ModelDokumen;
use App\Models\ModelKependudukan;

class Dokumen extends BaseController
{
    protected $dokumen, $penduduk;
    public function __construct()
    {
        $this->dokumen = new modelDokumen();
        $this->penduduk     = new ModelKependudukan();
    }

    public function upload_form()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data['doc'] = $this->penduduk->find($id);
            $msg = [
                'data' => view('penduduk/upload_modal', $data),
            ];
            echo json_encode($msg);
        }
    }

    public function upload()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                'file' => [
                    'rules' => 'uploaded[file]|max_size[file,2048]|mime_in[file,application/pdf]|ext_in[file,pdf]',
                    'errors' => [
                        'uploaded' => 'tidak ada file yang diunggah',
                        'max_size' => 'ukuran file tidak boleh lebih dari 2mb',
                        'mime_in' => 'unggah file berupa .pdf',
                    ]
                ]
            ]);

            if (!$validate) {
                $msg = [
                    'error' => [
                        'file' => $this->validator->getError('file')
                    ]
                ];
            } else {
                $file = $this->request->getFile('file');
                $fileName = $file->getName();
                $file->move('document');

                $data = array(
                    'pemilik' => $this->request->getPost('pemilik'),
                    'dokumen' => $this->request->getPost('dokumen'),
                    'file' => $fileName,
                    'deskripsi' => $this->request->getPost('deskripsi')
                );
                $this->dokumen->insert($data);

                $msg = [
                    'success' => 'Dokumen berhasil diunggah'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function download($id)
    {
        $data = $this->dokumen->find($id);
        return $this->response->download('document/' . $data['file'], null);
    }

    public function unlink()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = $this->dokumen->find($id);
            unlink('document/' . $data['file']);
            $this->dokumen->delete($id);

            $msg = [
                'success' => true
            ];

            echo json_encode($msg);
        }
    }
}

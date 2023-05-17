<?php

namespace App\Controllers;

use App\Models\ModelDesa;
use App\Models\ModelKeluarga;
use App\Models\ModelKependudukan;

class Home extends BaseController
{
    protected $desa, $penduduk, $keluarga;
    public function __construct()
    {
        $this->desa = new ModelDesa();
        $this->penduduk = new ModelKependudukan();
        $this->keluarga = new ModelKeluarga();
    }

    public function index()
    {
        $data = [
            'jml_kk' => $this->keluarga->countAll(),
            'jml_penduduk' => $this->penduduk->countAll(),
            'jml_lk' => $this->penduduk->where('gender', 'Laki-laki')->countAllResults(),
            'jml_pr' => $this->penduduk->where('gender', 'Perempuan')->countAllResults(),
        ];
        return view('home/dashboard', $data);
    }

    public function profile()
    {
        if ($this->request->isAJAX()) {
            $data['profile'] = $this->desa->first();
            $msg = [
                'data' => view('home/profile', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function setting()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data['row'] = $this->desa->find($id);
            $msg = [
                'data' => view('home/setting_modal', $data),
            ];
            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $data = array(
                'kode_desa' => $this->request->getPost('kode_desa'),
                'desa' => $this->request->getPost('desa'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'kabupaten' => $this->request->getPost('kabupaten'),
                'provinsi' => $this->request->getPost('provinsi'),
                'kode_pos' => $this->request->getPost('kode_pos'),
                'alamat' => $this->request->getPost('alamat'),
            );
            $this->desa->update($id, $data);
            $msg = [
                'success' => 'Profil desa berhasil diperbarui'
            ];
            echo json_encode($msg);
        }
    }

    public function upload()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data['row'] = $this->desa->find($id);
            $msg = [
                'data' => view('home/upload_modal', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $oldLogo = $this->request->getVar('oldLogo');
            $validate = $this->validate([
                'logo' => [
                    'label' => 'Upload logo',
                    'rules' => 'uploaded[logo]|is_image[logo]|mime_in[logo,image/png,image/jpeg,image/jpg]|max_size[logo,2048]|',
                    'errors' => [
                        'uploaded' => 'tidak ada gambar yang diunggah',
                        'max_size' => 'ukuran gambar tidak boleh lebih dari 2mb',
                        'mime_in' => 'extension file yang diperbolehkan .png .jpeg atau .jpg',
                    ]
                ]
            ]);

            if (!$validate) {
                $msg = [
                    'error' => [
                        'logo' => $this->validator->getError('logo')
                    ]
                ];
            } else {
                $fileLogo = $this->request->getFile('logo');
                $fileName = $fileLogo->getName();
                $fileLogo->move('assets/images');
                if ($fileName != 'default.png') {
                    unlink('assets/images/' . $oldLogo);
                }
                $this->desa->update($id, ['logo' => $fileName]);
                $msg = [
                    'success' => 'Logo berhasil diperbarui',
                ];
            }

            echo json_encode($msg);
        }
    }
}

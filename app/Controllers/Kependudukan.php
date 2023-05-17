<?php

namespace App\Controllers;

use App\Models\ModelDokumen;
use App\Models\ModelKeluarga;
use App\Models\ModelKependudukan;
use App\Models\ModelPendidikan;

class Kependudukan extends BaseController
{
    protected $dokumen, $penduduk, $pendidikan, $keluarga;
    public function __construct()
    {
        $this->dokumen      = new ModelDokumen();
        $this->penduduk     = new ModelKependudukan();
        $this->pendidikan   = new ModelPendidikan();
        $this->keluarga     = new ModelKeluarga();
    }

    public function index()
    {
        return view('penduduk/penduduk');
    }

    public function getData()
    {
        $this->penduduk->select('*, timestampdiff(year, tbl_penduduk.dob, curdate()) as age');
        $data['penduduk'] = $this->penduduk->findAll();
        $msg = [
            'data' => view('penduduk/view_data', $data)
        ];

        echo json_encode($msg);
    }

    public function biodata($id)
    {
        $this->penduduk->select('*, timestampdiff(year, tbl_penduduk.dob, curdate()) as age');
        $this->penduduk->join('tbl_pendidikan', 'tbl_pendidikan.id = tbl_penduduk.pendidikan');
        $this->dokumen->join('tbl_penduduk', 'tbl_penduduk.nik = tbl_dokumen.pemilik');
        $data = [
            'bio'   => $this->penduduk->find($id),
            'doc'   => $this->dokumen->findAll()
        ];
        return view('penduduk/biodata', $data);
    }

    public function create()
    {
        $data = [
            'pendidikan' => $this->pendidikan->findAll()
        ];
        return view('penduduk/create', $data);
    }

    public function insert()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                'nik' => [
                    'rules' => 'required|is_unique[tbl_penduduk.nik]|integer',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar',
                        'integer' => 'Masukan merupakan nomor induk kependudukan',
                    ]
                ],
                'kk' => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'integer' => 'Masukan merupakan nomor kartu keluarga',
                    ]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'ayah' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'ibu' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'status' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'kewarganegaraan tidak boleh kosong',
                    ]
                ],
            ]);

            if (!$validate) {
                $msg = [
                    'errors' => [
                        'rules' => $this->validator->getErrors()
                    ]
                ];
            } else {
                $this->keluarga->ignore(true)->insert([
                    'no_kk' => $this->request->getPost('kk'),
                    'alamat' => $this->request->getPost('alamat'),
                    'rt' => $this->request->getPost('rt'),
                    'rw' => $this->request->getPost('rw'),
                ]);
                $this->penduduk->insert([
                    'kk' => $this->request->getPost('kk'),
                    'nik' => $this->request->getPost('nik'),
                    'nama' => $this->request->getPost('nama'),
                    'pob' => $this->request->getPost('pob'),
                    'dob' => $this->request->getPost('dob'),
                    'gender' => $this->request->getPost('gender'),
                    'goldar' => $this->request->getPost('goldar'),
                    'ayah' => $this->request->getPost('ayah'),
                    'ibu' => $this->request->getPost('ibu'),
                    'agama' => $this->request->getPost('agama'),
                    'pendidikan' => $this->request->getPost('pendidikan'),
                    'pekerjaan' => $this->request->getPost('pekerjaan'),
                    'perkawinan' => $this->request->getPost('perkawinan'),
                    'shdk' => $this->request->getPost('shdk'),
                    'status' => $this->request->getPost('status'),
                ]);
                $msg = [
                    'success' => 'Data penduduk berhasil ditambahkan'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function update_form()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data = [
                'bio' => $this->penduduk->find($id),
                'pendidikan' => $this->pendidikan->findAll()
            ];

            $msg = [
                'data' => view('penduduk/update_modal', $data),
            ];

            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('nik');
            $data = array(
                'kk' => $this->request->getPost('kk'),
                'nama' => $this->request->getPost('nama'),
                'pob' => $this->request->getPost('pob'),
                'dob' => $this->request->getPost('dob'),
                'gender' => $this->request->getPost('gender'),
                'goldar' => $this->request->getPost('goldar'),
                'ayah' => $this->request->getPost('ayah'),
                'ibu' => $this->request->getPost('ibu'),
                'agama' => $this->request->getPost('agama'),
                'pendidikan' => $this->request->getPost('pendidikan'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'perkawinan' => $this->request->getPost('perkawinan'),
                'shdk' => $this->request->getPost('shdk'),
                'status' => $this->request->getPost('status'),
            );
            $this->penduduk->update($id, $data);
            $msg = [
                'success' => 'Biodata berhasil diperbarui',
            ];
            echo json_encode($msg);
        } else {
            exit('Permohonan tidak dapat diproses');
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $this->penduduk->delete($id);
            $msg = [
                'success' => true
            ];
            echo json_encode($msg);
        }
    }

    public function import_form()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('penduduk/import_modal')
            ];
            echo json_encode($msg);
        }
    }

    public function import()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                'file-excel' => [
                    'rules' => 'uploaded[file-excel]|ext_in[file-excel,xlsx,xls,xml]|',
                    'errors' => [
                        'uploaded' => 'Unggah file yang diperlukan',
                        'ext_in' => 'File tidak memiliki ekstensi yang valid'
                    ]
                ]
            ]);

            if (!$validate) {
                $msg = [
                    'error' => [
                        'file' => $this->validator->getError('file-excel'),
                    ]
                ];
            } else {
                $file = $this->request->getFile('file-excel');
                $extension = $file->getClientExtension();
                if ($extension == 'xlsx' || $extension == 'xls' || $extension == 'xml') {
                    if ($extension == 'xls') {
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                    } elseif ($extension == 'xml') {
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xml();
                    } else {
                        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    }
                    $spreadsheet = $reader->load($file);
                    $data = $spreadsheet->getActiveSheet()->toArray();

                    foreach ($data as $key => $row) {
                        if ($key == 0) {
                            continue;
                        }

                        $keluarga = [
                            'no_kk'  => $row[2],
                            'alamat' => $row[16],
                            'rt'     => $row[17],
                            'rw'     => $row[18],
                        ];
                        $this->keluarga->ignore(true)->insert($keluarga);

                        if ($row[9] == 'Tidak/Belum Sekolah' || $row[9] == 'Tidak Sekolah' || $row[9] == 'Belum Sekolah') {
                            $pendidikan = 1;
                        } elseif ($row[9] == 'Belum Tamat SD/Sederajat') {
                            $pendidikan = 2;
                        } elseif ($row[9] == 'Tamat SD/Sederajat' || $row[9] == 'Paket A') {
                            $pendidikan = 3;
                        } elseif ($row[9] == 'SLTP/Sederajat' || $row[9] == 'Paket B') {
                            $pendidikan = 4;
                        } elseif ($row[9] == 'SLTA/Sederajat' || $row[9] == 'SLTA' || $row[9] == 'Paket C') {
                            $pendidikan = 5;
                        } elseif ($row[9] == 'Diploma I/II' || $row[9] == 'Diploma I' || $row[9] == 'Diploma II') {
                            $pendidikan = 6;
                        } elseif ($row[9] == 'Akademi/Diploma III/Sarjana Muda' || $row[9] == 'Diploma III' || $row[9] == 'Sarjana Muda') {
                            $pendidikan = 7;
                        } elseif ($row[9] == 'Diploma IV/Strata I' || $row[9] == 'Diploma IV' || $row[9] == 'Strata I') {
                            $pendidikan = 8;
                        } elseif ($row[9] == 'Strata II' || $row[9] == 'S-2' || $row[9] == 'S2') {
                            $pendidikan = 9;
                        } elseif ($row[9] == 'Strata III' || $row[9] == 'S-3' || $row[9] == 'S3') {
                            $pendidikan = 10;
                        }

                        $penduduk = [
                            'nik'   => $row[1],
                            'kk'    => $row[2],
                            'nama'  => $row[3],
                            'gender' => $row[4],
                            'pob'   => $row[5],
                            'dob'   => $row[6],
                            'agama' => $row[7],
                            'goldar' => $row[8],
                            'pendidikan' => $pendidikan,
                            'pekerjaan'  => $row[10],
                            'perkawinan' => $row[11],
                            'shdk'  => $row[12],
                            'status' => $row[13],
                            'ayah'  => $row[14],
                            'ibu'   => $row[15],
                        ];
                        $this->penduduk->ignore(true)->insert($penduduk);
                    }
                }

                $msg = [
                    'success' => 'Data penduduk berhasil diunggah',
                ];
            }

            echo json_encode($msg);
        }
    }
}

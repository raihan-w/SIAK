<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\ModelDesa;
use App\Models\ModelPerangkat;
use App\Models\ModelOutgoing;
use App\Models\ModelBedanama;
use App\Models\ModelBidikmisi;
use App\Models\ModelDomisili;
use App\Models\ModelKeterangan;
use App\Models\ModelKematian;
use App\Models\ModelPengantar;
use App\Models\ModelTidakmampu;

class Persuratan extends BaseController
{
    protected $dompdf, $desa, $perangkat;
    protected $outgoing, $bedanama, $bidikmisi, $domisili, $keterangan, $kematian, $pengantar, $tidakmampu;
    public function __construct()
    {
        $this->dompdf    = new Dompdf();
        $this->desa      = new ModelDesa();
        $this->perangkat = new ModelPerangkat();
        $this->outgoing  = new ModelOutgoing();
        $this->bedanama  = new ModelBedanama();
        $this->bidikmisi = new ModelBidikmisi();
        $this->domisili  = new ModelDomisili();
        $this->keterangan = new ModelKeterangan();
        $this->kematian = new ModelKematian();
        $this->pengantar = new ModelPengantar();
        $this->tidakmampu = new ModelTidakmampu();
    }

    public function index()
    {
        return view('persuratan/outgoing');
    }

    public function outgoing()
    {
        if ($this->request->isAJAX()) {
            $data['outgoing'] = $this->outgoing->findAll();

            $msg = [
                'data' => view('persuratan/view_outgoing', $data),
            ];
            echo json_encode($msg);
        };
    }

    public function archive($id)
    {
        $data['outgoing'] = $this->outgoing->find($id);
        return view('persuratan/archive', $data);
    }

    public function upload_form()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $data['outgoing'] = $this->outgoing->find($id);
            $msg = [
                'success' => view('persuratan/upload_modal', $data),
            ];
            echo json_encode($msg);
        }
    }

    public function upload()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $validate = $this->validate([
                'lampiran'   => [
                    'rules' => 'uploaded[lampiran]|max_size[lampiran,2048]|ext_in[lampiran,pdf]',
                    'errors' => [
                        'uploaded' => 'Unggah file diperlukan',
                        'max_size' => 'Ukuran file maksimal 2mb',
                        'ext_in' => 'Extension file yang diperbolehkan .pdf',
                    ]
                ],
            ]);

            if (!$validate) {
                $msg = [
                    'error' => [
                        'lampiran' => $this->validator->getError('lampiran')
                    ]
                ];
            } else {
                $lampiran = $this->request->getFile('lampiran');
                $fileName = $lampiran->getName();
                $lampiran->move('attachment');

                $this->outgoing->update($id, ['lampiran' => $fileName]);

                $msg = [
                    'success' => 'Dokumen berhasil diunggah'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function unlink($id)
    {
        $lampiran = $this->outgoing->find($id);
        unlink('attachment/' . $lampiran['lampiran']);
        $this->outgoing->update($id, ['lampiran' => null]);
        return redirect()->back();
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            $lampiran = $this->outgoing->find($id);
            if ($lampiran['lampiran'] != null) {
                unlink('attachment/' . $lampiran['lampiran']);
            }

            $msg = [
                'success' => true
            ];

            if ($lampiran['perihal'] == 'Beda Nama') {
                $this->bedanama->delete($lampiran['no_srt']);
            } elseif ($lampiran['perihal'] == 'Bidik Misi') {
                $this->bidikmisi->delete($lampiran['no_srt']);
            } elseif ($lampiran['perihal'] == 'Domisili') {
                $this->domisili->delete($lampiran['no_srt']);
            } elseif ($lampiran['perihal'] == 'Keterangan') {
                $this->keterangan->delete($lampiran['no_srt']);
            } elseif ($lampiran['perihal'] == 'Kematian') {
                $this->kematian->delete($lampiran['no_srt']);
            } elseif ($lampiran['perihal'] == 'Pengantar') {
                $this->pengantar->delete($lampiran['no_srt']);
            } elseif ($lampiran['perihal'] == 'Keterangan Tidak Mampu') {
                $this->tidakmampu->delete($lampiran['no_srt']);
            }
            $this->outgoing->delete($id);

            echo json_encode($msg);
        } else {
            exit('Permohonan tidak dapat diproses');
        }
    }

    public function bedanama()
    {
        $data = [
            'perangkat' => $this->perangkat->findAll(),
        ];
        return view('persuratan/form_bedanama', $data);
    }

    public function generate_bedanama()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                'nomor' => [
                    'rules' => 'required|is_unique[srt_bedanama.nomor]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'nik'   => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'form pemohon harus diisi',
                        'integer' => 'masukan merupakan nomor induk kependudukan',
                    ]
                ],
                'penandatangan' => [
                    'rulse' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
            ]);

            if (!$validate) {
                $msg = [
                    'error' => [
                        'nomor' => $this->validator->getError('nomor'),
                        'nik' => $this->validator->getError('nik'),
                        'penandatangan' => $this->validator->getError('penandatangan'),
                    ]
                ];
            } else {
                $this->bedanama->insert([
                    'nomor' => $this->request->getPost('nomor'),
                    'nik' => $this->request->getPost('nik'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'penandatangan' => $this->request->getPost('penandatangan')
                ]);

                $this->outgoing->insert([
                    'no_srt' => $this->request->getPost('nomor'),
                    'pemohon' => $this->request->getPost('nama'),
                    'perihal' => $this->request->getPost('perihal'),
                    'keterangan' => $this->request->getPost('keterangan')
                ]);

                $msg = [
                    'success' => 'Surat keterangan beda nama berhasil dibuat'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function print_bedanama()
    {
        $id = $this->request->getVar('no-srt');
        $this->bedanama->select('srt_bedanama.*, tbl_penduduk.*, alamat, tbl_perangkat.nama as nama_ttd, jabatan');
        $this->bedanama->join('tbl_penduduk', 'tbl_penduduk.nik = srt_bedanama.nik');
        $this->bedanama->join('tbl_keluarga', 'tbl_keluarga.no_kk = tbl_penduduk.kk');
        $this->bedanama->join('tbl_perangkat', 'tbl_perangkat.id = srt_bedanama.penandatangan');

        $data = [
            'desa' => $this->desa->first(),
            'data' => $this->bedanama->find($id)
        ];
        $html = view('surat/bedanama', $data);

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream($id . '.pdf', array(
            "Attachment" => false
        ));
    }

    public function bidikmisi()
    {
        $data = [
            'perangkat' => $this->perangkat->findAll(),
        ];
        return view('persuratan/form_bidikmisi', $data);
    }

    public function generate_bidikmisi()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                'nomor' => [
                    'rules' => 'required|is_unique[srt_bidikmisi.nomor]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'nik_ort'   => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'form orang tua harus diisi',
                        'integer' => 'masukan merupakan nomor induk kependudukan',
                    ]
                ],
                'nik_ank'   => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'form anak harus diisi',
                        'integer' => 'masukan merupakan nomor induk kependudukan',
                    ]
                ],
                'penghasilan' => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'integer' => 'Masukan merupakan angka',
                    ]
                ],
                'penandatangan' => [
                    'rulse' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
            ]);

            if (!$validate) {
                $msg = [
                    'error' => [
                        'nomor' => $this->validator->getError('nomor'),
                        'kk' => $this->validator->getError('kk'),
                        'nik_ort' => $this->validator->getError('nik_ort'),
                        'nik_ank' => $this->validator->getError('nik_ank'),
                        'penghasilan' => $this->validator->getError('penghasilan'),
                        'penandatangan' => $this->validator->getError('penandatangan'),
                    ]
                ];
            } else {
                $this->bidikmisi->insert([
                    'nomor' => $this->request->getPost('nomor'),
                    'nik_ort' => $this->request->getPost('nik_ort'),
                    'nik_ank' => $this->request->getPost('nik_ank'),
                    'penghasilan' => $this->request->getPost('penghasilan'),
                    'penandatangan' => $this->request->getPost('penandatangan'),
                ]);

                $this->outgoing->insert([
                    'no_srt' => $this->request->getPost('nomor'),
                    'pemohon' => $this->request->getPost('nama_ort'),
                    'perihal' => $this->request->getPost('perihal'),
                ]);

                $msg = [
                    'success' => 'Surat keterangan bidik misi berhasil dibuat'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function print_bidikmisi()
    {
        $id = $this->request->getVar('no-srt');
        $this->bidikmisi->select('srt_bidikmisi.*, tbl_perangkat.nama as nama_ttd, jabatan, alamat');
        $this->bidikmisi->select('ortu.nama as nama_ort, ortu.pob as pob_ort, ortu.dob as dob_ort, ortu.pekerjaan as pkj_ort, ortu.perkawinan as perkawinan_ort');
        $this->bidikmisi->select('anak.nama as nama_ank, anak.pob as pob_ank, anak.dob as dob_ank, anak.pekerjaan as pkj_ank, anak.perkawinan as perkawinan_ank');
        $this->bidikmisi->join('tbl_penduduk as ortu', 'ortu.nik = srt_bidikmisi.nik_ort');
        $this->bidikmisi->join('tbl_penduduk as anak', 'anak.nik = srt_bidikmisi.nik_ank');
        $this->bidikmisi->join('tbl_keluarga', 'tbl_keluarga.no_kk = srt_bidikmisi.kk');
        $this->bidikmisi->join('tbl_perangkat', 'tbl_perangkat.id = srt_bidikmisi.penandatangan');

        $data = [
            'desa' => $this->desa->first(),
            'data' => $this->bidikmisi->find($id)
        ];
        $html = view('surat/bidikmisi', $data);

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream($id . '.pdf', array(
            "Attachment" => false
        ));
    }

    public function domisili()
    {
        $data = [
            'perangkat' => $this->perangkat->findAll(),
        ];
        return view('persuratan/form_domisili', $data);
    }

    public function generate_domisili()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                'nomor' => [
                    'rules' => 'required|is_unique[srt_domisili.nomor]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'nik' => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'form pemohon harus diisi',
                        'integer' => 'masukan merupakan nomor induk kependudukan',
                    ]
                ],
                'no_pengantar' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'nomor surat pengantar harus diisi',
                    ]
                ],
                'penandatangan' => [
                    'rulse' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
            ]);

            if (!$validate) {
                $msg = [
                    'error' => [
                        'nomor' => $this->validator->getError('nomor'),
                        'nik' => $this->validator->getError('nik'),
                        'pengantar' => $this->validator->getError('no_pengantar'),
                        'penandatangan' => $this->validator->getError('penandatangan'),
                    ]
                ];
            } else {
                $this->domisili->insert([
                    'nomor' => $this->request->getPost('nomor'),
                    'nik' => $this->request->getPost('nik'),
                    'no_pengantar' => $this->request->getPost('no_pengantar'),
                    'tgl_pengantar' => $this->request->getPost('tgl_pengantar'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'domisili' => $this->request->getPost('domisili'),
                    'penandatangan' => $this->request->getPost('penandatangan'),
                ]);

                $this->outgoing->insert([
                    'no_srt' => $this->request->getPost('nomor'),
                    'pemohon' => $this->request->getPost('nama'),
                    'perihal' => $this->request->getPost('perihal'),
                    'keterangan' => $this->request->getPost('keterangan')
                ]);

                $msg = [
                    'success' => 'Surat keterangan domisili berhasil dibuat'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function print_domisili()
    {
        $id = $this->request->getVar('no-srt');
        $this->domisili->select('srt_domisili.*, tbl_penduduk.*, alamat, tbl_perangkat.nama as nama_ttd, jabatan');
        $this->domisili->join('tbl_penduduk', 'tbl_penduduk.nik = srt_domisili.nik');
        $this->domisili->join('tbl_keluarga', 'tbl_keluarga.no_kk = tbl_penduduk.kk');
        $this->domisili->join('tbl_perangkat', 'tbl_perangkat.id = srt_domisili.penandatangan');

        $data = [
            'desa' => $this->desa->first(),
            'data' => $this->domisili->find($id)
        ];
        $html = view('surat/domisili', $data);

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream('', array(
            "Attachment" => false
        ));
    }

    public function keterangan()
    {
        $data = [
            'perangkat' => $this->perangkat->findAll(),
        ];
        return view('persuratan/form_keterangan', $data);
    }

    public function generate_keterangan()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                'nomor' => [
                    'rules' => 'required|is_unique[srt_keterangan.nomor]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'nik' => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'form pemohon harus diisi',
                        'integer' => 'masukan merupakan nomor induk kependudukan',
                    ]
                ],
                'penandatangan' => [
                    'rulse' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
            ]);

            if (!$validate) {
                $msg = [
                    'error' => [
                        'nomor' => $this->validator->getError('nomor'),
                        'nik' => $this->validator->getError('nik'),
                        'penandatangan' => $this->validator->getError('penandatangan'),
                    ]
                ];
            } else {
                $this->keterangan->insert([
                    'nomor' => $this->request->getPost('nomor'),
                    'nik' => $this->request->getPost('nik'),
                    'keperluan' => $this->request->getPost('keperluan'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'due_date' => $this->request->getPost('due_date'),
                    'penandatangan' => $this->request->getPost('penandatangan'),
                ]);

                $this->outgoing->insert([
                    'no_srt' => $this->request->getPost('nomor'),
                    'pemohon' => $this->request->getPost('nama'),
                    'perihal' => $this->request->getPost('perihal'),
                    'keterangan' => $this->request->getPost('keperluan')
                ]);

                $msg = [
                    'success' => 'Surat keterangan berhasil dibuat'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function print_keterangan()
    {
        $id = $this->request->getVar('no-srt');
        $this->keterangan->select('srt_keterangan.*, tbl_penduduk.*, alamat, tbl_perangkat.nama as nama_ttd, jabatan');
        $this->keterangan->join('tbl_penduduk', 'tbl_penduduk.nik = srt_keterangan.nik');
        $this->keterangan->join('tbl_keluarga', 'tbl_keluarga.no_kk = tbl_penduduk.kk');
        $this->keterangan->join('tbl_perangkat', 'tbl_perangkat.id = srt_keterangan.penandatangan');

        $data = [
            'desa' => $this->desa->first(),
            'data' => $this->keterangan->find($id)
        ];
        $html = view('surat/keterangan', $data);

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream('', array(
            "Attachment" => false
        ));
    }

    public function kematian()
    {
        $data = [
            'perangkat' => $this->perangkat->findAll(),
        ];
        return view('persuratan/form_kematian', $data);
    }

    public function generate_kematian()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                'nomor' => [
                    'rules' => 'required|is_unique[srt_kematian.nomor]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'pemohon'   => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'form pemohon harus diisi',
                        'integer' => 'masukan merupakan nomor induk kependudukan',
                    ]
                ],
                'meninggal'   => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'form warga meninggal harus diisi',
                        'integer' => 'masukan merupakan nomor induk kependudukan',
                    ]
                ],
                'penandatangan' => [
                    'rulse' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
            ]);

            if (!$validate) {
                $msg = [
                    'error' => [
                        'nomor' => $this->validator->getError('nomor'),
                        'pemohon' => $this->validator->getError('pemohon'),
                        'meninggal' => $this->validator->getError('meninggal'),
                        'penandatangan' => $this->validator->getError('penandatangan'),
                    ]
                ];
            } else {
                $this->kematian->insert([
                    'nomor' => $this->request->getPost('nomor'),
                    'nik_pemohon' => $this->request->getPost('pemohon'),
                    'nik_meninggal' => $this->request->getPost('meninggal'),
                    'domisili' => $this->request->getPost('domisili'),
                    'keperluan' => $this->request->getPost('keperluan'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'due_date' => $this->request->getPost('due_date'),
                    'penandatangan' => $this->request->getPost('penandatangan'),
                ]);

                $this->outgoing->insert([
                    'no_srt' => $this->request->getPost('nomor'),
                    'nama' => $this->request->getPost('nama_pemohon'),
                    'perihal' => $this->request->getPost('perihal'),
                    'keterangan' => $this->request->getPost('keperluan')
                ]);

                $msg = [
                    'success' => 'Surat keterangan kematian berhasil dibuat'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function print_kematian()
    {
        $id = $this->request->getVar('no-srt');
        $this->kematian->select('srt_kematian.*, meninggal.*, alamat, pemohon.nama as nama_pemohon, tbl_perangkat.nama as nama_ttd, jabatan');
        $this->kematian->join('tbl_penduduk as pemohon', 'pemohon.nik = srt_kematian.nik_pemohon');
        $this->kematian->join('tbl_penduduk as meninggal', 'meninggal.nik = srt_kematian.nik_meninggal');
        $this->kematian->join('tbl_keluarga', 'meninggal.kk = tbl_keluarga.no_kk');
        $this->kematian->join('tbl_perangkat', 'tbl_perangkat.id = srt_kematian.penandatangan');

        $data = [
            'desa' => $this->desa->first(),
            'data' => $this->kematian->find($id)
        ];
        $html = view('surat/kematian', $data);

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream('', array(
            "Attachment" => false
        ));
    }

    public function pengantar()
    {
        $data = [
            'perangkat' => $this->perangkat->findAll(),
        ];
        return view('persuratan/form_pengantar', $data);
    }

    public function generate_pengantar()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                'nomor' => [
                    'rules' => 'required|is_unique[srt_pengantar.nomor]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'nik'   => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'form pemohon harus diisi',
                        'integer' => 'masukan merupakan nomor induk kependudukan',
                    ]
                ],
                'penandatangan' => [
                    'rulse' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
            ]);

            if (!$validate) {
                $msg = [
                    'error' => [
                        'nomor' => $this->validator->getError('nomor'),
                        'nik' => $this->validator->getError('nik'),
                        'penandatangan' => $this->validator->getError('penandatangan'),
                    ]
                ];
            } else {
                $this->pengantar->insert([
                    'nomor' => $this->request->getPost('nomor'),
                    'nik' => $this->request->getPost('nik'),
                    'keperluan' => $this->request->getPost('keperluan'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'due_date' => $this->request->getPost('due_date'),
                    'penandatangan' => $this->request->getPost('penandatangan'),
                ]);

                $this->outgoing->insert([
                    'no_srt' => $this->request->getPost('nomor'),
                    'pemohon' => $this->request->getPost('nama'),
                    'perihal' => $this->request->getPost('perihal'),
                    'keterangan' => $this->request->getPost('keperluan')
                ]);

                $msg = [
                    'success' => 'Surat pengantar berhasil dibuat'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function print_pengantar()
    {
        $id = $this->request->getVar('no-srt');
        $this->pengantar->select('srt_pengantar.*, tbl_penduduk.*, alamat, tbl_perangkat.nama as nama_ttd, jabatan');
        $this->pengantar->join('tbl_penduduk', 'tbl_penduduk.nik = srt_pengantar.nik');
        $this->pengantar->join('tbl_keluarga', 'tbl_keluarga.no_kk = tbl_penduduk.kk');
        $this->pengantar->join('tbl_perangkat', 'tbl_perangkat.id = srt_pengantar.penandatangan');

        $data = [
            'desa' => $this->desa->first(),
            'data' => $this->pengantar->find($id)
        ];
        $html = view('surat/pengantar', $data);

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream('', array(
            "Attachment" => false
        ));
    }

    public function tidakmampu()
    {
        $data = [
            'perangkat' => $this->perangkat->findAll(),
        ];
        return view('persuratan/form_tidakmampu', $data);
    }

    public function generate_tidakmampu()
    {
        if ($this->request->isAJAX()) {
            $validate = $this->validate([
                'nomor' => [
                    'rules' => 'required|is_unique[srt_tidakmampu.nomor]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah terdaftar'
                    ]
                ],
                'nik'   => [
                    'rules' => 'required|integer',
                    'errors' => [
                        'required' => 'form pemohon harus diisi',
                        'integer' => 'masukan merupakan nomor induk kependudukan',
                    ]
                ],
                'no_pengantar'   => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'form pemohon harus diisi',
                    ]
                ],
                'penandatangan' => [
                    'rulse' => 'required',
                    'errors' => [
                        'required' => '{field} harus diisi'
                    ]
                ],
            ]);

            if (!$validate) {
                $msg = [
                    'error' => [
                        'nomor' => $this->validator->getError('nomor'),
                        'nik' => $this->validator->getError('nik'),
                        'pengantar' => $this->validator->getError('no_pengantar'),
                        'penandatangan' => $this->validator->getError('penandatangan'),
                    ]
                ];
            } else {
                $this->tidakmampu->insert([
                    'nomor' => $this->request->getPost('nomor'),
                    'nik' => $this->request->getPost('nik'),
                    'domisili' => $this->request->getPost('domisili'),
                    'no_pengantar' => $this->request->getPost('no_pengantar'),
                    'tgl_pengantar' => $this->request->getPost('tgl_pengantar'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'penandatangan' => $this->request->getPost('penandatangan'),
                ]);

                $this->outgoing->insert([
                    'no_srt' => $this->request->getPost('nomor'),
                    'pemohon' => $this->request->getPost('nama'),
                    'perihal' => $this->request->getPost('perihal'),
                    'keterangan' => $this->request->getPost('keterangan')
                ]);

                $msg = [
                    'success' => 'Surat keterangan tidak mampu berhasil dibuat'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function print_tidakmampu()
    {
        $id = $this->request->getVar('no-srt');
        $this->tidakmampu->select('srt_tidakmampu.*, tbl_penduduk.*, alamat, tbl_perangkat.nama as nama_ttd, jabatan');
        $this->tidakmampu->join('tbl_penduduk', 'tbl_penduduk.nik = srt_tidakmampu.nik');
        $this->tidakmampu->join('tbl_keluarga', 'tbl_keluarga.no_kk = tbl_penduduk.kk');
        $this->tidakmampu->join('tbl_perangkat', 'tbl_perangkat.id = srt_tidakmampu.penandatangan');

        $data = [
            'desa' => $this->desa->first(),
            'data' => $this->tidakmampu->find($id)
        ];
        $html = view('surat/tidakmampu', $data);

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'potrait');
        $this->dompdf->render();
        $this->dompdf->stream('', array(
            "Attachment" => false
        ));
    }
}

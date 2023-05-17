<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Surat Domisili</title>

    <!-- Custom styles for this template-->
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="pappersize">
        <div class="header-srt">
            <table class="surat">
                <tr>
                    <td>
                        <img class="logo-srt" src="assets/images/<?= $desa['logo']; ?>">
                    </td>
                    <td>
                        <h5 class="id-srt">pemerintah kabupaten klaten</h5>
                        <h5 class="id-srt">kecamatan prambanan</h5>
                        <h4 class="id-srt">desa geneng</h4>
                        <p class="add-srt">Alamat. <?= $desa['alamat']; ?> Kode Pos <?= $desa['kode_pos']; ?></p>
                    </td>
                </tr>
            </table>
        </div>

        <p class="kd-srt">Kode desa : <?= $desa['kode_desa']; ?></p>

        <table class="opp-srt surat">
            <tr>
                <td>
                    <h5 class="name-srt">surat keterangan domisili</h5>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="no-srt">nomor : <?= $data['nomor']; ?></span>
                </td>
            </tr>
        </table>

        <table class="surat">
            <tr>
                <td>
                    Yang bertandatangan dibawah ini kami Kepala Desa Geneng Kecamatan Prambanan Kabupaten Klaten Provinsi Jawa Tengah, menerangkan bahwa :
                </td>
            </tr>
        </table>

        <table class="isi-srt">
            <tr>
                <td> 1. </td>
                <td class="w-25">Nama Lengkap</td>
                <td> : </td>
                <td class="isian"><?= $data['nama']; ?></td>
            </tr>
            <tr>
                <td> 2. </td>
                <td class="w-25">Jenis Kelamin</td>
                <td> : </td>
                <td class="isian"><?= $data['gender']; ?></td>
            </tr>
            <tr>
                <td> 3. </td>
                <td class="w-25">Tampat/Tanggal Lahir</td>
                <td> : </td>
                <td class="isian"><?= $data['pob']; ?>, <?= date('d F Y', strtotime($data['dob'])); ?></td>
            </tr>
            <tr>
                <td> 4. </td>
                <td class="w-25">Agama</td>
                <td> : </td>
                <td class="isian"><?= $data['agama']; ?></td>
            </tr>
            <tr>
                <td> 5. </td>
                <td class="w-25">Warganegara</td>
                <td> : </td>
                <td class="isian"><?= $data['status']; ?></td>
            </tr>
            <tr>
                <td> 6. </td>
                <td class="w-25">NIK</td>
                <td> : </td>
                <td class="isian"><?= $data['nik']; ?></td>
            </tr>
            <tr>
                <td> </td>
                <td class="w-25">Kartu Keluarga</td>
                <td> : </td>
                <td class="isian"><?= $data['kk']; ?></td>
            </tr>
            <tr>
                <td> 7. </td>
                <td class="w-25">Pekerjaan</td>
                <td> : </td>
                <td class="isian"><?= $data['pekerjaan']; ?></td>
            </tr>
            <tr>
                <td> 8. </td>
                <td class="w-25">Alamat Sesuai KTP</td>
                <td> : </td>
                <td class="isian"><?= $data['alamat']; ?></td>
            </tr>
            <tr>
                <td> </td>
                <td class="w-25">Alamat Domisili</td>
                <td> : </td>
                <td class="isian"><?= $data['domisili']; ?></td>
            </tr>
            <tr>
                <td> 9. </td>
                <td class="w-25">Keperluan</td>
                <td> : </td>
                <td class="isian"><?= $data['keterangan']; ?></td>
            </tr>
        </table>

        <p>
            Berdasarkan Surat Keterangan dari Ketua Rukun Tentangga <?= $data['no_pengantar']; ?> 
            tanggal <?= date('d F Y', strtotime($data['tgl_pengantar'])); ?>, bahwa yang bersangkutan benar penduduk Desa Geneng 
            Kecamatan Prambanan Kabupaten Klaten yang beralamat pada alamat tersebut diatas.
        </p>
        <p>
            Demikian Surat Keterangan ini kami buat atas permintaan yang bersangkutan agar yang berkepentingan mengetahui dan maklum.
        </p>

        <div class="signature">
            <!-- <p>Geneng, . . . . . . . . . . . . . . . .</p> -->
            <p>Geneng, <?= date('d F Y', strtotime($data['created_at'])); ?></p>
            <table class="surat srt">
                <tr>
                    <td>
                        <!-- <p> Kepala Desa </p> -->
                        <p><?= $data['jabatan']; ?></p>
                    </td>
                </tr>
            </table>
            <table class="sig-name surat">
                <tr>
                    <td>
                        <!-- <p> Nama </p> -->
                        <p><?= $data['nama_ttd']; ?></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
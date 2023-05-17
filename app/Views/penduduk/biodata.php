<?= $this->extend('templates/index'); ?>
<?= $this->section('pageContent'); ?>
<section class="section">
    <div class="section-header">
        <h1>Biodata Penduduk</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="biodata-tab" data-toggle="tab" href="#biodata" role="tab" aria-controls="biodata" aria-selected="true">Biodata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="doc-tab" data-toggle="tab" href="#document" role="tab" aria-controls="doc" aria-selected="false">Document</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">
                        <div class="d-flex flex-row align-items-center justify-content-between px-1">
                            <h4>NIK : <?= $bio['nik']; ?></h4>
                            <button type="button" class="btn btn-outline-secondary" onclick="update('<?= $bio['nik']; ?>')">Edit</button>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table table-sm table-borderless w-75">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td>: <?= $bio['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. Kartu Keluarga</th>
                                        <td>: <?= $bio['kk']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tampat/Tanggal Lahir</th>
                                        <td>: <?= $bio['pob']; ?>, <?= date('d F Y', strtotime($bio['dob'])); ?></td>
                                        <th>Umur</th>
                                        <td>: <?= $bio['age']; ?> tahun</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>: <?= $bio['gender']; ?></td>
                                        <th>Gol. Darah</th>
                                        <td>: <?= $bio['goldar']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td>: <?= $bio['agama']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pendidikan</th>
                                        <td>: <?= $bio['pendidikan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td>: <?= $bio['pekerjaan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status Perkawinan</th>
                                        <td>: <?= $bio['perkawinan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status Hubungan Dalam Keluarga</th>
                                        <td>: <?= $bio['shdk']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kewarganegaraan</th>
                                        <td>: <?= $bio['status']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Ayah</th>
                                        <td>: <?= $bio['ayah']; ?></td>
                                        <th>Nama Ibu</th>
                                        <td>: <?= $bio['ibu']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="doc-tab">
                        <div class="text-right">
                            <button type="button" class="btn btn-outline-primary" onclick="upload('<?= $bio['nik']; ?>')">Upload</button>
                        </div>
                        <?php if ($doc == null) : ?>
                            <p class="text-center m-3">Tidak ada dokumen yang diunggah</p>
                        <?php endif ?>
                        <div class="row my-3">
                            <?php foreach ($doc as $doc) : ?>
                                <div class="col-12 col-md-4 col-lg-4">
                                    <div class="card">
                                        <div class="text-center p-2">
                                            <img src="<?= base_url(); ?>/document/pdf-icon.png" class="card-img-top w-75">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $doc['dokumen']; ?></h5>
                                            <p class="card-text"><?= $doc['deskripsi']; ?></p>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="<?= base_url('dokumen/download/' . $doc['id']); ?>" class="btn btn-icon btn-success"><i class="fas fa-download"></i></a>
                                            <button class="btn btn-icon btn-danger" onclick="unlink('<?= $doc['id']; ?>')"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="showModal" style="display: none;"></div>

<script src="<?= base_url(); ?>/assets/js/jquery-3.6.1.min.js"></script>
<script>
    function update(nik) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('kependudukan/update_form') ?>",
            data: {
                id: nik
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.showModal').html(response.data).show();
                    $('#updateModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function upload(nik) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('dokumen/upload_form') ?>",
            data: {
                id: nik
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.showModal').html(response.data).show();
                    $('#uploadModal').modal('show');
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function unlink(id) {
        swal({
                title: "Anda yakin?",
                text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('dokumen/unlink') ?>",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                swal("Poof! Data Anda telah dihapus!", {
                                    icon: "success",
                                });
                                location.reload();
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                } else {
                    swal("Data Anda aman!");
                }
            });
    }
</script>
<?= $this->endSection(); ?>
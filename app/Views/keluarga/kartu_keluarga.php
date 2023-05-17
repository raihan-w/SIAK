<?= $this->extend('templates/index'); ?>
<?= $this->section('pageContent'); ?>
<section class="section">
    <div class="section-header">
        <h1>Kartu Keluarga</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="float-right mt-sm-0 mt-3">
                    <button class="btn btn-outline-secondary" onclick="update('<?= $kartu['no_kk']; ?>')"><i class="fas fa-cog"></i></button>
                </div>
                <table class="table table-sm table-borderless w-75">
                    <tbody>
                        <tr>
                            <th>No. Kartu Keluarga</th>
                            <td>: <?= $kartu['no_kk']; ?></td>
                        </tr>
                        <tr>
                            <th>RT</th>
                            <td>: <?= $kartu['rt']; ?></td>
                            <th>RW</th>
                            <td>: <?= $kartu['rw']; ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: <?= $kartu['alamat']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Pendidikan</th>
                                <th>Pekerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no1 = 1; ?>
                            <?php foreach ($list as $row) : ?>
                                <tr>
                                    <td><?= $no1++; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['nik']; ?></td>
                                    <td><?= $row['gender']; ?></td>
                                    <td><?= $row['pob']; ?></td>
                                    <td><?= date('d F Y', strtotime($row['dob'])); ?></td>
                                    <td><?= $row['pendidikan']; ?></td>
                                    <td><?= $row['pekerjaan']; ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status Perkawinan</th>
                                <th>Status Hubungan Dalam Keluarga</th>
                                <th>Kewarganegaraan</th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no2 = 1; ?>
                            <?php foreach ($list as $row) : ?>
                                <tr>
                                    <td><?= $no2++; ?></td>
                                    <td><?= $row['perkawinan']; ?></td>
                                    <td><?= $row['shdk']; ?></td>
                                    <td><?= $row['status']; ?></td>
                                    <td><?= $row['ayah']; ?></td>
                                    <td><?= $row['ibu']; ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="showModal" style="display: none;"></div>

<script src="<?= base_url(); ?>/assets/js/jquery-3.6.1.min.js"></script>
<script>
    function update(no_kk) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('keluarga/update_form') ?>",
            data: {
                id: no_kk
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.showModal').html(response.success).show();
                    $('#updateModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection(); ?>
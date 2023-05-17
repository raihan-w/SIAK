<?= $this->extend('templates/index'); ?>
<?= $this->section('pageContent'); ?>
<section class="section">
    <div class="section-header">
        <h1>Arsip Surat Keluar</h1>
    </div>

    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>

    <div class="section-body">
        <div class="card">
            <div class="card-body archive">
                <div class="table-responsive">
                    <table class="table table-borderless table-sm w-75">
                        <tbody>
                            <tr>
                                <th>Nomor Surat :</th>
                                <td><?= $outgoing['no_srt']; ?></td>
                                <th>Tanggal :</th>
                                <td><?= date('d F Y', strtotime($outgoing['created_at'])); ?></td>
                            </tr>
                            <tr>
                                <th>Perihal :</th>
                                <td><?= $outgoing['perihal']; ?></td>
                            </tr>
                            <tr>
                                <th>Pemohon :</th>
                                <td><?= $outgoing['pemohon']; ?></td>
                            </tr>
                            <tr>
                                <th>Keterangan :</th>
                                <td><?= $outgoing['keterangan']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-row align-items-center justify-content-between px-1">
                    <h5>Lampiran</h5>
                    <?php if ($outgoing['lampiran'] == null) : ?>
                        <button type="button" class="btn btn-outline-primary" onclick="upload('<?= $outgoing['id']; ?>')">Upload</button>
                    <?php endif ?>
                </div>
                <div class="">
                    <?php if ($outgoing['lampiran'] != null) : ?>
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="w-75"> Dokumen </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> <?= $outgoing['lampiran']; ?> </td>
                                    <td>
                                        <form action="<?= base_url('persuratan/unlink/' . $outgoing['id']); ?>" method="POST" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-icon btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <iframe src="<?= base_url('attachment/' . $outgoing['lampiran']); ?>" width="100%" height="500px">
                        <?php endif ?>
                        <p class="text-center m-3">Tidak ada dokumen yang diunggah</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="showModal" style="display: none;"></div>

<script src="<?= base_url(); ?>/assets/js/jquery-3.6.1.min.js"></script>
<script>
    function upload(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('persuratan/upload_form') ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('.showModal').html(response.success).show();
                $('#uploadModal').modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection(); ?>
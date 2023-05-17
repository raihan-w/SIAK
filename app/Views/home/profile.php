<div class="card-body">
    <div class="float-right mt-sm-0 mt-3">
        <button class="btn btn-outline-secondary" onclick="setting('<?= $profile['id']; ?>')"><i class="fas fa-cog"></i></button>
    </div>
    <div class="row">
        <div class="col-sm-3 col-md-3 mb-4 mb-md-0">
            <div class="avatar-item">
                <img alt="image" src="<?= base_url(); ?>/assets/images/<?= $profile['logo']; ?>" class="img-fluid">
                <div class="avatar-badge">
                    <button class="btn" onclick="upload('<?= $profile['id']; ?>')"><i class="fas fa-pencil-alt"></i></button>
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-md-9 mb-4 mb-md-0">
            <h4>Desa <?= $profile['desa']; ?></h4>
            <p>Kode desa: <?= $profile['kode_desa']; ?></p>
            <div class="row">
                <div class="col-md-6 col-12">Kecamatan <?= $profile['kecamatan']; ?></div>
                <div class="col-md-6 col-12">Kabupaten <?= $profile['kabupaten']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">Provinsi <?= $profile['provinsi']; ?></div>
                <div class="col-md-6 col-12">Kode pos <?= $profile['kode_pos']; ?></div>
            </div>
            <p><?= $profile['alamat']; ?></p>
        </div>
    </div>
</div>

<script>
    function setting(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('home/setting') ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.showModal').html(response.data).show();
                    $('#settingModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function upload(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('home/upload') ?>",
            data: {
                id: id
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
</script>
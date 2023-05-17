<?= $this->extend('templates/index'); ?>
<?= $this->section('pageContent'); ?>
<section class="section">
    <div class="section-header">
        <h1>Kartu Keluarga</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive show"></div>
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url(); ?>/assets/js/jquery-3.6.1.min.js"></script>
<script>
    function showData() {
        $.ajax({
            url: "<?php echo base_url('keluarga/getData') ?>",
            dataType: "json",
            success: function(response) {
                $('.show').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function () {
        showData();
    });
</script>
<?= $this->endSection(); ?>
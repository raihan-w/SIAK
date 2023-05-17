<?= $this->extend('templates/index'); ?>
<?= $this->section('pageContent'); ?>
<section class="section">
    <div class="section-header">
        <h1>Daftar Penduduk</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <a href="<?= base_url('penduduk/create'); ?>" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Tambah</a>
                    <button class="btn btn-icon icon-left btn-primary" id="import-btn"><i class="fas fa-file-import"></i>Import</button>
                    <div class="dropdown d-inline mr-2">
                        <button class="btn btn-icon icon-left btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-file-export"></i>
                            Export
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Excel</a>
                            <a class="dropdown-item" href="#">PDF</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive show"></div>
            </div>
        </div>
    </div>
</section>

<div class="showModal" style="display: none;"></div>

<script src="<?= base_url(); ?>/assets/js/jquery-3.6.1.min.js"></script>
<script>
    function showData() {
        $.ajax({
            url: "<?php echo base_url('kependudukan/getData') ?>",
            dataType: "json",
            success: function(response) {
                $('.show').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function() {
        showData();

        $('#import-btn').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url('kependudukan/import_form') ?>",
                dataType: "json",
                success: function(response) {
                    $('.showModal').html(response.data).show();
                    $('#importModal').modal('show')
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>
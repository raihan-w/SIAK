<?= $this->extend('templates/index'); ?>
<?= $this->section('pageContent'); ?>
<section class="section">
    <div class="section-body">
        <!-- Card -->
        <div class="row">
            <!-- Kepala Keluarga -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kepala Keluarga</h4>
                        </div>
                        <div class="card-body">
                            <?= $jml_kk; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Penduduk -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Penduduk</h4>
                        </div>
                        <div class="card-body">
                            <?= $jml_penduduk; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Laki-laki -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-male"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Laki-Laki</h4>
                        </div>
                        <div class="card-body">
                            <?= $jml_lk; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Perempuan -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-female"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Perempuan</h4>
                        </div>
                        <div class="card-body">
                            <?= $jml_pr; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile -->
        <div class="card author-box card-primary profile"></div>
    </div>
</section>

<div class="showModal" style="display: none;"></div>

<script src="<?= base_url(); ?>/assets/js/jquery-3.6.1.min.js"></script>
<script>
    function profile() {
        $.ajax({
            url: "<?php echo base_url('home/profile') ?>",
            dataType: "json",
            success: function(response) {
                $('.profile').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function() {
        profile();
    });
</script>
<?= $this->endSection(); ?>
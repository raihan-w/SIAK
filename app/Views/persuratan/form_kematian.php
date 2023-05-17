<?= $this->extend('templates/index'); ?>
<?= $this->section('pageContent'); ?>
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Kematian</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <!-- Progress Bar -->
                <div class="progressbar">
                    <div class="progression" id="progression"></div>
                    <div class="progress-step progress-step-active" data-title="Pemohon"><i class="fas fa-user"></i></div>
                    <div class="progress-step" data-title="Warga Meninggal"><i class="fas fa-user"></i></i></div>
                    <div class="progress-step" data-title="Isi Surat"><i class="fas fa-keyboard"></i></i></div>
                    <div class="progress-step" data-title="Paraf/Penomoran"><i class="fas fa-bookmark"></i></div>
                </div>

                <form class="user" id="blangko">
                    <?= csrf_field(); ?>

                    <!-- Form step pemohon -->
                    <div class="form-step form-step-active">
                        <div class="m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> NIK </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="pemohon" id="pemohon">
                                <div class="invalid-feedback" id="error-pemohon"></div>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Nama Lengkap </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_pemohon" id="nama_pemohon" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Jenis Kelamin </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="gender_pemohon" id="gender_pemohon" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label class="col-sm-6 col-form-label text-md-right"> Tempat/Tanggal Lahir </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="pob_pemohon" id="pob_pemohon" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control text-md-right" name="dob_pemohon" id="dob_pemohon" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Pekerjaan </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="pkj_pemohon" id="pkj_pemohon" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Alamat KTP</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="alt_pemohon" id="alt_pemohon" cols="3" rows="4" readonly></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="button" class="btn btn-primary btn-next">Next</button>
                        </div>
                    </div>

                    <!-- Form step warga meninggal -->
                    <div class="form-step">
                        <div class="form-froup m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> NIK </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="meninggal" id="meninggal">
                                <div class="invalid-feedback" id="error-meninggal"></div>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Nama Lengkap </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama" id="nama" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> No. KK </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="kk" id="kk" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Jenis Kelamin </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="gender" id="gender" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label class="col-sm-6 col-form-label text-md-right"> Tempat/Tanggal Lahir </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="pob" id="pob" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control" name="dob" id="dob" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Agama </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="agama" id="agama" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Warganegara </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="status" id="status" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Pekerjaan </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Alamat KTP </label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="alamat" id="alamat" cols="3" rows="4" readonly></textarea>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Alamat Domisili </label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="domisili" id="domisili" cols="3" rows="4"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="button" class="btn btn-light btn-prev">Previous</button>
                            <button type="button" class="btn btn-primary btn-next">Next</button>
                        </div>
                    </div>

                    <!-- Form step isi surat -->
                    <div class="form-step">
                        <div class="form-group">
                            <label class="form-label text-md-right">Keperluan</label>
                            <textarea class="form-control summernote-simple" name="keperluan" id="keperluan" cols="3" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label text-md-right">Keterangan</label>
                            <textarea class="form-control summernote-simple" name="keterangan" id="keterangan" cols="3" rows="5"></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label text-md-right">Berlaku</label>
                                <input type="date" class="form-control" name="dateNow" id="dateNow">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-md-right">Sampai Dengan</label>
                                <input type="date" class="form-control" name="due_date" id="due_date">
                            </div>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="button" class="btn btn-light btn-prev">Previous</button>
                            <button type="button" class="btn btn-primary btn-next">Next</button>
                        </div>
                    </div>

                    <!-- Form step paraf/penomoran -->
                    <div class="form-step">
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Perihal </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="perihal" id="perihal" value="Kematian" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Nomor Surat </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nomor" id="nomor">
                                <div class="invalid-feedback" id="error-no"></div>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Penandatangan </label>
                            <div class="col-sm-6">
                                <select name="penandatangan" id="penandatangan" class="form-control form-select">
                                    <?php foreach ($perangkat as $key) : ?>
                                        <option value="<?= $key['id']; ?>"><?= $key['nama']; ?> - <?= $key['jabatan']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="button" class="btn btn-light btn-prev">Previous</button>
                            <button type="submit" class="btn btn-primary" id="btn-save"> Generate </button>
                        </div>
                    </div>
                </form>

                <form action="<?= base_url('persuratan/print_kematian'); ?>" method="POST" target="_blank">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="no-srt" id="no-srt">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="btn-print" hidden> Print </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
<script src="<?= base_url(); ?>/assets/js/jquery-3.6.1.min.js"></script>
<script>
    $(document).ready(function() {
        // Pemohon
        $('#pemohon').change(function(e) {
            e.preventDefault();
            var id = $('#pemohon').val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Autofill/get_nik') ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('#nama_pemohon').val(response.nama);
                    $('#gender_pemohon').val(response.gender);
                    $('#pob_pemohon').val(response.pob);
                    $('#dob_pemohon').val(response.dob);
                    $('#pkj_pemohon').val(response.pekerjaan);
                    $('#alt_pemohon').val(response.alamat);
                }
            });
        });

        // Meninggal
        $('#meninggal').change(function(e) {
            e.preventDefault();
            var id = $('#meninggal').val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Autofill/get_nik'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('#nama').val(response.nama);
                    $('#kk').val(response.kk);
                    $('#gender').val(response.gender);
                    $('#pob').val(response.pob);
                    $('#dob').val(response.dob);
                    $('#agama').val(response.agama);
                    $('#status').val(response.status);
                    $('#pekerjaan').val(response.pekerjaan);
                    $('#alamat').val(response.alamat);
                }
            });
        });

        // Generate
        $('#blangko').submit(function(e) {
            e.preventDefault();
            var id = $('#nomor').val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('persuratan/generate_kematian') ?>",
                data: $('#blangko').serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#btn-save').attr('disabled', 'disabled');
                    $('#btn-save').html('<i class="fas fa-spin fa-spinner"></i>');
                },
                success: function(response) {
                    if (response.error) {
                        $('#btn-save').removeAttr('disabled');
                        $('#btn-save').html('generate');

                        swal('Error!', 'Periksa kembali isian form', 'error');

                        if (response.error.pemohon) {
                            $('#pemohon').addClass('is-invalid');
                            $('#error-pemohon').html(response.error.pemohon);
                        } else {
                            $('#pemohon').removeClass('is-invalid');
                            $('#error-pemohon').html('');
                        }
                        
                        if (response.error.meninggal) {
                            $('#meninggal').addClass('is-invalid');
                            $('#error-meninggal').html(response.error.meninggal);
                        } else {
                            $('#meninggal').removeClass('is-invalid');
                            $('#error-meninggal').html('');
                        }

                        if (response.error.nomor) {
                            $('#nomor').addClass('is-invalid');
                            $('#error-no').html(response.error.nomor);
                        } else {
                            $('#nomor').removeClass('is-invalid');
                            $('#error-no').html('');
                        }
                    } else {
                        $('#btn-save').html('generate');
                        $('#no-srt').val(id);
                        $('#btn-print').removeAttr('hidden');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>
<?= $this->endSection(); ?>
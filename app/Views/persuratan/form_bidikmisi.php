<?= $this->extend('templates/index'); ?>
<?= $this->section('pageContent'); ?>
<section class="section">
    <div class="section-header">
        <h1>Surat Keterangan Beda Nama</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <!-- Progress Bar -->
                <div class="progressbar">
                    <div class="progression" id="progression"></div>
                    <div class="progress-step progress-step-active" data-title="Orang Tua"><i class="fas fa-user"></i></div>
                    <div class="progress-step" data-title="Anak"><i class="fas fa-user"></i></div>
                    <div class="progress-step" data-title="Paraf/Penomoran"><i class="fas fa-bookmark"></i></div>
                </div>
                <form class="user" id="blangko">
                    <?= csrf_field(); ?>
                    <!-- Form step orang tua -->
                    <div class="form-step form-step-active">
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> No KK </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="kk" id="kk">
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> NIK </label>
                            <div class="col-sm-6">
                                <select class="form-control form-select" name="nik_ort" id="nik_ort">
                                    <option value="">-- Masukan No. KK --</option>
                                </select>
                                <div class="invalid-feedback" id="error-nik_ort"></div>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right text-md-right"> Nama Lengkap </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_ort" id="nama_ort" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Jenis Kelamin </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="gender_ort" id="gender_ort" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label class="col-sm-6 col-form-label text-md-right"> Tempat/Tanggal Lahir </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="pob_ort" id="pob_ort" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control" name="dob_ort" id="dob_ort" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label for="" class="col-sm-3 col-form-label text-md-right"> Pekerjaan </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="pekerjaan_ort" id="pekerjaan_ort" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label for="" class="col-sm-3 col-form-label text-md-right"> Alamat</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="alamat_ort" id="alamat_ort" cols="3" rows="4" readonly></textarea>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label for="" class="col-sm-3 col-form-label text-md-right"> Penghasilan </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="penghasilan" id="penghasilan">
                                <div class="invalid-feedback" id="error-penghasilan"></div>
                            </div>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="button" class="btn btn-primary btn-next">Next</button>
                        </div>
                    </div>

                    <!-- From step anak -->
                    <div class="form-step">
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> NIK </label>
                            <div class="col-sm-6">
                                <select class="form-control form-select" name="nik_ank" id="nik_ank">
                                    <option value="">-- Masukan No. KK --</option>
                                </select>
                                <div class="invalid-feedback" id="error-nik_ank"></div>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Nama Lengkap </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_ank" id="nama_ank" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label class="col-sm-3 col-form-label text-md-right"> Jenis Kelamin </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="gender_ank" id="gender_ank" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <label class="col-sm-6 col-form-label text-md-right"> Tempat/Tanggal Lahir </label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="pob_ank" id="pob_ank" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control" name="dob_ank" id="dob_ank" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label for="" class="col-sm-3 col-form-label text-md-right"> Pekerjaan </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="pekerjaan_ank" id="pekerjaan_ank" readonly>
                            </div>
                        </div>
                        <div class="form-group m-2 row">
                            <label for="" class="col-sm-3 col-form-label text-md-right"> Alamat</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="alamat_ank" id="alamat_ank" cols="3" rows="4" readonly></textarea>
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
                                <input type="text" class="form-control" name="perihal" id="perihal" value="Bidik Misi" readonly>
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
                                <select name="penandatangan" id="penandatangan" class="form-control selectric">
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

                <form action="<?= base_url('persuratan/print_bidikmisi'); ?>" method="POST" target="_blank">
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
        // Filter KK
        $('#kk').change(function(e) {
            e.preventDefault();
            var id = $('#kk').val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Autofill/get_kk') ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    var options = '<option value="">-- Pilih NIK --</option>';
                    for (var i = 0; i < data.length; i++) {
                        options += '<option value="' + data[i].nik + '">' + data[i].nik + ' - ' + data[i].nama + '</option>';
                    }
                    $('#nik_ort').html(options);
                    $('#nik_ank').html(options);
                }
            });
        });

        // Autofill ortu
        $('#nik_ort').change(function(e) {
            e.preventDefault();
            var id = $('#nik_ort').val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Autofill/get_nik'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('#nama_ort').val(response.nama);
                    $('#gender_ort').val(response.gender);
                    $('#pob_ort').val(response.pob);
                    $('#dob_ort').val(response.dob);
                    $('#pekerjaan_ort').val(response.pekerjaan);
                    $('#alamat_ort').val(response.alamat);
                }
            });
        });

        // Autofill anak
        $('#nik_ank').change(function(e) {
            e.preventDefault();
            var id = $('#nik_ank').val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('Autofill/get_nik'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    $('#nama_ank').val(response.nama);
                    $('#gender_ank').val(response.gender);
                    $('#pob_ank').val(response.pob);
                    $('#dob_ank').val(response.dob);
                    $('#pekerjaan_ank').val(response.pekerjaan);
                    $('#alamat_ank').val(response.alamat);
                }
            });
        });

        // Generate surat
        $('#blangko').submit(function(e) {
            e.preventDefault();
            var id = $('#nomor').val();
            $.ajax({
                type: "post",
                url: "<?php echo base_url('persuratan/generate_bidikmisi') ?>",
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

                        if (response.error.nik_ort) {
                            $('#nik_ort').addClass('is-invalid');
                            $('#error-nik_ort').html(response.error.nik_ort);
                        } else {
                            $('#nik_ort').removeClass('is-invalid');
                            $('#error-nik_ort').html('');
                        }

                        if (response.error.nik_ank) {
                            $('#nik_ank').addClass('is-invalid');
                            $('#error-nik_ank').html(response.error.nik_ank);
                        } else {
                            $('#nik_ank').removeClass('is-invalid');
                            $('#error-nik_ank').html('');
                        }

                        if (response.error.penghasilan) {
                            $('#penghasilan').addClass('is-invalid');
                            $('#error-penghasilan').html(response.error.penghasilan);
                        } else {
                            $('#penghasilan').removeClass('is-invalid');
                            $('#error-penghasilan').html('');
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
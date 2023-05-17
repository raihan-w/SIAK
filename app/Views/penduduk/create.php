<?= $this->extend('templates/index'); ?>
<?= $this->section('pageContent'); ?>
<section class="section">
    <div class="section-header">
        <h1>Tambah Penduduk</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <form method="post" id="form-add">
                <div class="card-body">
                    <?= csrf_field(); ?>
                    <!-- No.KK -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">No. Kartu Keluarga</label>
                        <div class="col-sm-6">
                            <input type="text" name="kk" id="kk" class="form-control">
                            <div class="invalid-feedback" id="error-kk"></div>
                        </div>
                    </div>
                    <!-- NIK -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Nomor Induk Kependudukan</label>
                        <div class="col-sm-6">
                            <input type="text" name="nik" id="nik" class="form-control">
                            <div class="invalid-feedback" id="error-nik"></div>
                        </div>
                    </div>
                    <!-- Nama -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Nama Lengkap</label>
                        <div class="col-sm-6">
                            <input type="text" name="nama" id="nama" class="form-control">
                            <div class="invalid-feedback" id="error-nama"></div>
                        </div>
                    </div>
                    <!-- Tempat/tanggal lahir -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Tampat/Tanggal Lahir</label>
                        <div class="col-sm-4">
                            <input type="text" name="pob" id="pob" class="form-control">
                            <div class="invalid-feedback" id="error-pob"></div>
                        </div>
                        <div class="col-sm-2">
                            <input type="date" name="dob" id="dob" class="form-control">
                            <div class="invalid-feedback" id="error-dob"></div>
                        </div>
                    </div>
                    <!-- Jenis Kelamin -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Jenis Kelamin</label>
                        <div class="col-sm-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Laki-Laki">
                                <label class="form-check-label">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Perempuan">
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <!-- Golongan Darah -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Golongan Darah</label>
                        <div class="col-sm-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="goldar" value="A">
                                <label class="form-check-label">A</label>
                            </div>
                            <div class="form-check form-check-inline px-2">
                                <input class="form-check-input" type="radio" name="goldar" value="B">
                                <label class="form-check-label">B</label>
                            </div>
                            <div class="form-check form-check-inline px-2">
                                <input class="form-check-input" type="radio" name="goldar" value="O">
                                <label class="form-check-label">O</label>
                            </div>
                            <div class="form-check form-check-inline px-2">
                                <input class="form-check-input" type="radio" name="goldar" value="AB">
                                <label class="form-check-label">AB</label>
                            </div>
                        </div>
                    </div>
                    <!-- Nama Ayah -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Nama Ayah</label>
                        <div class="col-sm-6">
                            <input type="text" name="ayah" id="ayah" class="form-control">
                            <div class="invalid-feedback" id="error-ayah"></div>
                        </div>
                    </div>
                    <!-- Nama Ibu -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Nama Ibu</label>
                        <div class="col-sm-6">
                            <input type="text" name="ibu" id="ibu" class="form-control">
                            <div class="invalid-feedback" id="error-ibu"></div>
                        </div>
                    </div>
                    <!-- Agama -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Agama</label>
                        <div class="col-sm-6">
                            <select name="agama" class="form-control selectric">
                                <option value="Kristen"> Kristen </option>
                                <option value="Katolik"> Katolik </option>
                                <option value="Konghucu"> Konghucu </option>
                                <option value="Hindu"> Hindu </option>
                                <option value="Buddha"> Buddha </option>
                                <option value="Islam"> Islam </option>
                            </select>
                        </div>
                    </div>
                    <!-- Pendidikan -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Pendidikan</label>
                        <div class="col-sm-6">
                            <select name="pendidikan" class="form-control selectric">
                                <?php foreach ($pendidikan as $opt) : ?>
                                    <option value="<?= $opt['id']; ?>"><?= $opt['pendidikan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- Pekerjaan -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Pekerjaan</label>
                        <div class="col-sm-6">
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control">
                            <div class="invalid-feedback" id="error-pekerjaan"></div>
                        </div>
                    </div>
                    <!-- Pernikahan -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Status Pernikahan</label>
                        <div class="col-sm-6">
                            <select name="perkawinan" class="form-control selectric">
                                <option value="Belum Kawin"> Belum Kawin </option>
                                <option value="Kawin"> Kawin </option>
                                <option value="Cerai Hidup"> Cerai Hidup </option>
                                <option value="Cerai Mati"> Cerai Mati </option>
                            </select>
                        </div>
                    </div>
                    <!-- Hubungan Keluarga -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Hubungan Dalam Keluarga</label>
                        <div class="col-sm-6">
                            <input type="text" name="shdk" id="shdk" class="form-control">
                            <div class="invalid-feedback" id="error-shdk"></div>
                        </div>
                    </div>
                    <!-- Alamat -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Alamat</label>
                        <div class="col-sm-6">
                            <textarea name="alamat" cols="3" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Rt/Rw</label>
                        <div class="col-sm-3">
                            <input type="text" name="rt" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="rw" class="form-control">
                        </div>
                    </div>
                    <!-- Kewarganegaraan -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Kewarganegaraan</label>
                        <div class="col-sm-6">
                            <input type="text" name="status" id="status" class="form-control">
                            <div class="invalid-feedback" id="error-status"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary" id="btn-save">submit</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="<?= base_url(); ?>/assets/js/jquery-3.6.1.min.js"></script>
<script>
    $('#form-add').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('kependudukan/insert') ?>",
            data: $('#form-add').serialize(),
            dataType: "json",
            success: function(response) {
                console.log(response)
                if (response.errors) {
                    if (response.errors.rules.kk) {
                        $('#kk').addClass('is-invalid');
                        $('#error-kk').html(response.errors.rules.kk);
                    } else {
                        $('#nik').removeClass('is-invalid');
                        $('#error-nik').html('');
                    }

                    if (response.errors.rules.nik) {
                        $('#nik').addClass('is-invalid');
                        $('#error-nik').html(response.errors.rules.nik);
                    } else {
                        $('#nik').removeClass('is-invalid');
                        $('#error-nik').html('');
                    }

                    if (response.errors.rules.nama) {
                        $('#nama').addClass('is-invalid');
                        $('#error-nama').html(response.errors.rules.nama);
                    } else {
                        $('#nama').removeClass('is-invalid');
                        $('#error-nama').html('');
                    }

                    if (response.errors.rules.ayah) {
                        $('#ayah').addClass('is-invalid');
                        $('#error-ayah').html(response.errors.rules.ayah);
                    } else {
                        $('#ayah').removeClass('is-invalid');
                        $('#error-ayah').html('');
                    }

                    if (response.errors.rules.ibu) {
                        $('#ibu').addClass('is-invalid');
                        $('#error-ibu').html(response.errors.rules.ibu);
                    } else {
                        $('#ibu').removeClass('is-invalid');
                        $('#error-ibu').html('');
                    }

                    if (response.errors.rules.status) {
                        $('#status').addClass('is-invalid');
                        $('#error-status').html(response.errors.rules.status);
                    } else {
                        $('#status').removeClass('is-invalid');
                        $('#error-status').html('');
                    }
                } else {
                    swal({
                        title: "Berhasil!",
                        text: response.success,
                        icon: "success",
                        button: true,
                    });
                    history.back();
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>
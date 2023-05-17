<div class="modal fade" tabindex="-1" role="dialog" id="updateModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Biodata</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" class="user" id="form-update">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <!-- NIK -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Nomor Induk Kependudukan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="nik" value="<?= $bio['nik']; ?>" readonly>
                        </div>
                    </div>
                    <!-- No.KK -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Nomor Kartu Keluarga</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="kk" value="<?= $bio['kk']; ?>">
                        </div>
                    </div>
                    <!-- Nama -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Nama Lengkap</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="nama" value="<?= $bio['nama']; ?>">
                        </div>
                    </div>
                    <!-- Tempat/tanggal lahir -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Tampat/Tanggal Lahir</label>
                        <div class="col-sm-12 col-md-4">
                            <input type="text" class="form-control" name="pob" value="<?= $bio['pob']; ?>">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <input type="date" class="form-control" name="dob" value="<?= $bio['dob']; ?>">
                        </div>
                    </div>
                    <!-- Jenis Kelamin -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Laki-Laki" <?= $bio['gender'] == "Laki-laki" ? "checked" : "" ?>>
                                <label class="form-check-label">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" value="Perempuan" <?= $bio['gender'] == "Perempuan" ? "checked" : "" ?>>
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <!-- Golongan Darah -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Golongan Darah</label>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="goldar" value="A" <?= $bio['goldar'] == "A" ? "checked" : "" ?>>
                                <label class="form-check-label">A</label>
                            </div>
                            <div class="form-check form-check-inline px-2">
                                <input class="form-check-input" type="radio" name="goldar" value="B" <?= $bio['goldar'] == "B" ? "checked" : "" ?>>
                                <label class="form-check-label">B</label>
                            </div>
                            <div class="form-check form-check-inline px-2">
                                <input class="form-check-input" type="radio" name="goldar" value="O" <?= $bio['goldar'] == "O" ? "checked" : "" ?>>
                                <label class="form-check-label">O</label>
                            </div>
                            <div class="form-check form-check-inline px-2">
                                <input class="form-check-input" type="radio" name="goldar" value="AB" <?= $bio['goldar'] == "AB" ? "checked" : "" ?>>
                                <label class="form-check-label">AB</label>
                            </div>
                        </div>
                    </div>
                    <!-- Nama Ayah -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Nama Ayah</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="ayah" value="<?= $bio['ayah']; ?>">
                        </div>
                    </div>
                    <!-- Nama Ibu -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Nama Ibu</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="ibu" value="<?= $bio['ibu']; ?>">
                        </div>
                    </div>
                    <!-- Agama -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Agama</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="agama" value="<?= $bio['agama']; ?>">
                        </div>
                    </div>
                    <!-- Pendidikan -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Pendidikan</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="pendidikan" class="form-control selectric">
                                <?php foreach ($pendidikan as $opt) : ?>
                                    <option value="<?= $opt['id']; ?>" <?= $opt['id'] == $bio['pendidikan'] ? "selected" : null ?>><?= $opt['pendidikan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- Pekerjaan -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Pekerjaan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="pekerjaan" value="<?= $bio['pekerjaan']; ?>">
                        </div>
                    </div>
                    <!-- Pernikahan -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Status Pernikahan</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="perkawinan" class="form-control selectric">
                                <option value="Belum Kawin" <?= $bio['perkawinan'] == "Belum Kawin" ? "selected" : ""; ?>> Belum Kawin </option>
                                <option value="Kawin" <?= $bio['perkawinan'] == "Kawin" ? "selected" : ""; ?>> Kawin </option>
                                <option value="Cerai Hidup" <?= $bio['perkawinan'] == "Cerai Hidup" ? "selected" : ""; ?>> Cerai Hidup </option>
                                <option value="Cerai Mati" <?= $bio['perkawinan'] == "Cerai Mati" ? "selected" : ""; ?>> Cerai Mati </option>
                            </select>
                        </div>
                    </div>
                    <!-- Hubungan Keluarga -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Hubungan Dalam Keluarga</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="shdk" value="<?= $bio['shdk']; ?>">
                        </div>
                    </div>
                    <!-- Kewarganegaraan -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Kewarganegaraan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="status" value="<?= $bio['status']; ?>">
                        </div>
                    </div>

                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#form-update').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('kependudukan/update') ?>",
            data: $('#form-update').serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#btn-save').attr('disabled', 'disabled');
                $('#btn-save').html('<i class="fas fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('#btn-save').removeAttr('disabled');
                $('#btn-save').html('Save changes');
            },
            success: function(response) {
                swal({
                    title: "Berhasil!",
                    text: response.success,
                    icon: "success",
                    button: true,
                });
                $('#updateModal').modal('hide');
                location.reload();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>
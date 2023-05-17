<div class="modal fade" tabindex="-1" role="dialog" id="settingModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="form-setting">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelurahan/Desa</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="desa" id="desa" class="form-control" value="<?= $row['desa']; ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode Desa</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="kode_desa" id="kode_desa" class="form-control" value="<?= $row['kode_desa']; ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kecamatan</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="kecamatan" id="kecamatan" class="form-control" value="<?= $row['kecamatan']; ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kabupaten</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="kabupaten" id="kabupaten" class="form-control" value="<?= $row['kabupaten']; ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Provinsi</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="provinsi" id="provinsi" class="form-control" value="<?= $row['provinsi']; ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode Pos</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" name="kode_pos" id="kode_pos" class="form-control" value="<?= $row['kode_pos']; ?>">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea name="alamat" id="alamat" rows="3" cols="3" class="form-control summernote-simple"><?= $row['alamat']; ?></textarea>
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
    $('#form-setting').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('home/update') ?>",
            data: $('#form-setting').serialize(),
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
                    button: "Ok",
                });
                $('#settingModal').modal('hide');
                profile();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>
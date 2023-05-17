<div class="modal fade" tabindex="-1" role="dialog" id="updateModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kartu Keluarga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" class="user" id="form-update">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <!-- No.KK -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">No. Kartu Keluarga</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="no_kk" value="<?= $data['no_kk']; ?>" readonly>
                        </div>
                    </div>
                    <!-- Alamat -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Alamat</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea class="form-control" name="alamat" id="alamat" cols="3" rows="3"><?= $data['alamat']; ?></textarea>
                        </div>
                    </div>
                    <!-- Rt/Rw -->
                    <div class="form-group row align-items-center mb-4">
                        <label class="col-sm-3 col-form-label text-md-right">Rt/Rw</label>
                        <div class="col-sm-12 col-md-3">
                            <input type="text" class="form-control" name="rt" value="<?= $data['rt']; ?>">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <input type="text" class="form-control" name="rw" value="<?= $data['rw']; ?>">
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
            url: "<?php echo base_url('keluarga/update') ?>",
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
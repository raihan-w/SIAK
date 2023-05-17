<div class="modal fade" tabindex="-1" role="dialog" id="updateModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Perangkat Desa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" class="user" id="form-update">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= $row['nama']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="jabatan" id="jabatan" value="<?= $row['jabatan']; ?>">
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
            url: "<?php echo base_url('perangkat/update') ?>",
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
                    button: "Ok",
                });
                $('#updateModal').modal('hide');
                showData();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="addModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Perangkat Desa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" class="user" id="form-add">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama" id="nama">
                            <div class="invalid-feedback" id="error-nama"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jabatan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="jabatan" id="jabatan">
                            <div class="invalid-feedback" id="error-jabatan"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn-save">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#form-add').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('perangkat/insert') ?>",
            data: $('#form-add').serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#btn-save').attr('disabled', 'disabled');
                $('#btn-save').html('<i class="fas fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('#btn-save').removeAttr('disabled');
                $('#btn-save').html('Submit');

            },
            success: function(response) {
                if (response.error) {
                    if (response.error.nama) {
                        $('#nama').addClass('is-invalid');
                        $('#error-nama').html(response.error.nama);
                    } else {
                        $('#nama').removeClass('is-invalid');
                        $('#error-nama').html('');
                    }

                    if (response.error.jabatan) {
                        $('#jabatan').addClass('is-invalid');
                        $('#error-jabatan').html(response.error.jabatan);
                    } else {
                        $('#jabatan').removeClass('is-invalid');
                        $('#error-jabatan').html('');
                    }
                } else {
                    swal({
                        title: "Berhasil!",
                        text: response.success,
                        icon: "success",
                        button: "Ok",
                    });
                    $('#addModal').modal('hide');
                    showData();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>
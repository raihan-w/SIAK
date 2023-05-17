<div class="modal fade" tabindex="-1" role="dialog" id="groupModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Role Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-group">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $user->user_id; ?>">
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username" value="<?= $user->username; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select name="group" class="form-control form-select">
                                <?php foreach ($groups as $opt) : ?>
                                    <option value="<?= $opt->id; ?>" <?= $opt->id == $user->group_id ? "selected" : null; ?>><?= $opt->name; ?></option>
                                <?php endforeach ?>
                            </select>
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
    $('#form-group').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('users/setGroup') ?>",
            data: $('#form-group').serialize(),
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
                if (response.success) {
                    swal({
                        title: "Berhasil!",
                        text: response.success,
                        icon: "success",
                        button: "Ok",
                    });
                    $('#groupModal').modal('hide');
                    showData();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>
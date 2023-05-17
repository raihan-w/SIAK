<div class="modal fade" tabindex="-1" role="dialog" id="passwordModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Password Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-password">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id" id="id" value="<?= $user->id; ?>">
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username" value="<?= $user->username; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">New Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                        </div>    
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Repeat New Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="pass_confirm" id="pass_confirm" autocomplete="off">
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
    $('#form-password').submit(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('users/setPassword') ?>",
            data: $('#form-password').serialize(),
            dataType: "json",
            success: function (response) {
                console.log(response)
                if (response.success) {
                    swal({
                        title: "Berhasil!",
                        text: response.success,
                        icon: "success",
                        button: "Ok",
                    });
                    $('#passwordModal').modal('hide');
                    showData();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>
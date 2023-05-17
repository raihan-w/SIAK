<div class="modal fade" tabindex="-1" role="dialog" id="uploadModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Logo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-upload" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                    <input type="hidden" name="oldLogo" id="oldLogo" value="<?= $row['logo']; ?>">
                    <div class="text-center mb-4">
                        <img alt="image" src="<?= base_url(); ?>/assets/images/<?= $row['logo']; ?>" class="img-thumbnail w-25" id="imgPreview">
                    </div>
                    <div class="form-group row align-items-center mb-4">
                        <label class="form-control-label col-sm-3 text-md-right">Logo</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="custom-file">
                                <input type="file" class="form-control" name="logo" id="logo">
                            </div>
                            <div class="form-text text-muted">The image must have a maximum size of 2MB</div>
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
    logo.onchange = evt => {
        const [file] = logo.files
        if (file) {
            imgPreview.src = URL.createObjectURL(file)
        }
    };
    $(document).ready(function() {
        $('#btn-save').click(function(e) {
            e.preventDefault();
            let form = $('#form-upload')[0];
            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: "<?php echo base_url('home/save') ?>",
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
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
                    console.log(response);
                    if (response.error) {
                        $('#logo').addClass('is-invalid');
                        $('.form-text').html(response.error.logo);
                    } else {
                        swal({
                            title: "Berhasil!",
                            text: response.success,
                            icon: "success",
                            button: "Ok",
                        });
                        $('#uploadModal').modal('hide');
                        profile();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="uploadModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Lampiran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="doc-upload" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="id" id="id" value="<?= $outgoing['id']; ?>" hidden>
                    </div>
                    <div class="form-group row align-items-center mb-4">
                        <label class="form-control-label col-sm-3 text-md-right">File</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="custom-file">
                                <input type="file" class="form-control" name="lampiran" id="lampiran">
                            </div>
                            <div class="form-text text-muted">The file must have a maximum size of 2MB</div>
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
</div>

<script>
    $('#btn-save').click(function(e) {
        e.preventDefault();
        let form = $('#doc-upload')[0];
        let data = new FormData(form);

        $.ajax({
            type: "post",
            url: "<?php echo base_url('persuratan/upload') ?>",
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
                $('#btn-save').html('Submit');
            },
            success: function(response) {
                console.log(response)
                if (response.error) {
                    if (response.error.lampiran) {
                        $('#lampiran').addClass('is-invalid');
                        $('.form-text').html(response.error.lampiran);
                    } else {
                        $('#lampiran').removeClass('is-invalid');
                    }
                } else {
                    $('#uploadModal').modal('hide');
                    location.reload();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>
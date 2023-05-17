<?= $this->extend('templates/index'); ?>
<?= $this->section('pageContent'); ?>
<section class="section">
    <div class="section-header">
        <h1>Profile</h1>
    </div>

    <div class="section-body">
        <?= view('\Myth\Auth\Views\_message_block') ?>
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src="<?= base_url('/assets/images/users/' . $profile->user_img); ?>" class="rounded-circle profile-widget-picture">
                        <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Username</div>
                                <div class="profile-widget-item-value"><?= $profile->username; ?></div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Email</div>
                                <div class="profile-widget-item-value"><?= $profile->email; ?></div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Role</div>
                                <?php if ($profile->role == 'administrator') : ?>
                                    <div class="badge badge-success"><?= $profile->role; ?></div>
                                <?php elseif ($profile->role == 'operator') : ?>
                                    <div class="badge badge-warning"><?= $profile->role; ?></div>
                                <?php else : ?>
                                    <div class="badge badge-info"><?= $profile->role; ?></div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="font-weight-bold mb-2">User Setting</div>
                        <button type="button" class="btn btn-icon btn-warning" onclick="password(<?= $profile->user_id; ?>)">
                            <i class="fas fa-key"></i>
                            <span class="text">Change Password</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <form method="post" action="<?= base_url('users/update/' . user()->id); ?>" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="card-body">
                            <div class="form-group row align-items-center mb-4">
                                <label class="col-sm-3 col-form-label text-md-right">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" name="username" id="username" class="form-control" value="<?= user()->username; ?>">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-4">
                                <label class="col-sm-3 col-form-label text-md-right">Email</label>
                                <div class="col-sm-6">
                                    <input type="email" name="email" id="email" class="form-control" value="<?= user()->email; ?>">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-4">
                                <label class="form-control-label col-sm-3 text-md-right">Profile Image</label>
                                <div class="col-sm-12 col-md-6">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" name="user_img" id="user_img">
                                    </div>
                                    <div class="form-text text-muted">The image must have a maximum size of 2MB</div>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <img src="<?= base_url('/assets/images/users/' . user()->user_img); ?>" class="img-thumbnail w-75" id="imgPreview">
                                </div>
                            </div>
                            <input type="hidden" name="oldImg" value="<?= user()->user_img; ?>">
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="showModal" style="display: none;"></div>

<script src="<?= base_url(); ?>/assets/js/jquery-3.6.1.min.js"></script>
<script>
    user_img.onchange = evt => {
        const [file] = user_img.files
        if (file) {
            imgPreview.src = URL.createObjectURL(file)
        }
    };

    function password(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('users/password_form') ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.showModal').html(response.data).show();
                    $('#passwordModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection(); ?>
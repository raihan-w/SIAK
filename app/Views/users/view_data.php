<table class="table table-striped table-md" id="dataTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($users as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row->username; ?></td>
                <td><?= $row->email; ?></td>
                <td>
                    <?php if ($row->role == 'administrator') : ?>
                        <div class="badge badge-success"><?= $row->role; ?></div>
                    <?php elseif ($row->role == 'operator') : ?>
                        <div class="badge badge-warning"><?= $row->role; ?></div>
                    <?php else : ?>
                        <div class="badge badge-info"><?= $row->role; ?></div>
                    <?php endif ?>
                </td>
                <td>
                    <?php if ($row->user_id != user()->id) : ?>
                        <button type="button" class="btn btn-icon btn-info" onclick="group(<?= $row->user_id; ?>)"><i class="fas fa-list"></i></button>
                        <button type="button" class="btn btn-icon btn-warning" onclick="password(<?= $row->user_id; ?>)"><i class="fas fa-key"></i></button>
                        <button type="button" class="btn btn-icon btn-danger" onclick="remove(<?= $row->user_id; ?>)"><i class="fas fa-trash"></i></button>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    function group(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('users/group_form') ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.showModal').html(response.data).show();
                    $('#groupModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

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

    function remove(id) {
        swal({
                title: "Anda yakin?",
                text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "post",
                        url: "<?php echo base_url('users/delete') ?>",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                showData();
                                swal("Poof! Data Anda telah dihapus!", {
                                    icon: "success",
                                });
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                } else {
                    swal("Data Anda aman!");
                }
            });
    }
</script>
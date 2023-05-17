<table class="table table-striped table-md" id="dataTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Jabatan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($perangkat as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['jabatan']; ?></td>
                <td>
                    <button type="button" class="btn btn-icon btn-info" onclick="update('<?= $row['id']; ?>')"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-icon btn-danger" onclick="remove('<?= $row['id']; ?>')"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    function update(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('perangkat/update_form') ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.showModal').html(response.success).show();
                    $('#updateModal').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    };

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
                        url: "<?php echo base_url('perangkat/delete') ?>",
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
    };
</script>
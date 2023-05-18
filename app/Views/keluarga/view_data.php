<table class="table table-striped table-md" id="dataTable">
    <thead>
        <tr>
            <th>No.KK</th>
            <th>Kepala Keluarga</th>
            <th>Jumlah</th>
            <th>Alamat</th>
            <th>Rt / Rw</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($keluarga as $row) : ?>
            <tr>
                <td><?= $row['no_kk']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['jml']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><?= $row['rt']; ?>/<?= $row['rw']; ?></td>
                <td>
                    <a href="<?= base_url('kartu-keluarga/daftar/' . $row['no_kk']); ?>" class="btn btn-icon btn-info"><i class="fas fa-list"></i></a>
                    <?php if (in_groups('administrator') || in_groups('operator')) : ?>
                        <?php if ($row['jml'] == '0') : ?>
                            <button type="button" class="btn btn-icon btn-danger" onclick="remove('<?= $row['no_kk']; ?>')"><i class="fas fa-trash"></i></button>
                        <?php endif ?>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    function remove(no_kk) {
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
                        url: "<?php echo base_url('keluarga/delete') ?>",
                        data: {
                            id: no_kk
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                swal("Poof! Data Anda telah dihapus!", {
                                    icon: "success",
                                });
                                showData();
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
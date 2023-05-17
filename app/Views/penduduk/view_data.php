<table class="table table-striped table-md" id="dataTable">
    <thead>
        <tr>
            <th>NIK</th>
            <th>No.KK</th>
            <th>Nama</th>
            <th>Tempat/Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($penduduk as $row) : ?>
            <tr>
                <td><?= $row['nik']; ?></td>
                <td><?= $row['kk']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['pob']; ?>, <?= date('d M Y', strtotime($row['dob'])); ?></td>
                <td><?= $row['gender']; ?></td>
                <td>
                    <a href="<?= base_url('/penduduk/biodata/' . $row['nik']); ?>" class="btn btn-icon btn-info"><i class="fas fa-user"></i></a>
                    <button type="button" class="btn btn-icon btn-danger" onclick="remove('<?= $row['nik']; ?>')"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    function remove(nik) {
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
                        url: "<?php echo base_url('kependudukan/delete') ?>",
                        data: {
                            id: nik
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
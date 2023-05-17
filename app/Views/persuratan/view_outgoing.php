<table class="table table-striped table-md" id="dataTable">
    <thead>
        <tr>
            <th>No</th>
            <th>No. Surat</th>
            <th>Perihal</th>
            <th>Pemohon</th>
            <th>Tanggal</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        <?php foreach ($outgoing as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['no_srt']; ?></td>
                <td><?= $row['perihal']; ?></td>
                <td><?= $row['pemohon']; ?></td>
                <td>
                    <?= date('d F Y', strtotime($row['created_at'])); ?>
                </td>
                <td>
                    <a href="<?= base_url('/outgoing/archive/' . $row['id']); ?>" class="btn btn-icon btn-info"><i class="fas fa-info"></i></a>
                    <button class="btn btn-icon btn-danger" onclick="remove('<?= $row['id']; ?>')"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

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
                        url: "<?php echo base_url('persuratan/delete') ?>",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response)
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
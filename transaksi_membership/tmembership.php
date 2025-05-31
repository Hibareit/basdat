<?php
include("../koneksi.php");

// Query data transaksi_membership JOIN membership
$query = 'SELECT tm.*, m.nama AS nama_membership
          FROM transaksi_membership tm
          LEFT JOIN membership m ON tm.membership_id = m.id';
$result = mysqli_query($koneksi, $query);

include '../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Transaksi Membership</h2>
    </div>
    <table class="table table-red mt-3">
        <thead>
            <tr>
                <th>Transaksi ID</th>
                <th>Membership</th>
                <th>
                    <a href="tambah_tmembership.php" class="btn btn-primary p-2">+Tambah</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_object($result)) { ?>
                <tr>
                    <td><?= $row->transaksi_id ?></td>
                    <td><?= htmlspecialchars($row->nama_membership) ?></td>
                    <td>
                        <a href="edit_tmembership.php?transaksi_id=<?= $row->transaksi_id ?>&membership_id=<?= $row->membership_id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_tmembership.php?action=delete&transaksi_id=<?= $row->transaksi_id ?>&membership_id=<?= $row->membership_id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
<?php include '../layouts/footer.php'; ?>

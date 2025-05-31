<?php
include("../koneksi.php");

// Query data transaksi_dasar JOIN client
$query = 'SELECT td.*, c.nama AS nama_client 
          FROM transaksi_dasar td
          LEFT JOIN client c ON td.client_id = c.id';
$result = mysqli_query($koneksi, $query);

include '../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Transaksi Dasar</h2>
    </div>
    <table class="table table-red mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Total</th>
                <th>Metode Pembayaran</th>
                <th>Tanggal</th>
                <th>
                    <a href="tambah_td.php" class="btn btn-primary p-2">+Tambah</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_object($result)) { ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= htmlspecialchars($row->nama_client) ?></td>
                    <td><?= number_format($row->total, 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($row->metode_pembayaran) ?></td>
                    <td><?= htmlspecialchars($row->tanggal) ?></td>
                    <td>
                        <a href="edit_td.php?id=<?= $row->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_td.php?action=delete&id=<?= $row->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
<?php include '../layouts/footer.php'; ?>

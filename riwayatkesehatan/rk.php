<?php
include("../koneksi.php");

// Query data riwayat_kesehatan JOIN client
$query = 'SELECT rk.*, c.nama AS nama_client 
          FROM riwayat_kesehatan rk
          LEFT JOIN client c ON rk.client_id = c.id';
$result = mysqli_query($koneksi, $query);

include '../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Riwayat Kesehatan</h2>
    </div>
    <table class="table table-red mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Jenis Cidera</th>
                <th>Penyakit</th>
                <th>Trauma</th>
                <th>Client</th>
                <th>
                    <a href="tambah_rk.php" class="btn btn-primary p-2">+Tambah</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_object($result)) { ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= htmlspecialchars($row->jenis_cidera) ?></td>
                    <td><?= htmlspecialchars($row->penyakit) ?></td>
                    <td><?= htmlspecialchars($row->trauma) ?></td>
                    <td><?= htmlspecialchars($row->nama_client) ?></td>
                    <td>
                        <a href="edit_rk.php?id=<?= $row->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_rk.php?action=delete&id=<?= $row->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
<?php include '../layouts/footer.php'; ?>

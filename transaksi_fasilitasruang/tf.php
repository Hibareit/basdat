<?php
include("../koneksi.php");

// Query data transaksi_fasilitas_ruang JOIN transaksi_dasar dan fasilitas_ruang
$query = 'SELECT tf.*, fr.nama AS nama_fasilitas
          FROM transaksi_fasilitas_ruang tf
          LEFT JOIN fasilitas_ruang fr ON tf.fasilitas_ruang_id = fr.id';
$result = mysqli_query($koneksi, $query);

include '../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Transaksi Fasilitas Ruang</h2>
    </div>
    <table class="table table-red mt-3">
        <thead>
            <tr>
                <th>Transaksi ID</th>
                <th>Fasilitas Ruang</th>
                <th>Durasi (Jam)</th>
                <th>
                    <a href="tambah_tf.php" class="btn btn-primary p-2">+Tambah</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_object($result)) { ?>
                <tr>
                    <td><?= $row->transaksi_id ?></td>
                    <td><?= htmlspecialchars($row->nama_fasilitas) ?></td>
                    <td><?= htmlspecialchars($row->durasi_jam) ?></td>
                    <td>
                        <a href="edit_tf.php?transaksi_id=<?= $row->transaksi_id ?>&fasilitas_ruang_id=<?= $row->fasilitas_ruang_id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_tf.php?action=delete&transaksi_id=<?= $row->transaksi_id ?>&fasilitas_ruang_id=<?= $row->fasilitas_ruang_id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
<?php include '../layouts/footer.php'; ?>

<?php
include("../koneksi.php");

// Query data produk
$query = 'SELECT * FROM produk;';
$result = mysqli_query($koneksi, $query);

include '../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Produk</h2>
    </div>
    <table class="table table-red mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jenis</th>
                <th>
                    <a href="tambah_produk.php" class="btn btn-primary p-2">+Tambah</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_object($result)) { ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= htmlspecialchars($row->nama) ?></td>
                    <td><?= number_format($row->harga, 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($row->jenis) ?></td>
                    <td>
                        <a href="edit_produk.php?id=<?= $row->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_produk.php?action=delete&id=<?= $row->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
<?php include '../layouts/footer.php'; ?>

<?php
include("../koneksi.php");

// Query data transaksi_produk JOIN produk
$query = 'SELECT tp.*, p.nama AS nama_produk
          FROM transaksi_produk tp
          LEFT JOIN produk p ON tp.produk_id = p.id';
$result = mysqli_query($koneksi, $query);

include '../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Transaksi Produk</h2>
    </div>
    <table class="table table-red mt-3">
        <thead>
            <tr>
                <th>Transaksi ID</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>
                    <a href="tambah_tproduk.php" class="btn btn-primary p-2">+Tambah</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_object($result)) { ?>
                <tr>
                    <td><?= $row->transaksi_id ?></td>
                    <td><?= htmlspecialchars($row->nama_produk) ?></td>
                    <td><?= htmlspecialchars($row->jumlah) ?></td>
                    <td>
                        <a href="edit_tproduk.php?transaksi_id=<?= $row->transaksi_id ?>&produk_id=<?= $row->produk_id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_tproduk.php?action=delete&transaksi_id=<?= $row->transaksi_id ?>&produk_id=<?= $row->produk_id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
<?php include '../layouts/footer.php'; ?>

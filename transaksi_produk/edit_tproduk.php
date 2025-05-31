<?php
include '../layouts/header.php';
include '../koneksi.php';

// Ambil parameter composite key
$transaksi_id = $_GET['transaksi_id'] ?? null;
$produk_id = $_GET['produk_id'] ?? null;
if (!$transaksi_id || !$produk_id) {
    echo "ID tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM transaksi_produk WHERE transaksi_id = $transaksi_id AND produk_id = $produk_id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Ambil data produk untuk dropdown
$produk = mysqli_query($koneksi, "SELECT id, nama FROM produk");
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_tproduk.php" method="POST">
        <input type="hidden" name="transaksi_id" value="<?= $data['transaksi_id'] ?>">
        <input type="hidden" name="produk_id" value="<?= $data['produk_id'] ?>">

        <div class="mb-3">
            <label for="produk_id_new" class="form-label">Produk</label>
            <select class="form-select" name="produk_id_new" id="produk_id_new" required>
                <option value="">-- Pilih Produk --</option>
                <?php while ($row = mysqli_fetch_assoc($produk)): ?>
                    <option value="<?= $row['id'] ?>" <?= $data['produk_id'] == $row['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <small class="text-muted">*Jika ingin mengganti produk</small>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" name="jumlah" id="jumlah"
                   value="<?= htmlspecialchars($data['jumlah']) ?>" required min="1">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_tproduk">Simpan Perubahan</button>
            <a href="tproduk.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>
<?php include '../layouts/footer.php'; ?>

<?php
include("../koneksi.php");

$error = '';
$success = '';

// Ambil data transaksi dan produk untuk dropdown
$transaksi = mysqli_query($koneksi, "SELECT id FROM transaksi_dasar ORDER BY id DESC");
$produk = mysqli_query($koneksi, "SELECT id, nama FROM produk ORDER BY nama ASC");

// Proses form tambah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaksi_id = mysqli_real_escape_string($koneksi, trim($_POST['transaksi_id']));
    $produk_id = mysqli_real_escape_string($koneksi, trim($_POST['produk_id']));
    $jumlah = mysqli_real_escape_string($koneksi, trim($_POST['jumlah']));

    // Validasi sederhana
    if (empty($transaksi_id) || empty($produk_id) || empty($jumlah)) {
        $error = "Semua field wajib diisi.";
    } else {
        $query = "INSERT INTO transaksi_produk (transaksi_id, produk_id, jumlah)
                  VALUES ('$transaksi_id', '$produk_id', '$jumlah')";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data transaksi produk berhasil ditambahkan.";
            $transaksi_id = $produk_id = $jumlah = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Transaksi Produk</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form action="tambah_tproduk.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="transaksi_id">Transaksi</label>
            <select name="transaksi_id" id="transaksi_id" class="form-control" required>
                <option value="">-- Pilih Transaksi --</option>
                <?php while ($row = mysqli_fetch_assoc($transaksi)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($transaksi_id) && $transaksi_id == $row['id']) ? 'selected' : '' ?>>
                        <?= $row['id'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="produk_id">Produk</label>
            <select name="produk_id" id="produk_id" class="form-control" required>
                <option value="">-- Pilih Produk --</option>
                <?php while ($row = mysqli_fetch_assoc($produk)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($produk_id) && $produk_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="jumlah">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control"
                   value="<?= htmlspecialchars($jumlah ?? '1') ?>" required min="1">
        </div>

        <button type="submit" class="btn btn-primary" name="tambah_tproduk">Tambah</button>
        <a href="tproduk.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>
<?php include '../layouts/footer.php'; ?>

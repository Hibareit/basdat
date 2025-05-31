<?php
include("../koneksi.php");

$error = '';
$success = '';

$jenis_options = ['Makanan', 'Barang'];

// Proses form tambah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $harga = mysqli_real_escape_string($koneksi, trim($_POST['harga']));
    $jenis = mysqli_real_escape_string($koneksi, trim($_POST['jenis']));

    // Validasi sederhana
    if (empty($nama) || empty($harga) || empty($jenis)) {
        $error = "Nama, Harga, dan Jenis wajib diisi.";
    } else {
        // Insert ke database
        $query = "INSERT INTO produk (nama, harga, jenis)
                  VALUES ('$nama', '$harga', '$jenis')";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data produk berhasil ditambahkan.";
            $nama = $harga = $jenis = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Produk</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="tambah_produk.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="nama">Nama Produk</label>
            <input type="text" name="nama" id="nama" class="form-control"
                   value="<?= htmlspecialchars($nama ?? '') ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control"
                   value="<?= htmlspecialchars($harga ?? '') ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="jenis">Jenis</label>
            <select name="jenis" id="jenis" class="form-control" required>
                <option value="">-- Pilih Jenis --</option>
                <?php foreach ($jenis_options as $jenis): ?>
                    <option value="<?= $jenis ?>" <?= (isset($jenis) && $jenis == $jenis) ? 'selected' : '' ?>>
                        <?= $jenis ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" name="tambah_produk">Tambah</button>
        <a href="produk.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>

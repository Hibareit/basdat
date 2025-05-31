<?php
include("../koneksi.php");

$error = '';
$success = '';

// Ambil data transaksi dan fasilitas ruang untuk dropdown
$transaksi = mysqli_query($koneksi, "SELECT id FROM transaksi_dasar ORDER BY id DESC");
$fasilitas = mysqli_query($koneksi, "SELECT id, nama FROM fasilitas_ruang ORDER BY nama ASC");

// Proses form tambah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaksi_id = mysqli_real_escape_string($koneksi, trim($_POST['transaksi_id']));
    $fasilitas_ruang_id = mysqli_real_escape_string($koneksi, trim($_POST['fasilitas_ruang_id']));
    $durasi_jam = mysqli_real_escape_string($koneksi, trim($_POST['durasi_jam']));

    // Validasi sederhana
    if (empty($transaksi_id) || empty($fasilitas_ruang_id) || empty($durasi_jam)) {
        $error = "Semua field wajib diisi.";
    } else {
        $query = "INSERT INTO transaksi_fasilitas_ruang (transaksi_id, fasilitas_ruang_id, durasi_jam)
                  VALUES ('$transaksi_id', '$fasilitas_ruang_id', '$durasi_jam')";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data transaksi fasilitas ruang berhasil ditambahkan.";
            $transaksi_id = $fasilitas_ruang_id = $durasi_jam = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Transaksi Fasilitas Ruang</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form action="tambah_tf.php" method="POST" class="mt-3">
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
            <label for="fasilitas_ruang_id">Fasilitas Ruang</label>
            <select name="fasilitas_ruang_id" id="fasilitas_ruang_id" class="form-control" required>
                <option value="">-- Pilih Fasilitas Ruang --</option>
                <?php while ($row = mysqli_fetch_assoc($fasilitas)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($fasilitas_ruang_id) && $fasilitas_ruang_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="durasi_jam">Durasi (Jam)</label>
            <input type="number" name="durasi_jam" id="durasi_jam" class="form-control"
                   value="<?= htmlspecialchars($durasi_jam ?? '') ?>" required min="1">
        </div>

        <button type="submit" class="btn btn-primary" name="tambah_tf">Tambah</button>
        <a href="tf.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>
<?php include '../layouts/footer.php'; ?>

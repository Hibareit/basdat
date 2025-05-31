<?php
include '../layouts/header.php';
include '../koneksi.php';

// Ambil parameter composite key
$transaksi_id = $_GET['transaksi_id'] ?? null;
$fasilitas_ruang_id = $_GET['fasilitas_ruang_id'] ?? null;
if (!$transaksi_id || !$fasilitas_ruang_id) {
    echo "ID tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM transaksi_fasilitas_ruang WHERE transaksi_id = $transaksi_id AND fasilitas_ruang_id = $fasilitas_ruang_id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Ambil data fasilitas ruang untuk dropdown
$fasilitas = mysqli_query($koneksi, "SELECT id, nama FROM fasilitas_ruang");

?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_tf.php" method="POST">
        <input type="hidden" name="transaksi_id" value="<?= $data['transaksi_id'] ?>">
        <input type="hidden" name="fasilitas_ruang_id" value="<?= $data['fasilitas_ruang_id'] ?>">

        <div class="mb-3">
            <label for="fasilitas_ruang_id" class="form-label">Fasilitas Ruang</label>
            <select class="form-select" name="fasilitas_ruang_id_new" id="fasilitas_ruang_id" required>
                <option value="">-- Pilih Fasilitas Ruang --</option>
                <?php while ($row = mysqli_fetch_assoc($fasilitas)): ?>
                    <option value="<?= $row['id'] ?>" <?= $data['fasilitas_ruang_id'] == $row['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <small class="text-muted">*Jika ingin mengganti fasilitas ruang</small>
        </div>

        <div class="mb-3">
            <label for="durasi_jam" class="form-label">Durasi (Jam)</label>
            <input type="number" class="form-control" name="durasi_jam" id="durasi_jam"
                   value="<?= htmlspecialchars($data['durasi_jam']) ?>" required min="1">
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_tf">Simpan Perubahan</button>
            <a href="tf.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>
<?php include '../layouts/footer.php'; ?>

<?php 
include '../../layouts/header.php';
include '../../koneksi.php';

// Ambil data kegiatan berdasarkan ID
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID kegiatan tidak ditemukan.";
    exit;
}

// Use prepared statement to fetch kegiatan data
$query = "SELECT * FROM kegiatan WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$kegiatan_data = mysqli_fetch_assoc($result);

if (!$kegiatan_data) {
    echo "Data kegiatan tidak ditemukan.";
    exit;
}
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_kegiatan.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?= htmlspecialchars($kegiatan_data['id']) ?>">

        <div class="mb-3">
            <label for="durasi_kegiatan" class="form-label">Durasi Kegiatan (Menit)</label>
            <input type="number" class="form-control" name="durasi_kegiatan" id="durasi_kegiatan" 
            value="<?= htmlspecialchars($kegiatan_data['durasi_kegiatan']) ?>" 
            placeholder="Masukkan durasi kegiatan..." required>
        </div>
        
        <div class="mb-3">
            <label for="kegiatan" class="form-label">Kegiatan</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" 
            value="<?= htmlspecialchars($kegiatan_data['kegiatan']) ?>" 
            placeholder="Masukkan kegiatan..." required>
        </div>
        
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Kegiatan</label>
            <input type="text" class="form-control" name="nama" id="nama" 
                   value="<?= htmlspecialchars($kegiatan_data['nama']) ?>" 
                   placeholder="Masukkan nama kegiatan..." required>
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_kegiatan">Simpan Perubahan</button>
                  <a href="../../coachpage/kegiatan/kegiatan.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>

<?php include '../../layouts/footer.php'; ?>


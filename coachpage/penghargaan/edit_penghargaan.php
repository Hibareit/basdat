<?php 
include '../../layouts/header.php';
include '../../koneksi.php';

// Ambil data penghargaan berdasarkan ID
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID penghargaan tidak ditemukan.";
    exit;
}

// Use prepared statement to fetch kegiatan data
$query = "SELECT * FROM penghargaan WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$penghargaan_data = mysqli_fetch_assoc($result);

$penghargaan_coaches = mysqli_query($koneksi, "SELECT id, nama FROM coach")

if (!$penghargaan_data) {
    echo "Data penghargaan tidak ditemukan.";
    exit;
}
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_penghargaan.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?= htmlspecialchars($penghargaan_data['id']) ?>">

        <div class="mb-3">
            <label for="coach_id" class="form-label">ID Coach</label>
            <select class="form-select" name="coach_id" id="coach_id" required>
                <option value="">-- Pilih Coach --</option>
                <?php while ($penghargaan_id_coach = mysqli_fetch_assoc($penghargaan_coaches)): ?>
                    <option value="<?= $penghargaan_id_coach['id'] ?>" 
                        <?= $penghargaan_data['coach_id'] == $penghargaan_id_coach['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($penghargaan_id_coach['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="sertifikat_keahlian" class="form-label">sertifikat keahlian</label>
            <input type="text" class="form-control" name="sertifikat_keahlian" id="sertifikat_keahlian" 
            value="<?= htmlspecialchars($penghargaan_data['sertifikat_keahlian']) ?>" 
            placeholder="Masukkan sertifikat keahlian..." required>
        </div>
        
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_penghargaan">Simpan Perubahan</button>
                  <a href="../../coachpage/penghargaan/penghargaan.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>

<?php include '../../layouts/footer.php'; ?>


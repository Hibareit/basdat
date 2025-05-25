<?php 
include '../layouts/header.php';
include '../koneksi.php';

// Ambil data coach berdasarkan ID
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID coach tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM coach WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$coach = mysqli_fetch_assoc($result);

// Ambil data kategori coach untuk dropdown
$kategori_coaches = mysqli_query($koneksi, "SELECT id, keahlian FROM kategori_coach");
$kegiatan = mysqli_query($koneksi, "SELECT id, kegiatan FROM kegiatan");
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_coach.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?= $coach['id'] ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Coach</label>
            <input type="text" class="form-control" name="nama" id="nama" 
                   value="<?= htmlspecialchars($coach['nama']) ?>" 
                   placeholder="Masukkan nama..." required>
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" 
                   value="<?= htmlspecialchars($coach['tanggal_lahir']) ?>" 
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pengalaman</label>
            <select class="form-select" name="pengalaman" id="pengalaman" required>
                <option value="Calisthenics" <?= $coach['pengalaman'] == 'Calisthenics' ? 'selected' : '' ?>>Calisthenics</option>
                <option value="Bodybuilding" <?= $coach['pengalaman'] == 'Bodybuilding' ? 'selected' : '' ?>>Bodybuilding</option>
                <option value="Powerlifting" <?= $coach['pengalaman'] == 'Powerlifting' ? 'selected' : '' ?>>Powerlifting</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="kategori_coach_id" class="form-label">Kategori Coach</label>
            <select class="form-select" name="kategori_coach_id" id="kategori_coach_id" required>
                <option value="">-- Pilih Kategori --</option>
                <?php while ($kategori = mysqli_fetch_assoc($kategori_coaches)): ?>
                    <option value="<?= $kategori['id'] ?>" 
                        <?= $coach['kategori_coach_id'] == $kategori['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($kategori['keahlian']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="kegiatan_id" class="form-label">Kegiatan</label>
            <select class="form-select" name="kegiatan_id" id="kegiatan_id">
                <option value="">-- Pilih Kegiatan --</option>
                <?php while ($kegiatan_item = mysqli_fetch_assoc($kegiatan)): ?>
                    <option value="<?= $kegiatan_item['id'] ?>" 
                        <?= $coach['kegiatan_id'] == $kegiatan_item['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($kegiatan_item['kegiatan']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_coach">Simpan Perubahan</button>
             <a href="../coachpage/coach.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>

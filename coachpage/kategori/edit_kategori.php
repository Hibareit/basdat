<?php 
include '../../layouts/header.php';
include '../../koneksi.php';

// Ambil data kategori_coach berdasarkan ID
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID kategori_coach tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM kategori_coach WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$kategori_coach = mysqli_fetch_assoc($result);

if (!$kategori_coach) {
    echo "Data kategori_coach tidak ditemukan.";
    exit;
}

// Ambil data kategori_coach untuk dropdown (if needed)
$kategori_coaches = mysqli_query($koneksi, "SELECT id, keahlian FROM kategori_coach");
$kegiatan = mysqli_query($koneksi, "SELECT id, kegiatan FROM kegiatan");
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_kategori.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?= htmlspecialchars($kategori_coach['id']) ?>">

        <div class="mb-3">
            <label for="keahlian" class="form-label">Keahlian</label>
            <input type="text" class="form-control" name="keahlian" id="keahlian" 
                   value="<?= htmlspecialchars($kategori_coach['keahlian']) ?>" 
                   placeholder="Masukkan keahlian..." required>
        </div>

        <div class="mb-3">
            <label for="jenis_kategori" class="form-label">Jenis Kategori</label>
            <input type="text" class="form-control" name="jenis_kategori" id="jenis_kategori" 
                   value="<?= htmlspecialchars($kategori_coach['jenis_kategori']) ?>" 
                   required>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_kategori_coach">Simpan Perubahan</button>
            <a href="../../../basdat/coachpage/kategori/kategori.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>

<?php include '../../layouts/footer.php'; ?>

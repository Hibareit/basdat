<?php 
include '../layouts/header.php';
include '../koneksi.php';

// Ambil data gym mitra berdasarkan id
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID gym mitra tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM gym_mitra WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$gym_mitra = mysqli_fetch_assoc($result);

if (!$gym_mitra) {
    echo "Data gym mitra tidak ditemukan.";
    exit;
}

?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_gymmitra.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?= htmlspecialchars($gym_mitra['id']) ?>">

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <input type="text" class="form-control" name="jenis" id="jenis" 
                   value="<?= htmlspecialchars($gym_mitra['jenis']) ?>" 
                   placeholder="Masukkan jenis gym mitra..." required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" 
                   value="<?= htmlspecialchars($gym_mitra['nama']) ?>" 
                   placeholder="Masukkan nama gym mitra..." required>
        </div>

        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" name="lokasi" id="lokasi" 
                   value="<?= htmlspecialchars($gym_mitra['lokasi']) ?>" 
                   placeholder="Masukkan lokasi gym mitra..." required>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_gym_mitra">Simpan Perubahan</button>
            <a href="gymmitra.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>

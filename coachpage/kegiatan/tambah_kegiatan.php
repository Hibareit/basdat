<?php
include("../../koneksi.php");

$error = '';
$success = '';

// Fetch options for kategori_coach
$kategoriResult = mysqli_query($koneksi, "SELECT id, keahlian FROM kategori_coach ORDER BY keahlian ASC");

// Fetch options for kegiatan
$kegiatanResult = mysqli_query($koneksi, "SELECT id, kegiatan FROM kegiatan ORDER BY kegiatan ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $durasi_kegiatan = mysqli_real_escape_string($koneksi, trim($_POST['durasi_kegiatan']));
    $kegiatan = mysqli_real_escape_string($koneksi, trim($_POST['kegiatan']));
    $nama_kegiatan = mysqli_real_escape_string($koneksi, trim($_POST['nama']));

    // Basic validation
    if (empty($durasi_kegiatan) || empty($kegiatan) || empty($nama_kegiatan)) {
        $error = "Semua field wajib diisi.";
    } else {
        // Insert into database
        $query = "INSERT INTO kegiatan (durasi_kegiatan, kegiatan, nama) 
                  VALUES ('$durasi_kegiatan', '$kegiatan', '$nama_kegiatan')";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data kegiatan berhasil ditambahkan.";
            // Clear form values after success
            $durasi_kegiatan = '';
            $kegiatan = '';
            $nama_kegiatan = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Kegiatan</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="tambah_kegiatan.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="durasi_kegiatan">Durasi Kegiatan (dalam menit)</label>
            <input type="number" name="durasi_kegiatan" id="durasi_kegiatan" class="form-control" value="<?= htmlspecialchars($durasi_kegiatan ?? '') ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="kegiatan">Kegiatan</label>
            <input type="text" name="kegiatan" id="kegiatan" class="form-control" value="<?= htmlspecialchars($kegiatan ?? '') ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="nama">Nama Kegiatan</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($nama_kegiatan ?? '') ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Kegiatan</button>
        <a href="../../coachpage/kegiatan/kegiatan.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>

<?php include '../../layouts/footer.php'; ?>

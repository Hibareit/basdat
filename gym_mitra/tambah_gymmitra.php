<?php
include("../koneksi.php");

$error = '';
$success = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $jenis = mysqli_real_escape_string($koneksi, trim($_POST['jenis']));
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $lokasi = mysqli_real_escape_string($koneksi, trim($_POST['lokasi']));

    // Basic validation
    if (empty($jenis) || empty($nama) || empty($lokasi)) {
        $error = "Semua field wajib diisi.";
    } else {
        // Insert into database
        $query = "INSERT INTO gym_mitra (jenis, nama, lokasi) 
                  VALUES ('$jenis', '$nama', '$lokasi')";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data gym mitra berhasil ditambahkan.";
            // Clear form values after success
            $jenis = '';
            $nama = '';
            $lokasi = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Gym Mitra</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="tambah_gymmitra.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="jenis">Jenis</label>
            <input type="text" name="jenis" id="jenis" class="form-control" value="<?= htmlspecialchars($jenis ?? '') ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($nama ?? '') ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="lokasi">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" value="<?= htmlspecialchars($lokasi ?? '') ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Gym Mitra</button>
        <a href="gymmitra.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>

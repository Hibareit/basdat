<?php
include("../../koneksi.php");

$error = '';
$success = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $keahlian = mysqli_real_escape_string($koneksi, trim($_POST['keahlian']));
    $jenis_kategori = mysqli_real_escape_string($koneksi, trim($_POST['jenis_kategori']));

    // Basic validation
    if (empty($keahlian) || empty($jenis_kategori)) {
        $error = "Semua field wajib diisi.";
    } else {
        // Insert into database
        $query = "INSERT INTO kategori_coach (keahlian, jenis_kategori) 
                  VALUES ('$keahlian', '$jenis_kategori')";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data kategori coach berhasil ditambahkan.";
            // Clear form values after success
            $keahlian = '';
            $jenis_kategori = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Kategori Coach</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="tambah_kategori.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="keahlian">Keahlian</label>
            <input type="text" name="keahlian" id="keahlian" class="form-control" value="<?= htmlspecialchars($keahlian ?? '') ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="jenis_kategori">Jenis Kategori</label>
            <input type="text" name="jenis_kategori" id="jenis_kategori" class="form-control" value="<?= htmlspecialchars($jenis_kategori ?? '') ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Kategori</button>
        <a href="../../../basdat/coachpage/kategori/kategori.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>

<?php include '../../layouts/footer.php'; ?>

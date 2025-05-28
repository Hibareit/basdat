
<?php
include("../koneksi.php");

$error = '';
$success = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $tanggal_lahir = mysqli_real_escape_string($koneksi, trim($_POST['tanggal_lahir']));
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));

    // Basic validation
    if (empty($tanggal_lahir) || empty($nama)) {
        $error = "Semua field wajib diisi.";
    } else {
        // Insert into database
        $query = "INSERT INTO office_boy (tanggal_lahir, nama) 
                  VALUES ('$tanggal_lahir', '$nama')";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data kategori coach berhasil ditambahkan.";
            // Clear form values after success
            $tanggal_lahir = '';
            $nama = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Office Boy</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="tambah_officeboy.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="tanggal_lahir">tanggal lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= htmlspecialchars($tanggal_lahir ?? '') ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="nama">nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($nama ?? '') ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Kategori</button>
        <a href="officeboy.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>

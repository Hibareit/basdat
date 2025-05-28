<?php
include("../koneksi.php");

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $jenis = mysqli_real_escape_string($koneksi, trim($_POST['jenis']));
    $biaya_membership = mysqli_real_escape_string($koneksi, trim($_POST['biaya_membership']));
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $waktu_mulai = mysqli_real_escape_string($koneksi, trim($_POST['waktu_mulai']));
    $periode = mysqli_real_escape_string($koneksi, trim($_POST['periode']));

    // Basic validation
    if (empty($jenis) || empty($biaya_membership) || empty($nama) || empty($waktu_mulai) || empty($periode)) {
        $error = "Semua field wajib diisi.";
    } else {
        // Insert into database
        $query = "INSERT INTO membership (jenis, biaya_membership, nama, waktu_mulai, periode) 
                  VALUES ('$jenis', '$biaya_membership', '$nama', '$waktu_mulai', '$periode')";
        
        if (mysqli_query($koneksi, $query)) {
            $success = "Membership berhasil ditambahkan.";
            // Clear form values after success
            $jenis = $biaya_membership = $nama = $waktu_mulai = $periode = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Membership</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="tambah_membership.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="jenis">Jenis Membership</label>
            <input type="text" name="jenis" id="jenis" class="form-control" 
                   value="<?= htmlspecialchars($jenis ?? '') ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="biaya_membership">Biaya Membership</label>
            <input type="number" name="biaya_membership" id="biaya_membership" class="form-control" 
                   value="<?= htmlspecialchars($biaya_membership ?? '') ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" 
                   value="<?= htmlspecialchars($nama ?? '') ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="waktu_mulai">Waktu Mulai</label>
            <input type="date" name="waktu_mulai" id="waktu_mulai" class="form-control" 
                   value="<?= htmlspecialchars($waktu_mulai ?? '') ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="periode">Periode</label>
            <select name="periode" id="periode" class="form-control" required>
                <option value="">-- Pilih Periode --</option>
                <option value="bulan" <?= (isset($periode) && $periode == 'bulan') ? 'selected' : '' ?>>Bulan</option>
                <option value="hari" <?= (isset($periode) && $periode == 'hari') ? 'selected' : '' ?>>Hari</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Membership</button>
        <a href="../membership/membership.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>

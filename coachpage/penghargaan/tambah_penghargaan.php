<?php
include("../../koneksi.php");

$error = '';
$success = '';

// Ambil data coach untuk dropdown
$coachResult = mysqli_query($koneksi, "SELECT id, nama FROM coach ORDER BY nama ASC");

// Cek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coach_id = $_POST['coach_id'] ?? '';
    $sertifikat_keahlian = mysqli_real_escape_string($koneksi, trim($_POST['sertifikat_keahlian']));

    // Validasi
    if (empty($coach_id) || empty($sertifikat_keahlian)) {
        $error = "Semua field wajib diisi.";
    } else {
        // Query insert
        $query = "INSERT INTO penghargaan (coach_id, sertifikat_keahlian) 
                  VALUES ('$coach_id', '$sertifikat_keahlian')";

        if (mysqli_query($koneksi, $query)) {
            $success = "Data sertifikat keahlian coach berhasil ditambahkan.";
            // Reset input
            $coach_id = '';
            $sertifikat_keahlian = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Sertifikat Keahlian Coach</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert"><?= $error ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert"><?= $success ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group mb-3">
            <label for="coach_id">ID Coach</label>
            <select name="coach_id" id="coach_id" class="form-control" required>
                <option value="">-- Pilih Coach --</option>
                <?php while ($row = mysqli_fetch_assoc($coachResult)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($coach_id) && $coach_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="sertifikat_keahlian">Sertifikat Keahlian</label>
            <input type="text" name="sertifikat_keahlian" id="sertifikat_keahlian" class="form-control" value="<?= htmlspecialchars($sertifikat_keahlian ?? '') ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Sertifikat</button>
        <a href="../../../basdat/coachpage/kategori/kategori.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>

<?php include '../../layouts/footer.php'; ?>

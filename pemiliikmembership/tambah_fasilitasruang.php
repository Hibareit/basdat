<?php
include("../koneksi.php");

$error = '';
$success = '';

// Fetch options for kegiatan and office boys
$kegiatanResult = mysqli_query($koneksi, "SELECT id, kegiatan FROM kegiatan ORDER BY kegiatan ASC");
$officeBoyResult = mysqli_query($koneksi, "SELECT id, nama FROM office_boy ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $jenis = mysqli_real_escape_string($koneksi, trim($_POST['jenis']));
    $kegiatan_id = isset($_POST['kegiatan_id']) ? mysqli_real_escape_string($koneksi, trim($_POST['kegiatan_id'])) : null;
    $office_boy_id = mysqli_real_escape_string($koneksi, trim($_POST['office_boy_id']));

    // Basic validation
    if (empty($nama) || empty($jenis) || empty($office_boy_id)) {
        $error = "Nama, Jenis Ruangan, dan Office Boy wajib diisi.";
    } else {
        // Insert into database
        $query = "INSERT INTO fasilitas_ruang (nama, jenis, kegiatan_id, office_boy_id) 
                  VALUES ('$nama', '$jenis', " . ($kegiatan_id ? "'$kegiatan_id'" : "NULL") . ", '$office_boy_id')";
        
        if (mysqli_query($koneksi, $query)) {
            $success = "Fasilitas ruang berhasil ditambahkan.";
            // Clear form values after success
            $nama = $jenis = $kegiatan_id = $office_boy_id = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Fasilitas Ruang</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="tambah_fasilitasruang.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="nama">Nama Fasilitas</label>
            <input type="text" name="nama" id="nama" class="form-control" 
                   value="<?= htmlspecialchars($nama ?? '') ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="jenis">Jenis Ruangan</label>
            <select name="jenis" id="jenis" class="form-control" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="Weightlifting" <?= (isset($jenis) && $jenis == 'Weightlifting') ? 'selected' : '' ?>>Weightlifting</option>
                <option value="Group Exercise" <?= (isset($jenis) && $jenis == 'Group Exercise') ? 'selected' : '' ?>>Group Exercise</option>
                <option value="Cardio" <?= (isset($jenis) && $jenis == 'Cardio') ? 'selected' : '' ?>>Cardio</option>
                <option value="Sauna" <?= (isset($jenis) && $jenis == 'Sauna') ? 'selected' : '' ?>>Sauna</option>
                <option value="Change Room" <?= (isset($jenis) && $jenis == 'Change Room') ? 'selected' : '' ?>>Change Room</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="kegiatan_id">Kegiatan (Opsional)</label>
            <select name="kegiatan_id" id="kegiatan_id" class="form-control">
                <option value="">-- Pilih Kegiatan --</option>
                <?php while ($row = mysqli_fetch_assoc($kegiatanResult)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($kegiatan_id) && $kegiatan_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['kegiatan']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="office_boy_id">Office Boy</label>
            <select name="office_boy_id" id="office_boy_id" class="form-control" required>
                <option value="">-- Pilih Office Boy --</option>
                <?php while ($row = mysqli_fetch_assoc($officeBoyResult)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($office_boy_id) && $office_boy_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Fasilitas</button>
        <a href="../fasilitasruang/fasilitas.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>
<?php
include("koneksi.php");

$error = '';
$success = '';

// Fetch options for kategori_coach
$kategoriResult = mysqli_query($koneksi, "SELECT id, keahlian FROM kategori_coach ORDER BY keahlian ASC");

// Fetch options for kegiatan
$kegiatanResult = mysqli_query($koneksi, "SELECT id, kegiatan FROM kegiatan ORDER BY kegiatan ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $nama = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $tanggal_lahir = mysqli_real_escape_string($koneksi, trim($_POST['tanggal_lahir']));
    $pengalaman = mysqli_real_escape_string($koneksi, trim($_POST['pengalaman']));
    $kategori_coach_id = mysqli_real_escape_string($koneksi, trim($_POST['kategori_coach_id']));
    $kegiatan_id = mysqli_real_escape_string($koneksi, trim($_POST['kegiatan_id']));

    // Basic validation
    if (empty($nama) || empty($tanggal_lahir) || empty($pengalaman) || empty($kategori_coach_id) || empty($kegiatan_id)) {
        $error = "Semua field wajib diisi.";
    } else {
        // Insert into database
        $query = "INSERT INTO coach (nama, tanggal_lahir, pengalaman, kategori_coach_id, kegiatan_id) 
                  VALUES ('$nama', '$tanggal_lahir', '$pengalaman', '$kategori_coach_id', '$kegiatan_id')";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data coach berhasil ditambahkan.";
            // Clear form values after success
           
        } else {
            $error = "Error: " . mysqli_error($koneksi);
            var_dump($kategori_coach_id);
    exit;
        }
    }
}

include 'layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Coach Gym</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="tambah_coach.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= htmlspecialchars($nama ?? '') ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= htmlspecialchars($tanggal_lahir ?? '') ?>">
        </div>
        <div class="form-group mb-3">
            <label for="pengalaman">Pengalaman</label>
            <input type="text" name="pengalaman" id="pengalaman" class="form-control" value="<?= htmlspecialchars($pengalaman ?? '') ?>" >
        </div>
        <div class="form-group mb-3">
            <label for="kategori_coach_id">Kategori Coach</label>
            <select name="kategori_coach_id" id="kategori_coach_id" class="form-control" >
                <option value="">-- Pilih Kategori Coach --</option>
                  <option value="Pemula">Pemula</option>
                <option value="Menengah">Menengah</option>
                <option value="Profesional">Profesional</option>
                <?php while ($row = mysqli_fetch_assoc($kategoriResult)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($kategori_coach_id) && $kategori_coach_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['keahlian']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="kegiatan_id">Kegiatan</label>
            <select name="kegiatan_id" id="kegiatan_id" class="form-control" >
                <option value="">-- Pilih Kegiatan --</option>
                  <option value="Pemula">Pemula</option>
                <option value="Menengah">Menengah</option>
                <option value="Profesional">Profesional</option>
                <?php while ($row = mysqli_fetch_assoc($kegiatanResult)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($kegiatan_id) && $kegiatan_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['kegiatan']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Coach</button>
        <a href="index.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>

<?php include 'layouts/footer.php'; ?>

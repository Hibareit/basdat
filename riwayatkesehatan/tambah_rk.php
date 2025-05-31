<?php
include("../koneksi.php");

$error = '';
$success = '';

// Ambil data client untuk dropdown (opsional)
$clients = mysqli_query($koneksi, "SELECT id, nama FROM client");

// Proses form tambah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jenis_cidera = mysqli_real_escape_string($koneksi, trim($_POST['jenis_cidera']));
    $penyakit = mysqli_real_escape_string($koneksi, trim($_POST['penyakit']));
    $trauma = mysqli_real_escape_string($koneksi, trim($_POST['trauma']));
    $client_id = mysqli_real_escape_string($koneksi, trim($_POST['client_id']));

    // Validasi sederhana
    if (empty($client_id)) {
        $error = "Client ID wajib diisi.";
    } else {
        // Insert ke database
        $query = "INSERT INTO riwayat_kesehatan (jenis_cidera, penyakit, trauma, client_id, id)
                  VALUES ('$jenis_cidera', '$penyakit', '$trauma', '$client_id', NULL)";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data riwayat kesehatan berhasil ditambahkan.";
            $jenis_cidera = $penyakit = $trauma = $client_id = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Riwayat Kesehatan</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="tambah_rk.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="jenis_cidera">Jenis Cidera</label>
            <input type="text" name="jenis_cidera" id="jenis_cidera" class="form-control"
                   value="<?= htmlspecialchars($jenis_cidera ?? '') ?>">
        </div>

        <div class="form-group mb-3">
            <label for="penyakit">Penyakit</label>
            <input type="text" name="penyakit" id="penyakit" class="form-control"
                   value="<?= htmlspecialchars($penyakit ?? '') ?>">
        </div>

        <div class="form-group mb-3">
            <label for="trauma">Trauma</label>
            <input type="text" name="trauma" id="trauma" class="form-control"
                   value="<?= htmlspecialchars($trauma ?? '') ?>">
        </div>

        <div class="form-group mb-3">
    
            
            Jika ingin dropdown client:
            <select name="client_id" id="client_id" class="form-control" required>
                <option value="">-- Pilih Client --</option>
                <?php while ($row = mysqli_fetch_assoc($clients)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($client_id) && $client_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
           
        </div>

        <button type="submit" class="btn btn-primary" name="tambah_rk">Tambah</button>
        <a href="rk.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>

<?php
include("../koneksi.php");

$error = '';
$success = '';

// Ambil data client untuk dropdown
$clients = mysqli_query($koneksi, "SELECT id, nama FROM client");

// Proses form tambah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = mysqli_real_escape_string($koneksi, trim($_POST['client_id']));
    $total = mysqli_real_escape_string($koneksi, trim($_POST['total']));
    $metode_pembayaran = mysqli_real_escape_string($koneksi, trim($_POST['metode_pembayaran']));
    $tanggal = mysqli_real_escape_string($koneksi, trim($_POST['tanggal']));

    // Validasi sederhana
    if (empty($client_id) || empty($metode_pembayaran) || empty($tanggal)) {
        $error = "Semua field wajib diisi.";
    } else {
        // Insert ke database
        $query = "INSERT INTO transaksi_dasar (client_id, total, metode_pembayaran, tanggal)
                  VALUES ('$client_id', '$total', '$metode_pembayaran', '$tanggal')";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data transaksi berhasil ditambahkan.";
            $client_id = $total = $metode_pembayaran = $tanggal = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90 ">
    <h2>Tambah Transaksi Dasar</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="tambah_td.php" method="POST" class=" mt-3">
        <div class="form-group mb-3">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control" required>
                <option value="">-- Pilih Client --</option>
                <?php while ($row = mysqli_fetch_assoc($clients)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($client_id) && $client_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class=" form-group mb-3">
            <label for="total">Total</label>
            <input type="number" name="total" id="total" class="form-control"
                   value="<?= htmlspecialchars($total ?? '') ?>" >
        </div>

        <div class="form-group mb-3">
            <label for="metode_pembayaran">Metode Pembayaran</label>
            <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                <option value="">-- Pilih Metode --</option>
                <option value="Qris" <?= (isset($metode_pembayaran) && $metode_pembayaran == 'Qris') ? 'selected' : '' ?>>Qris</option>
                <option value="Cash" <?= (isset($metode_pembayaran) && $metode_pembayaran == 'Cash') ? 'selected' : '' ?>>Cash</option>
                <option value="Transfer" <?= (isset($metode_pembayaran) && $metode_pembayaran == 'Transfer') ? 'selected' : '' ?>>Transfer</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="tanggal">Tanggal</label>
            <input type="datetime-local" name="tanggal" id="tanggal" class="form-control"
                   value="<?= htmlspecialchars($tanggal ?? '') ?>" required>
        </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_td">Simpan Perubahan</button>
            <a href="td.php" class="btn btn-secondary ms-2">Batal</a>
        </div>

   

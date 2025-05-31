<?php
include("../koneksi.php");

$error = '';
$success = '';

// Ambil data transaksi dan membership untuk dropdown
$transaksi = mysqli_query($koneksi, "SELECT id FROM transaksi_dasar ORDER BY id DESC");
$memberships = mysqli_query($koneksi, "SELECT id, nama FROM membership ORDER BY nama ASC");

// Proses form tambah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaksi_id = mysqli_real_escape_string($koneksi, trim($_POST['transaksi_id']));
    $membership_id = mysqli_real_escape_string($koneksi, trim($_POST['membership_id']));

    // Validasi sederhana
    if (empty($transaksi_id) || empty($membership_id)) {
        $error = "Semua field wajib diisi.";
    } else {
        $query = "INSERT INTO transaksi_membership (transaksi_id, membership_id)
                  VALUES ('$transaksi_id', '$membership_id')";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data transaksi membership berhasil ditambahkan.";
            $transaksi_id = $membership_id = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Transaksi Membership</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form action="tambah_tmembership.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="transaksi_id">Transaksi</label>
            <select name="transaksi_id" id="transaksi_id" class="form-control" required>
                <option value="">-- Pilih Transaksi --</option>
                <?php while ($row = mysqli_fetch_assoc($transaksi)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($transaksi_id) && $transaksi_id == $row['id']) ? 'selected' : '' ?>>
                        <?= $row['id'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="membership_id">Membership</label>
            <select name="membership_id" id="membership_id" class="form-control" required>
                <option value="">-- Pilih Membership --</option>
                <?php while ($row = mysqli_fetch_assoc($memberships)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($membership_id) && $membership_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" name="tambah_tmembership">Tambah</button>
        <a href="tmembership.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>
<?php include '../layouts/footer.php'; ?>

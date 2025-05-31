<?php
include("../koneksi.php");

$error = '';
$success = '';

// Fetch options for client and membership
$clientResult = mysqli_query($koneksi, "SELECT id, nama FROM client ORDER BY nama ASC");
$membershipResult = mysqli_query($koneksi, "SELECT id, nama FROM membership ORDER BY nama ASC");

$status_options = ['Aktif', 'Nonaktif', 'Tertunda', 'Dibatalkan'];

// Proses form tambah
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = mysqli_real_escape_string($koneksi, trim($_POST['client_id']));
    $membership_id = mysqli_real_escape_string($koneksi, trim($_POST['membership_id']));
    $status = mysqli_real_escape_string($koneksi, trim($_POST['status']));
    $catatan = isset($_POST['catatan']) && $_POST['catatan'] !== '' ? mysqli_real_escape_string($koneksi, trim($_POST['catatan'])) : null;

    // Validasi sederhana
    if (empty($client_id) || empty($membership_id) || empty($status)) {
        $error = "Client, Membership, dan Status wajib diisi.";
    } else {
        // Insert ke database
        $query = "INSERT INTO pemilik_membership (client_id, membership_id, status, catatan)
                  VALUES ('$client_id', '$membership_id', '$status', " . ($catatan ? "'$catatan'" : "NULL") . ")";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data pemilik membership berhasil ditambahkan.";
            $client_id = $membership_id = $status = $catatan = '';
        } else {
            $error = "Error: " . mysqli_error($koneksi);
        }
    }
}

include '../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Pemilik Membership</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php elseif ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>

    <form action="tambah_pemilikmembership.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control" required>
                <option value="">-- Pilih Client --</option>
                <?php while ($row = mysqli_fetch_assoc($clientResult)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($client_id) && $client_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="membership_id">Membership</label>
            <select name="membership_id" id="membership_id" class="form-control" required>
                <option value="">-- Pilih Membership --</option>
                <?php while ($row = mysqli_fetch_assoc($membershipResult)) : ?>
                    <option value="<?= $row['id'] ?>" <?= (isset($membership_id) && $membership_id == $row['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="">-- Pilih Status --</option>
                <?php foreach ($status_options as $status): ?>
                    <option value="<?= $status ?>" <?= (isset($status) && $status == $status) ? 'selected' : '' ?>>
                        <?= $status ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="catatan">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control"><?= htmlspecialchars($catatan ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary" name="tambah_pemilikmembership">Tambah</button>
        <a href="pemilikmembership.php" class="btn btn-secondary ms-2">Batal</a>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>

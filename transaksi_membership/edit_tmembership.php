<?php
include '../layouts/header.php';
include '../koneksi.php';

// Ambil parameter composite key
$transaksi_id = $_GET['transaksi_id'] ?? null;
$membership_id = $_GET['membership_id'] ?? null;
if (!$transaksi_id || !$membership_id) {
    echo "ID tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM transaksi_membership WHERE transaksi_id = $transaksi_id AND membership_id = $membership_id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Ambil data membership untuk dropdown
$memberships = mysqli_query($koneksi, "SELECT id, nama FROM membership");
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_tmembership.php" method="POST">
        <input type="hidden" name="transaksi_id" value="<?= $data['transaksi_id'] ?>">
        <input type="hidden" name="membership_id" value="<?= $data['membership_id'] ?>">

        <div class="mb-3">
            <label for="membership_id_new" class="form-label">Membership</label>
            <select class="form-select" name="membership_id_new" id="membership_id_new" required>
                <option value="">-- Pilih Membership --</option>
                <?php while ($row = mysqli_fetch_assoc($memberships)): ?>
                    <option value="<?= $row['id'] ?>" <?= $data['membership_id'] == $row['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <small class="text-muted">*Jika ingin mengganti membership</small>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_tmembership">Simpan Perubahan</button>
            <a href="tmembership.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>
<?php include '../layouts/footer.php'; ?>

<?php
include '../layouts/header.php';
include '../koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM pemilik_membership WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Ambil data client dan membership untuk dropdown
$clients = mysqli_query($koneksi, "SELECT id, nama FROM client");
$memberships = mysqli_query($koneksi, "SELECT id, nama FROM membership");

$status_options = ['Aktif', 'Nonaktif', 'Tertunda', 'Dibatalkan'];
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_pemilikmembership.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select class="form-select" name="client_id" id="client_id" required>
                <option value="">-- Pilih Client --</option>
                <?php while ($client = mysqli_fetch_assoc($clients)): ?>
                    <option value="<?= $client['id'] ?>" <?= $data['client_id'] == $client['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($client['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="membership_id" class="form-label">Membership</label>
            <select class="form-select" name="membership_id" id="membership_id" required>
                <option value="">-- Pilih Membership --</option>
                <?php while ($membership = mysqli_fetch_assoc($memberships)): ?>
                    <option value="<?= $membership['id'] ?>" <?= $data['membership_id'] == $membership['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($membership['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" id="status" required>
                <?php foreach ($status_options as $status): ?>
                    <option value="<?= $status ?>" <?= $data['status'] == $status ? 'selected' : '' ?>>
                        <?= $status ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea class="form-control" name="catatan" id="catatan"><?= htmlspecialchars($data['catatan']) ?></textarea>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_pemilikmembership">Simpan Perubahan</button>
               <a href="pemilikmembership.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>
<?php include '../layouts/footer.php'; ?>

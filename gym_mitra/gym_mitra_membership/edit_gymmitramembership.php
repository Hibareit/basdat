<?php 
include '../../layouts/header.php';
include '../../koneksi.php';

// Ambil ID dari parameter
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

if (!$id) {
    echo "ID gym mitra membership tidak ditemukan.";
    exit;
}

// Ambil data gym_mitra_membership berdasarkan id
$query = "SELECT * FROM gym_mitra_membership WHERE gym_mitra_id = $id";
$result = mysqli_query($koneksi, $query);
$gym_mitra_membership = mysqli_fetch_assoc($result);

if (!$gym_mitra_membership) {
    echo "Data gym mitra membership tidak ditemukan.";
    exit;
}

// Ambil semua data gym mitra dan membership
$gyms = mysqli_query($koneksi, "SELECT * FROM gym_mitra");
$memberships = mysqli_query($koneksi, "SELECT * FROM membership");
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_gymmitramembership.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?= htmlspecialchars($gym_mitra_membership['gym_mitra_id']) ?>">

        <div class="form-group mb-3">
            <label for="gym_mitra_id">Pilih Gym Mitra</label>
            <select name="gym_mitra_id" id="gym_mitra_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                <?php while ($gym = mysqli_fetch_assoc($gyms)): ?>
                    <option value="<?= $gym['id'] ?>" 
                        <?= $gym['id'] == $gym_mitra_membership['gym_mitra_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($gym['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="membership_id">Pilih Membership</label>
            <select name="membership_id" id="membership_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                <?php 
                // Query ulang karena hasil mysqli_fetch_assoc habis dipakai
                $memberships = mysqli_query($koneksi, "SELECT * FROM membership");
                while ($m = mysqli_fetch_assoc($memberships)): ?>
                    <option value="<?= $m['id'] ?>" 
                        <?= $m['id'] == $gym_mitra_membership['membership_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($m['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_gym_mitra_membership">Simpan Perubahan</button>
            <a href="../gymmitra.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>

<?php include '../../layouts/footer.php'; ?>

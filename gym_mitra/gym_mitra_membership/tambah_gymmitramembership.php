<?php
include("../../koneksi.php");

$error = '';
$success = '';

// Ambil data gym mitra dan membership untuk dropdown
$gyms = mysqli_query($koneksi, "SELECT id, nama FROM gym_mitra");
$memberships = mysqli_query($koneksi, "SELECT id, nama FROM membership");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gym_mitra_id = (int)$_POST['gym_mitra_id'];
    $membership_id = (int)$_POST['membership_id'];

    if (empty($gym_mitra_id) || empty($membership_id)) {
        $error = "Semua field wajib dipilih.";
    } else {
        // CEK APAKAH RELASI SUDAH ADA
        $check_sql = "SELECT * FROM gym_mitra_membership 
                     WHERE gym_mitra_id = $gym_mitra_id 
                     AND membership_id = $membership_id";
        $check_result = mysqli_query($koneksi, $check_sql);
        
        if (mysqli_num_rows($check_result) > 0) {
            // JIKA SUDAH ADA, TAMPILKAN PESAN ERROR
            $error = "Maaf, relasi antara Gym Mitra dan Membership ini sudah ada dalam sistem!";
        } else {
            // JIKA BELUM ADA, LAKUKAN INSERT
            $query = "INSERT INTO gym_mitra_membership (gym_mitra_id, membership_id) 
                     VALUES ($gym_mitra_id, $membership_id)";
            
            if (mysqli_query($koneksi, $query)) {
                $success = "Relasi Gym Mitra dan Membership berhasil ditambahkan.";
            } else {
                $error = "Terjadi kesalahan sistem: " . mysqli_error($koneksi);
            }
        }
    }
}

// Reset pointer result untuk dropdown
mysqli_data_seek($gyms, 0);
mysqli_data_seek($memberships, 0);

include '../../layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-90">
    <h2>Tambah Relasi Gym Mitra & Membership</h2>

    <!-- TAMPILKAN PESAN ERROR JIKA ADA -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- TAMPILKAN PESAN SUKSES JIKA ADA -->
    <?php if (!empty($success)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> <?= htmlspecialchars($success) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="tambah_gymmitramembership.php" method="POST" class="mt-3">
        <div class="form-group mb-3">
            <label for="gym_mitra_id">Pilih Gym Mitra</label>
            <select name="gym_mitra_id" id="gym_mitra_id" class="form-control" required>
                <option value="">-- Pilih Gym Mitra --</option>
                <?php while ($gym = mysqli_fetch_assoc($gyms)): ?>
                    <option value="<?= $gym['id'] ?>" <?= isset($_POST['gym_mitra_id']) && $_POST['gym_mitra_id'] == $gym['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($gym['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="membership_id">Pilih Membership</label>
            <select name="membership_id" id="membership_id" class="form-control" required>
                <option value="">-- Pilih Membership --</option>
                <?php while ($m = mysqli_fetch_assoc($memberships)): ?>
                    <option value="<?= $m['id'] ?>" <?= isset($_POST['membership_id']) && $_POST['membership_id'] == $m['id'] ? 'selected' : '' ?>>
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
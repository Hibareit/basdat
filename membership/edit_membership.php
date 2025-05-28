<?php 
include '../layouts/header.php';
include '../koneksi.php';

// Ambil data membership berdasarkan ID
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID membership tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM membership WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$membership = mysqli_fetch_assoc($result);

// Enum 'periode' yang tersedia
$periode_options = ['bulan', 'hari'];
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_membership.php" method="POST">
        <input type="hidden" name="id" value="<?= $membership['id'] ?>">

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Membership</label>
            <input type="text" class="form-control" name="jenis" id="jenis" 
                   value="<?= htmlspecialchars($membership['jenis']) ?>" 
                   placeholder="Masukkan jenis membership..." required>
        </div>

        <div class="mb-3">
            <label for="biaya_membership" class="form-label">Biaya Membership</label>
            <input type="number" class="form-control" name="biaya_membership" id="biaya_membership" 
                   value="<?= htmlspecialchars($membership['biaya_membership']) ?>" 
                   placeholder="Masukkan biaya membership..." required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" id="nama" 
                   value="<?= htmlspecialchars($membership['nama']) ?>" 
                   placeholder="Masukkan nama..." required>
        </div>

        <div class="mb-3">
            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
            <input type="date" class="form-control" name="waktu_mulai" id="waktu_mulai" 
                   value="<?= htmlspecialchars($membership['waktu_mulai']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="periode" class="form-label">Periode</label>
            <select class="form-select" name="periode" id="periode" required>
                <option value="">-- Pilih Periode --</option>
                <?php foreach ($periode_options as $periode): ?>
                    <option value="<?= $periode ?>" <?= $membership['periode'] == $periode ? 'selected' : '' ?>>
                        <?= ucfirst($periode) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_membership">Simpan Perubahan</button>
               <a href="../membership/membership.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>

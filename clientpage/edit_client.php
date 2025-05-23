<?php 
include '../layouts/header.php';
include '../koneksi.php';

// Ambil data client berdasarkan ID
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID client tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM client WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$client = mysqli_fetch_assoc($result);



// Ambil data coach untuk dropdown
$coaches = mysqli_query($koneksi, "SELECT id, nama FROM coach");
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_coach.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?= $client['id'] ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Client</label>
            <input type="text" class="form-control" name="nama" id="nama" 
                   value="<?= htmlspecialchars($client['nama']) ?>" 
                   placeholder="Masukkan nama..." required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="genderL" 
                       value="L" <?= $client['gender'] == 'L' ? 'checked' : '' ?> required>
                <label class="form-check-label" for="genderL">Laki-laki</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="genderP" 
                       value="P" <?= $client['gender'] == 'P' ? 'checked' : '' ?>>
                <label class="form-check-label" for="genderP">Perempuan</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Berat Badan (kg)</label>
            <input type="number" class="form-control" name="weight" id="weight" 
                   value="<?= htmlspecialchars($client['weight']) ?>" 
                   placeholder="Masukkan berat badan...">
        </div>

        <div class="mb-3">
            <label for="pengalaman" class="form-label">Pengalaman Gym</label>
            <select class="form-select" name="pengalaman" id="pengalaman">
                <option value="Pemula" <?= $client['pengalaman'] == 'Pemula' ? 'selected' : '' ?>>Pemula</option>
                <option value="Menengah" <?= $client['pengalaman'] == 'Menengah' ? 'selected' : '' ?>>Menengah</option>
                <option value="Profesional" <?= $client['pengalaman'] == 'Profesional' ? 'selected' : '' ?>>Profesional</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="coach_id" class="form-label">Pelatih</label>
            <select class="form-select" name="coach_id" id="coach_id">
                <option value="">-- Pilih Pelatih --</option>
                <?php while ($coach = mysqli_fetch_assoc($coaches)): ?>
                    <option value="<?= $coach['id'] ?>" 
                        <?= $client['coach_id'] == $coach['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($coach['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_client">Simpan Perubahan</button>
        </div>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>
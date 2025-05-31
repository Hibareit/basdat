<?php
include '../layouts/header.php';
include '../koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM riwayat_kesehatan WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Ambil data client untuk dropdown (opsional, jika ingin menampilkan nama client)
$clients = mysqli_query($koneksi, "SELECT id, nama FROM client");
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_rk.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="mb-3">
            <label for="jenis_cidera" class="form-label">Jenis Cidera</label>
            <input type="text" class="form-control" name="jenis_cidera" id="jenis_cidera"
                   value="<?= htmlspecialchars($data['jenis_cidera']) ?>">
        </div>

        <div class="mb-3">
            <label for="penyakit" class="form-label">Penyakit</label>
            <input type="text" class="form-control" name="penyakit" id="penyakit"
                   value="<?= htmlspecialchars($data['penyakit']) ?>">
        </div>

        <div class="mb-3">
            <label for="trauma" class="form-label">Trauma</label>
            <input type="text" class="form-control" name="trauma" id="trauma"
                   value="<?= htmlspecialchars($data['trauma']) ?>">
        </div>

        <div class="mb-3">
            <label for="client_id" class="form-label">Client ID</label>
            <input type="number" class="form-control" name="client_id" id="client_id"
                   value="<?= htmlspecialchars($data['client_id']) ?>" required>
            <!--
            Jika ingin dropdown client:
            <select class="form-select" name="client_id" id="client_id" required>
                <option value="">-- Pilih Client --</option>
                <?php while ($client = mysqli_fetch_assoc($clients)): ?>
                    <option value="<?= $client['id'] ?>" <?= $data['client_id'] == $client['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($client['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
            -->
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_rk">Simpan Perubahan</button>
            <a href="rk.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>
<?php include '../layouts/footer.php'; ?>

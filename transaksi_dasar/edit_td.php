<?php
include '../layouts/header.php';
include '../koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM transaksi_dasar WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Ambil data client untuk dropdown
$clients = mysqli_query($koneksi, "SELECT id, nama FROM client");
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_td.php" method="POST">
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
            <label for="total" class="form-label">Total</label>
            <input type="number" class="form-control" name="total" id="total"
                   value="<?= htmlspecialchars($data['total']) ?>" >
        </div>

        <div class="mb-3">
            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
            <select class="form-select" name="metode_pembayaran" id="metode_pembayaran" required>
                <option value="">-- Pilih Metode --</option>
                <option value="Qris" <?= $data['metode_pembayaran'] == 'Qris' ? 'selected' : '' ?>>Qris</option>
                <option value="Cash" <?= $data['metode_pembayaran'] == 'Cash' ? 'selected' : '' ?>>Cash</option>
                <option value="Transfer" <?= $data['metode_pembayaran'] == 'Transfer' ? 'selected' : '' ?>>Transfer</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="datetime-local" class="form-control" name="tanggal" id="tanggal"
                   value="<?= date('Y-m-d\TH:i', strtotime($data['tanggal'])) ?>" required>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_td">Simpan Perubahan</button>
            <a href="td.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>
<?php include '../layouts/footer.php'; ?>

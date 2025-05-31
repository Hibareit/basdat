<?php
include '../layouts/header.php';
include '../koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

$jenis_options = ['Makanan', 'Barang'];
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_produk.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="nama" id="nama"
                   value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga"
                   value="<?= htmlspecialchars($data['harga']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <select class="form-select" name="jenis" id="jenis" required>
                <option value="">-- Pilih Jenis --</option>
                <?php foreach ($jenis_options as $jenis): ?>
                    <option value="<?= $jenis ?>" <?= $data['jenis'] == $jenis ? 'selected' : '' ?>>
                        <?= $jenis ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_produk">Simpan Perubahan</button>
               <a href="produk.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>
<?php include '../layouts/footer.php'; ?>

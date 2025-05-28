
<?php 
include '../layouts/header.php';
include '../koneksi.php';

// Ambil data office boy berdasarkan id
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID office boy tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM office_boy WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$office_boy = mysqli_fetch_assoc($result);

if (!$office_boy) {
    echo "Data office_boy tidak ditemukan.";
    exit;
}

?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_officeboy.php" method="POST">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?= htmlspecialchars($office_boy['id']) ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">nama</label>
            <input type="text" class="form-control" name="nama" id="nama" 
                   value="<?= htmlspecialchars($office_boy['nama']) ?>" 
                   placeholder="Masukkan nama..." required>
        </div>

        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">tanggal lahir</label>
            <input type="text" class="form-control" name="tanggal_lahir" id="tanggal_lahir" 
                   value="<?= htmlspecialchars($office_boy['tanggal_lahir']) ?>" 
                   required>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_office_boy">Simpan Perubahan</button>

            <a href="officeboy.php" class="btn btn-secondary ms-2">Batal</a>
        </div>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>

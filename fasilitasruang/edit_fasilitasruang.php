<?php 
include '../layouts/header.php';
include '../koneksi.php';

// Ambil data fasilitas berdasarkan ID
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID fasilitas tidak ditemukan.";
    exit;
}

$query = "SELECT * FROM fasilitas_ruang WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$fasilitas = mysqli_fetch_assoc($result);

// Ambil data office boy untuk dropdown
$office_boys = mysqli_query($koneksi, "SELECT id, nama FROM office_boy");

// Ambil data kegiatan untuk dropdown
$kegiatan = mysqli_query($koneksi, "SELECT id, kegiatan FROM kegiatan");

// Enum 'jenis' yang tersedia
$jenis_options = ['Weightlifting', 'Group Exercise', 'Cardio', 'Sauna', 'Change Room'];
?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function_fasilitasruang.php" method="POST">
        <input type="hidden" name="id" value="<?= $fasilitas['id'] ?>">

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Ruangan</label>
            <input type="text" class="form-control" name="nama" id="nama" 
                   value="<?= htmlspecialchars($fasilitas['nama']) ?>" 
                   placeholder="Masukkan nama ruangan..." required>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <select class="form-select" name="jenis" id="jenis" required>
                <option value="">-- Pilih Jenis --</option>
                <?php foreach ($jenis_options as $jenis): ?>
                    <option value="<?= $jenis ?>" <?= $fasilitas['jenis'] == $jenis ? 'selected' : '' ?>>
                        <?= $jenis ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="kegiatan_id" class="form-label">Kegiatan</label>
            <select class="form-select" name="kegiatan_id" id="kegiatan_id">
                <option value="">-- Pilih Kegiatan --</option>
                <?php while ($kegiatan_item = mysqli_fetch_assoc($kegiatan)): ?>
                    <option value="<?= $kegiatan_item['id'] ?>" 
                        <?= $fasilitas['kegiatan_id'] == $kegiatan_item['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($kegiatan_item['kegiatan']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="office_boy_id" class="form-label">Office Boy</label>
            <select class="form-select" name="office_boy_id" id="office_boy_id" required>
                <option value="">-- Pilih Office Boy --</option>
                <?php while ($ob = mysqli_fetch_assoc($office_boys)): ?>
                    <option value="<?= $ob['id'] ?>" 
                        <?= $fasilitas['office_boy_id'] == $ob['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($ob['nama']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="edit_fasilitas">Simpan Perubahan</button>
        </div>
    </form>
</section>

<?php include '../layouts/footer.php'; ?>

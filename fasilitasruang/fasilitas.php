<?php
include("../koneksi.php");

// Query fasilitas_ruang JOIN kegiatan dan office_boy
$queryCoaches = 'SELECT fr.*, k.kegiatan AS nama_kegiatan, ob.nama AS nama_office_boy
                 FROM fasilitas_ruang fr
                 LEFT JOIN kegiatan k ON fr.kegiatan_id = k.id
                 LEFT JOIN office_boy ob ON fr.office_boy_id = ob.id';
$resultCoaches = mysqli_query($koneksi, $queryCoaches);

include '../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Fasilitas Ruang</h2>
    </div>

    <table class="table table-red mt-3 ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama ruangan</th>
                <th scope="col">Jenis</th>
                <th scope="col">Kegiatan</th>
                <th scope="col">Office Boy</th>
                <th>
                    <a href="../fasilitasruang/tambah_fasilitasruang.php" class="btn btn-primary p-2">+Tambah</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fasilitas_ruang = mysqli_fetch_object($resultCoaches)) { ?>
                <tr>
                    <td><?= $fasilitas_ruang->id ?></td>
                    <td><?= htmlspecialchars($fasilitas_ruang->nama) ?></td>
                    <td><?= htmlspecialchars($fasilitas_ruang->jenis) ?></td>
                    <td><?= htmlspecialchars($fasilitas_ruang->nama_kegiatan) ?></td>
                    <td><?= htmlspecialchars($fasilitas_ruang->nama_office_boy) ?></td>
                    <td>
                        <a href="edit_fasilitasruang.php?id=<?= $fasilitas_ruang->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_fasilitasruang.php?action=delete&id=<?= $fasilitas_ruang->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
<?php include '../layouts/footer.php'; ?>

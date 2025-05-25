<?php
include("../koneksi.php");

// Query for coaches
$queryCoaches = 'SELECT * FROM fasilitas_ruang;'; // Assuming you have a fasilitas_ruang table
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
                <th scope="col">jenis</th>
                <th scope="col">kegiatan</th>
                <th scope="col">office boy</th>
                <th><a href="../fasilitasruang/tambah_fasilitasruang.php" class="btn btn-primary p-2">+Tambah</a></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fasilitas_ruang = mysqli_fetch_object($resultCoaches)) { ?>
                <tr>
                    <td><?= $fasilitas_ruang->id ?></td>
                    <td><?= htmlspecialchars($fasilitas_ruang->nama) ?></td>
                    <td><?= htmlspecialchars($fasilitas_ruang->jenis) ?></td>
                    <td><?= htmlspecialchars($fasilitas_ruang->kegiatan_id) ?></td>
                    <td><?= htmlspecialchars($fasilitas_ruang->office_boy_id) ?></td>
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

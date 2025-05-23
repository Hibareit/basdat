<?php
include("../../koneksi.php");

// Query for coaches
$queryCoaches = 'SELECT * FROM kegiatan;'; // Assuming you have a kegiatan$kegiatan table
$resultCoaches = mysqli_query($koneksi, $queryCoaches);

include '../../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Kegiatan Coach</h2>
       
    </div>

    <table class="table table-red mt-3 ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">durasi kegiatan</th>
                <th scope="col">kegiatan</th>
                <th scope="col">nama kegiatan</th>
                <th><a href="tambah_kegiatan.php" class="btn btn-primary p-2">+Tambah</a></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($kegiatan = mysqli_fetch_object($resultCoaches)) { ?>
                <tr>
                    <td><?= $kegiatan->id ?></td>
                    <td><?= htmlspecialchars($kegiatan->durasi_kegiatan) ?></td>
                    <td><?= htmlspecialchars($kegiatan->kegiatan) ?></td>
                    <td><?= htmlspecialchars($kegiatan->nama) ?></td>
                    <td>
                        <a href="edit_kegiatan.php?id=<?= $kegiatan->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_kegiatan.php?action=delete&id=<?= $kegiatan->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>



<?php include '../../layouts/footer.php'; ?>

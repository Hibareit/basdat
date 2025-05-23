<?php
include("../../koneksi.php");

// Query for coaches
$queryCoaches = 'SELECT * FROM kategori_coach;'; // Assuming you have a kategori$kategori table
$resultCoaches = mysqli_query($koneksi, $queryCoaches);

include '../../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Kategori Coach</h2>
       
    </div>

    <table class="table table-red mt-3 ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">keahlian</th>
                <th scope="col">jenis kategori</th>
                <th><a href="tambah_kategori.php" class="btn btn-primary p-2">+Tambah</a></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($kategori = mysqli_fetch_object($resultCoaches)) { ?>
                <tr>
                    <td><?= $kategori->id ?></td>
                    <td><?= htmlspecialchars($kategori->keahlian) ?></td>
                    <td><?= htmlspecialchars($kategori->jenis_kategori) ?></td>
                    <td>
                        <a href="edit_kegiatan.php?id=<?= $kategori->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_kegiatan.php?action=delete&id=<?= $kategori->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>



<?php include '../../layouts/footer.php'; ?>

<?php
include("../../koneksi.php");

// Query untuk data penghargaan
$queryPenghargaan = 'SELECT * FROM penghargaan;';
$resultPenghargaan = mysqli_query($koneksi, $queryPenghargaan);

include '../../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Penghargaan Coach</h2>
    </div>

    <table class="table table-red mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Sertifikat Keahlian</th>
                <th scope="col">Coach Id</th>
                <th>
                    <a href="tambah_penghargaan.php" class="btn btn-primary p-2">+Tambah</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($penghargaan = mysqli_fetch_object($resultPenghargaan)) { ?>
                <tr>
                    <td><?= $penghargaan->id ?></td>
                    <td><?= htmlspecialchars($penghargaan->sertifikat_keahlian) ?></td>
                    <td><?= htmlspecialchars($penghargaan->coach_id) ?></td>
                    <td>
                        <a href="edit_penghargaan.php?id=<?= $penghargaan->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_penghargaan.php?action=delete&id=<?= $penghargaan->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include '../../layouts/footer.php'; ?>

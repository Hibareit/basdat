<?php
include("../koneksi.php");

// Query for coaches
$queryCoaches = 'SELECT * FROM coach;'; // Assuming you have a coach table
$resultCoaches = mysqli_query($koneksi, $queryCoaches);

include '../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Coach Gym</h2>
       
    </div>

    <table class="table table-red mt-3 ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Pengalaman</th>
    
                <th scope="col">Kategori</th>
                <th scope="col">Kegiatan</th>
                <th><a href="../coachpage/tambah_coach.php" class="btn btn-primary p-2">+Tambah</a></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($coach = mysqli_fetch_object($resultCoaches)) { ?>
                <tr>
                    <td><?= $coach->id ?></td>
                    <td><?= htmlspecialchars($coach->nama) ?></td>
                    <td><?= htmlspecialchars($coach->tanggal_lahir) ?></td>
                    <td><?= htmlspecialchars($coach->pengalaman) ?></td>
                    <td><?= htmlspecialchars($coach->kategori_coach_id) ?></td>
                    <td><?= htmlspecialchars($coach->kegiatan_id) ?></td>
                    <td>
                        <a href="edit_coach.php?id=<?= $coach->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_coach.php?action=delete&id=<?= $coach->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>



<?php include '../layouts/footer.php'; ?>

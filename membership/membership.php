<?php
include("../koneksi.php");

// Query for coaches
$queryCoaches = 'SELECT * FROM membership;'; // Assuming you have a membership table
$resultCoaches = mysqli_query($koneksi, $queryCoaches);



include '../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Membership</h2>
       
    </div>

    <table class="table table-red mt-3 ">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">jenis membership</th>
                <th scope="col">biaya membership</th>
                <th scope="col">Nama membership</th>
                <th scope="col">waktu mulai</th>
                <th scope="col">periode</th>
                <th><a href="tambah_membership.php" class="btn btn-primary p-2">+Tambah</a></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($membership = mysqli_fetch_object($resultCoaches)) { ?>
                <tr>
                    <td><?= $membership->id ?></td>
                    <td><?= htmlspecialchars($membership->jenis) ?></td>
                    <td><?= htmlspecialchars($membership->biaya_membership) ?></td>
                    <td><?= htmlspecialchars($membership->nama) ?></td>
                    <td><?= htmlspecialchars($membership->waktu_mulai) ?></td>
                    <td><?= htmlspecialchars($membership->periode) ?></td>
                    <td>
                        <a href="edit_membership.php?id=<?= $membership->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_membership.php?action=delete&id=<?= $membership->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                   
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>



<?php include '../layouts/footer.php'; ?>

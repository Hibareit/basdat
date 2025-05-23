<?php
include("../koneksi.php");

// Query for clients
$queryClients = 'SELECT * FROM client;';
$resultClients = mysqli_query($koneksi, $queryClients);

// Query for coaches
$queryCoaches = 'SELECT * FROM coach;'; // Assuming you have a coach table
$resultCoaches = mysqli_query($koneksi, $queryCoaches);

include '../layouts/header.php';
?>

<!-- KOLOM UNTUK TABEL CLIENT -->
<section class="p-4 ml-5 mr-5 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Client Gym</h2>
    </div>
    <table class="table table-light mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Gender</th>
                <th scope="col">Weight</th>
                <th scope="col">Pengalaman</th>
                <th scope="col">Aksi</th>
                <th scope="col">Coach ID</th>
                 <th><a href="../clientpage/tambah_client.php" class="btn btn-primary p-2">+Tambah</a></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($client = mysqli_fetch_object($resultClients)) { ?>
                <tr>
                    <td><?= $client->id ?></td>
                    <td><?= $client->nama ?></td>
                    <td><?= $client->gender ?></td>
                    <td><?= $client->weight ?> kg</td>
                    <td><?= $client->pengalaman ?></td>
                    <td>
                        <a href="edit_client.php?id=<?= $client->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_client.php?action=delete&id=<?= $client->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                    <td><?= $client->coach_id ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>



<?php include '../layouts/footer.php'; ?>

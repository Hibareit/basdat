<?php
include("koneksi.php");

$query = 'SELECT * FROM client;';
$result = mysqli_query($koneksi, $query);

include 'layouts/header.php';
?>

<section class="p-4 ml-5 mr-5 w-75">
    <div class="d-flex flex-row justify-content-between">
        <h2>Data Client Gym</h2>
        <a href="tambah.php" class="btn btn-primary p-2">+Tambah</a>
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
            </tr>
        </thead>
        <tbody>
            <?php while ($client = mysqli_fetch_object($result)) { ?>
                <tr>
                    <td><?= $client->id ?></td>
                    <td><?= $client->nama ?></td>
                    <td><?= $client->gender ?></td>
                    <td><?= $client->weight ?> kg</td>
                    <td><?= $client->pengalaman ?></td>
                    <td>
                        <a href="edit.php?id=<?= $client->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function.php?action=delete&id=<?= $client->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include 'layouts/footer.php'; ?>
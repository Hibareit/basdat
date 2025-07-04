<?php
include("../koneksi.php");

// Query for gym partners
$queryGymMitra = 'SELECT * FROM gym_mitra;'; // Query to fetch gym partners
$resultGymMitra = mysqli_query($koneksi, $queryGymMitra);

// Query for gym mitra memberships
$queryGymMitraMembership = 'SELECT * FROM gym_mitra_membership;'; // Query to fetch gym mitra memberships
$resultGymMitraMembership = mysqli_query($koneksi, $queryGymMitraMembership);

include '../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Gym Mitra</h2>
    </div>

    <table class="table table-red mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Jenis</th>
                <th scope="col">Nama</th>
                <th scope="col">Lokasi</th>
                <th>
                    <a href="tambah_gymmitra.php" class="btn btn-primary p-2">+Tambah</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($gymMitra = mysqli_fetch_object($resultGymMitra)) { ?>
                <tr>
                    <td><?= $gymMitra->id ?></td>
                    <td><?= htmlspecialchars($gymMitra->jenis) ?></td>
                    <td><?= htmlspecialchars($gymMitra->nama) ?></td>
                    <td><?= htmlspecialchars($gymMitra->lokasi) ?></td>
                    <td>
                        <a href="edit_gymmitra.php?id=<?= $gymMitra->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_gymmitra.php?action=delete&id=<?= $gymMitra->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="d-flex flex-row justify-content-center">
        <h2>Data Gym Mitra Membership</h2>
    </div>

    <table class="table table-red mt-3">
        <thead>
            <tr>
                <th scope="col">Gym Mitra ID</th>
                <th scope="col">Membership ID</th>
                <th>
                    <a href="gym_mitra_membership/tambah_gymmitramembership.php" class="btn btn-primary p-2">+Tambah</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($gymMitraMembership = mysqli_fetch_object($resultGymMitraMembership)) { ?>
                <tr>
                    <td><?= htmlspecialchars($gymMitraMembership->gym_mitra_id) ?></td>
                    <td><?= htmlspecialchars($gymMitraMembership->membership_id) ?></td>
                    <td>
                        <a href="gym_mitra_membership/edit_gymmitramembership.php?id=<?= $gymMitraMembership->gym_mitra_id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="gym_mitra_membership/function_gymmitramembership.php?action=delete&id=<?= $gymMitraMembership->gym_mitra_id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include '../layouts/footer.php'; ?>

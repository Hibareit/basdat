<?php
include("../koneksi.php");

// Query data pemilik_membership JOIN client dan membership
$query = 'SELECT pm.*, c.nama AS nama_client, m.nama AS nama_membership
          FROM pemilik_membership pm
          LEFT JOIN client c ON pm.client_id = c.id
          LEFT JOIN membership m ON pm.membership_id = m.id';
$result = mysqli_query($koneksi, $query);

include '../layouts/header.php';
?>
<section class="p-4 ml-5 mr-2 w-90">
    <div class="d-flex flex-row justify-content-center">
        <h2>Data Pemilik Membership</h2>
    </div>
    <table class="table table-red mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Membership</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>
                    <a href="tambah_pemilikmembership.php" class="btn btn-primary p-2">+Tambah</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_object($result)) { ?>
                <tr>
                    <td><?= $row->id ?></td>
                    <td><?= htmlspecialchars($row->nama_client) ?></td>
                    <td><?= htmlspecialchars($row->nama_membership) ?></td>
                    <td><?= htmlspecialchars($row->status) ?></td>
                    <td><?= htmlspecialchars($row->catatan) ?></td>
                    <td>
                        <a href="edit_pemilikmembership.php?id=<?= $row->id ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="function_pemilikmembership.php?action=delete&id=<?= $row->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
<?php include '../layouts/footer.php'; ?>

<?php
include "../koneksi.php";

// Fungsi CRUD
function insertPemilikMembership($koneksi, $client_id, $membership_id, $status, $catatan = null) {
    $query = "INSERT INTO pemilik_membership (client_id, membership_id, status, catatan)
              VALUES ('$client_id', '$membership_id', '$status', " . ($catatan ? "'$catatan'" : "NULL") . ")";
    return mysqli_query($koneksi, $query);
}

function updatePemilikMembership($koneksi, $id, $client_id, $membership_id, $status, $catatan = null) {
    $query = "UPDATE pemilik_membership SET
              client_id='$client_id',
              membership_id='$membership_id',
              status='$status',
              catatan=" . ($catatan ? "'$catatan'" : "NULL") . "
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deletePemilikMembership($koneksi, $id) {
    $query = "DELETE FROM pemilik_membership WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// Tambah
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_pemilikmembership'])) {
    $client_id = mysqli_real_escape_string($koneksi, $_POST["client_id"]);
    $membership_id = mysqli_real_escape_string($koneksi, $_POST["membership_id"]);
    $status = mysqli_real_escape_string($koneksi, $_POST["status"]);
    $catatan = isset($_POST["catatan"]) && $_POST["catatan"] !== '' ? mysqli_real_escape_string($koneksi, $_POST["catatan"]) : null;

    if (insertPemilikMembership($koneksi, $client_id, $membership_id, $status, $catatan)) {
        header("Location: pemilikmembership.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_pemilikmembership'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $client_id = mysqli_real_escape_string($koneksi, $_POST["client_id"]);
    $membership_id = mysqli_real_escape_string($koneksi, $_POST["membership_id"]);
    $status = mysqli_real_escape_string($koneksi, $_POST["status"]);
    $catatan = isset($_POST["catatan"]) && $_POST["catatan"] !== '' ? mysqli_real_escape_string($koneksi, $_POST["catatan"]) : null;

    if (updatePemilikMembership($koneksi, $id, $client_id, $membership_id, $status, $catatan)) {
        header("Location: pemilikmembership.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// Hapus
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deletePemilikMembership($koneksi, $id)) {
        header("Location: pemilikmembership.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

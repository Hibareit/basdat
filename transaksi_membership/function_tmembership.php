<?php
include "../koneksi.php";

// Fungsi CRUD
function insertTM($koneksi, $transaksi_id, $membership_id) {
    $query = "INSERT INTO transaksi_membership (transaksi_id, membership_id)
              VALUES ('$transaksi_id', '$membership_id')";
    return mysqli_query($koneksi, $query);
}

function updateTM($koneksi, $transaksi_id, $membership_id, $membership_id_new) {
    $query = "UPDATE transaksi_membership SET
              membership_id='$membership_id_new'
              WHERE transaksi_id=$transaksi_id AND membership_id=$membership_id";
    return mysqli_query($koneksi, $query);
}

function deleteTM($koneksi, $transaksi_id, $membership_id) {
    $query = "DELETE FROM transaksi_membership WHERE transaksi_id=$transaksi_id AND membership_id=$membership_id";
    return mysqli_query($koneksi, $query);
}

// Tambah
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_tmembership'])) {
    $transaksi_id = mysqli_real_escape_string($koneksi, $_POST["transaksi_id"]);
    $membership_id = mysqli_real_escape_string($koneksi, $_POST["membership_id"]);

    if (insertTM($koneksi, $transaksi_id, $membership_id)) {
        header("Location: tmembership.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_tmembership'])) {
    $transaksi_id = mysqli_real_escape_string($koneksi, $_POST["transaksi_id"]);
    $membership_id = mysqli_real_escape_string($koneksi, $_POST["membership_id"]);
    $membership_id_new = mysqli_real_escape_string($koneksi, $_POST["membership_id_new"]);

    if (updateTM($koneksi, $transaksi_id, $membership_id, $membership_id_new)) {
        header("Location: tmembership.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// Hapus
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $transaksi_id = mysqli_real_escape_string($koneksi, $_GET["transaksi_id"]);
    $membership_id = mysqli_real_escape_string($koneksi, $_GET["membership_id"]);

    if (deleteTM($koneksi, $transaksi_id, $membership_id)) {
        header("Location: tmembership.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

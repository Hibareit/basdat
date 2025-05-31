<?php
include "../koneksi.php";

// Fungsi CRUD
function insertTD($koneksi, $client_id, $total, $metode_pembayaran, $tanggal) {
    $query = "INSERT INTO transaksi_dasar (client_id, total, metode_pembayaran, tanggal)
              VALUES ('$client_id', '$total', '$metode_pembayaran', '$tanggal')";
    return mysqli_query($koneksi, $query);
}

function updateTD($koneksi, $id, $client_id, $total, $metode_pembayaran, $tanggal) {
    $query = "UPDATE transaksi_dasar SET
              client_id='$client_id',
              total='$total',
              metode_pembayaran='$metode_pembayaran',
              tanggal='$tanggal'
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deleteTD($koneksi, $id) {
    $query = "DELETE FROM transaksi_dasar WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// Tambah
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_td'])) {
    $client_id = mysqli_real_escape_string($koneksi, $_POST["client_id"]);
    $total = mysqli_real_escape_string($koneksi, $_POST["total"]);
    $metode_pembayaran = mysqli_real_escape_string($koneksi, $_POST["metode_pembayaran"]);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST["tanggal"]);

    if (insertTD($koneksi, $client_id, $total, $metode_pembayaran, $tanggal)) {
        header("Location: td.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_td'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $client_id = mysqli_real_escape_string($koneksi, $_POST["client_id"]);
    $total = mysqli_real_escape_string($koneksi, $_POST["total"]);
    $metode_pembayaran = mysqli_real_escape_string($koneksi, $_POST["metode_pembayaran"]);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST["tanggal"]);

    if (updateTD($koneksi, $id, $client_id, $total, $metode_pembayaran, $tanggal)) {
        header("Location: td.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// Hapus
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteTD($koneksi, $id)) {
        header("Location: td.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

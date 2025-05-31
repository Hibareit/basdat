<?php
include "../koneksi.php";

// Fungsi CRUD
function insertTF($koneksi, $transaksi_id, $fasilitas_ruang_id, $durasi_jam) {
    $query = "INSERT INTO transaksi_fasilitas_ruang (transaksi_id, fasilitas_ruang_id, durasi_jam)
              VALUES ('$transaksi_id', '$fasilitas_ruang_id', '$durasi_jam')";
    return mysqli_query($koneksi, $query);
}

function updateTF($koneksi, $transaksi_id, $fasilitas_ruang_id, $fasilitas_ruang_id_new, $durasi_jam) {
    $query = "UPDATE transaksi_fasilitas_ruang SET
              fasilitas_ruang_id='$fasilitas_ruang_id_new',
              durasi_jam='$durasi_jam'
              WHERE transaksi_id=$transaksi_id AND fasilitas_ruang_id=$fasilitas_ruang_id";
    return mysqli_query($koneksi, $query);
}

function deleteTF($koneksi, $transaksi_id, $fasilitas_ruang_id) {
    $query = "DELETE FROM transaksi_fasilitas_ruang WHERE transaksi_id=$transaksi_id AND fasilitas_ruang_id=$fasilitas_ruang_id";
    return mysqli_query($koneksi, $query);
}

// Tambah
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_tf'])) {
    $transaksi_id = mysqli_real_escape_string($koneksi, $_POST["transaksi_id"]);
    $fasilitas_ruang_id = mysqli_real_escape_string($koneksi, $_POST["fasilitas_ruang_id"]);
    $durasi_jam = mysqli_real_escape_string($koneksi, $_POST["durasi_jam"]);

    if (insertTF($koneksi, $transaksi_id, $fasilitas_ruang_id, $durasi_jam)) {
        header("Location: tf.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_tf'])) {
    $transaksi_id = mysqli_real_escape_string($koneksi, $_POST["transaksi_id"]);
    $fasilitas_ruang_id = mysqli_real_escape_string($koneksi, $_POST["fasilitas_ruang_id"]);
    $fasilitas_ruang_id_new = mysqli_real_escape_string($koneksi, $_POST["fasilitas_ruang_id_new"]);
    $durasi_jam = mysqli_real_escape_string($koneksi, $_POST["durasi_jam"]);

    if (updateTF($koneksi, $transaksi_id, $fasilitas_ruang_id, $fasilitas_ruang_id_new, $durasi_jam)) {
        header("Location: tf.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// Hapus
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $transaksi_id = mysqli_real_escape_string($koneksi, $_GET["transaksi_id"]);
    $fasilitas_ruang_id = mysqli_real_escape_string($koneksi, $_GET["fasilitas_ruang_id"]);

    if (deleteTF($koneksi, $transaksi_id, $fasilitas_ruang_id)) {
        header("Location: tf.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

<?php
include "../koneksi.php";

// Fungsi CRUD
function insertRK($koneksi, $jenis_cidera, $penyakit, $trauma, $client_id) {
    $query = "INSERT INTO riwayat_kesehatan (jenis_cidera, penyakit, trauma, client_id, id)
              VALUES ('$jenis_cidera', '$penyakit', '$trauma', '$client_id', NULL)";
    return mysqli_query($koneksi, $query);
}

function updateRK($koneksi, $id, $jenis_cidera, $penyakit, $trauma, $client_id) {
    $query = "UPDATE riwayat_kesehatan SET
              jenis_cidera='$jenis_cidera',
              penyakit='$penyakit',
              trauma='$trauma',
              client_id='$client_id'
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deleteRK($koneksi, $id) {
    $query = "DELETE FROM riwayat_kesehatan WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// Tambah
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_rk'])) {
    $jenis_cidera = mysqli_real_escape_string($koneksi, $_POST["jenis_cidera"]);
    $penyakit = mysqli_real_escape_string($koneksi, $_POST["penyakit"]);
    $trauma = mysqli_real_escape_string($koneksi, $_POST["trauma"]);
    $client_id = mysqli_real_escape_string($koneksi, $_POST["client_id"]);

    if (insertRK($koneksi, $jenis_cidera, $penyakit, $trauma, $client_id)) {
        header("Location: rk.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_rk'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $jenis_cidera = mysqli_real_escape_string($koneksi, $_POST["jenis_cidera"]);
    $penyakit = mysqli_real_escape_string($koneksi, $_POST["penyakit"]);
    $trauma = mysqli_real_escape_string($koneksi, $_POST["trauma"]);
    $client_id = mysqli_real_escape_string($koneksi, $_POST["client_id"]);

    if (updateRK($koneksi, $id, $jenis_cidera, $penyakit, $trauma, $client_id)) {
        header("Location: rk.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// Hapus
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteRK($koneksi, $id)) {
        header("Location: rk.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

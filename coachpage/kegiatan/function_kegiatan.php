<?php
include "../../koneksi.php";

// FUNGSI
function insertKegiatan($koneksi, $durasi_kegiatan, $kegiatan, $nama) {
    $query = "INSERT INTO kegiatan (durasi_kegiatan, kegiatan, nama) 
              VALUES ('$durasi_kegiatan', '$kegiatan', '$nama')";
    return mysqli_query($koneksi, $query);
}

function updateKegiatan($koneksi, $id, $durasi_kegiatan, $kegiatan, $nama) {
    $query = "UPDATE kegiatan SET 
              durasi_kegiatan='$durasi_kegiatan', 
              kegiatan='$kegiatan', 
              nama='$nama' 
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deleteKegiatan($koneksi, $id) {
    $query = "DELETE FROM kegiatan WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_kegiatan'])) {
    $durasi_kegiatan = mysqli_real_escape_string($koneksi, $_POST["durasi_kegiatan"]);
    $kegiatan = mysqli_real_escape_string($koneksi, $_POST["kegiatan"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);

    if (insertKegiatan($koneksi, $durasi_kegiatan, $kegiatan, $nama)) {
        header("Location: kegiatan.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_kegiatan'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $durasi_kegiatan = (int)$_POST["durasi_kegiatan"]; // No need for isset() since it's required
    $kegiatan = mysqli_real_escape_string($koneksi, $_POST["kegiatan"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);

    if (updateKegiatan($koneksi, $id, $durasi_kegiatan, $kegiatan, $nama)) {
        header("Location: kegiatan.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}
// DELETE
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteKegiatan($koneksi, $id)) {
        header("Location: kegiatan.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
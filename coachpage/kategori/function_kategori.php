<?php
include "../../koneksi.php";

// FUNCTIONS
function insertKategoriCoach($koneksi, $keahlian, $jenis_kategori) {
    $query = "INSERT INTO kategori_coach (keahlian, jenis_kategori) 
              VALUES ('$keahlian', '$jenis_kategori')";
    return mysqli_query($koneksi, $query);
}

function updateKategoriCoach($koneksi, $id, $keahlian, $jenis_kategori) {
    $query = "UPDATE kategori_coach SET 
              keahlian='$keahlian', 
              jenis_kategori='$jenis_kategori' 
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deleteKategoriCoach($koneksi, $id) {
    $query = "DELETE FROM kategori_coach WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_kategori_coach'])) {
    $keahlian = mysqli_real_escape_string($koneksi, $_POST["keahlian"]);
    $jenis_kategori = mysqli_real_escape_string($koneksi, $_POST["jenis_kategori"]);

    if (insertKategoriCoach($koneksi, $keahlian, $jenis_kategori)) {
        header("Location: kategori.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_kategori_coach'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $keahlian = mysqli_real_escape_string($koneksi, $_POST["keahlian"]);
    $jenis_kategori = mysqli_real_escape_string($koneksi, $_POST["jenis_kategori"]);

    if (updateKategoriCoach($koneksi, $id, $keahlian, $jenis_kategori)) {
        header("Location: kategori.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// DELETE
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteKategoriCoach($koneksi, $id)) {
        header("Location: kategori.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

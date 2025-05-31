<?php
include "../koneksi.php";

// Fungsi CRUD
function insertProduk($koneksi, $nama, $harga, $jenis) {
    $query = "INSERT INTO produk (nama, harga, jenis)
              VALUES ('$nama', '$harga', '$jenis')";
    return mysqli_query($koneksi, $query);
}

function updateProduk($koneksi, $id, $nama, $harga, $jenis) {
    $query = "UPDATE produk SET
              nama='$nama',
              harga='$harga',
              jenis='$jenis'
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deleteProduk($koneksi, $id) {
    $query = "DELETE FROM produk WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// Tambah
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_produk'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $harga = mysqli_real_escape_string($koneksi, $_POST["harga"]);
    $jenis = mysqli_real_escape_string($koneksi, $_POST["jenis"]);

    if (insertProduk($koneksi, $nama, $harga, $jenis)) {
        header("Location: produk.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_produk'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $harga = mysqli_real_escape_string($koneksi, $_POST["harga"]);
    $jenis = mysqli_real_escape_string($koneksi, $_POST["jenis"]);

    if (updateProduk($koneksi, $id, $nama, $harga, $jenis)) {
        header("Location: produk.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// Hapus
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteProduk($koneksi, $id)) {
        header("Location: produk.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

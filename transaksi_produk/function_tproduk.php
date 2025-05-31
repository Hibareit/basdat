<?php
include "../koneksi.php";

// Fungsi CRUD
function insertTP($koneksi, $transaksi_id, $produk_id, $jumlah) {
    $query = "INSERT INTO transaksi_produk (transaksi_id, produk_id, jumlah)
              VALUES ('$transaksi_id', '$produk_id', '$jumlah')";
    return mysqli_query($koneksi, $query);
}

function updateTP($koneksi, $transaksi_id, $produk_id, $produk_id_new, $jumlah) {
    $query = "UPDATE transaksi_produk SET
              produk_id='$produk_id_new',
              jumlah='$jumlah'
              WHERE transaksi_id=$transaksi_id AND produk_id=$produk_id";
    return mysqli_query($koneksi, $query);
}

function deleteTP($koneksi, $transaksi_id, $produk_id) {
    $query = "DELETE FROM transaksi_produk WHERE transaksi_id=$transaksi_id AND produk_id=$produk_id";
    return mysqli_query($koneksi, $query);
}

// Tambah
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_tproduk'])) {
    $transaksi_id = mysqli_real_escape_string($koneksi, $_POST["transaksi_id"]);
    $produk_id = mysqli_real_escape_string($koneksi, $_POST["produk_id"]);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST["jumlah"]);

    if (insertTP($koneksi, $transaksi_id, $produk_id, $jumlah)) {
        header("Location: tproduk.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_tproduk'])) {
    $transaksi_id = mysqli_real_escape_string($koneksi, $_POST["transaksi_id"]);
    $produk_id = mysqli_real_escape_string($koneksi, $_POST["produk_id"]);
    $produk_id_new = mysqli_real_escape_string($koneksi, $_POST["produk_id_new"]);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST["jumlah"]);

    if (updateTP($koneksi, $transaksi_id, $produk_id, $produk_id_new, $jumlah)) {
        header("Location: tproduk.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// Hapus
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $transaksi_id = mysqli_real_escape_string($koneksi, $_GET["transaksi_id"]);
    $produk_id = mysqli_real_escape_string($koneksi, $_GET["produk_id"]);

    if (deleteTP($koneksi, $transaksi_id, $produk_id)) {
        header("Location: tproduk.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

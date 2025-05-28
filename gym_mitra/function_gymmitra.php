<?php
include "../koneksi.php";

// FUNGSI
function insertGymMitra($koneksi, $jenis, $nama, $lokasi) {
    $query = "INSERT INTO gym_mitra (jenis, nama, lokasi) 
              VALUES ('$jenis', '$nama', '$lokasi')";
    return mysqli_query($koneksi, $query);
}

function updateGymMitra($koneksi, $id, $jenis, $nama, $lokasi) {
    $query = "UPDATE gym_mitra SET 
              jenis='$jenis', 
              nama='$nama', 
              lokasi='$lokasi' 
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deleteGymMitra($koneksi, $id) {
    $query = "DELETE FROM gym_mitra WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_gym_mitra'])) {
    $jenis = mysqli_real_escape_string($koneksi, $_POST["jenis"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST["lokasi"]);

    if (insertGymMitra($koneksi, $jenis, $nama, $lokasi)) {
        header("Location: ../gym_mitra/gymmitra.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_gym_mitra'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $jenis = mysqli_real_escape_string($koneksi, $_POST["jenis"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST["lokasi"]);

    if (updateGymMitra($koneksi, $id, $jenis, $nama, $lokasi)) {
        header("Location: ../gym_mitra/gymmitra.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// DELETE
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteGymMitra($koneksi, $id)) {
        header("Location: ../gym_mitra/gymmitra.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

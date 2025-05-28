<?php
include "../koneksi.php";

// FUNGSI
function insertMembership($koneksi, $jenis, $biaya_membership, $nama, $waktu_mulai, $periode) {
    $query = "INSERT INTO membership (jenis, biaya_membership, nama, waktu_mulai, periode) 
              VALUES ('$jenis', '$biaya_membership', '$nama', '$waktu_mulai', '$periode')";
    return mysqli_query($koneksi, $query);
}

function updateMembership($koneksi, $id, $jenis, $biaya_membership, $nama, $waktu_mulai, $periode) {
    $query = "UPDATE membership SET 
              jenis='$jenis', 
              biaya_membership='$biaya_membership', 
              nama='$nama', 
              waktu_mulai='$waktu_mulai', 
              periode='$periode' 
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deleteMembership($koneksi, $id) {
    $query = "DELETE FROM membership WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_membership'])) {
    $jenis = mysqli_real_escape_string($koneksi, $_POST["jenis"]);
    $biaya_membership = mysqli_real_escape_string($koneksi, $_POST["biaya_membership"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $waktu_mulai = mysqli_real_escape_string($koneksi, $_POST["waktu_mulai"]);
    $periode = mysqli_real_escape_string($koneksi, $_POST["periode"]);

    if (insertMembership($koneksi, $jenis, $biaya_membership, $nama, $waktu_mulai, $periode)) {
        header("Location: ../membership/membership.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_membership'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $jenis = mysqli_real_escape_string($koneksi, $_POST["jenis"]);
    $biaya_membership = mysqli_real_escape_string($koneksi, $_POST["biaya_membership"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $waktu_mulai = mysqli_real_escape_string($koneksi, $_POST["waktu_mulai"]);
    $periode = mysqli_real_escape_string($koneksi, $_POST["periode"]);

    if (updateMembership($koneksi, $id, $jenis, $biaya_membership, $nama, $waktu_mulai, $periode)) {
        header("Location: ../membership/membership.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// DELETE
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteMembership($koneksi, $id)) {
        header("Location: ../membership/membership.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

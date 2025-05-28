<?php
include "../koneksi.php";

// FUNGSI
function insertOfficeBoy($koneksi, $nama, $tanggal_lahir) {
    $query = "INSERT INTO office_boy (nama, tanggal_lahir) 
              VALUES ('$nama', '$tanggal_lahir')";
    return mysqli_query($koneksi, $query);
}

function updateOfficeBoy($koneksi, $id, $nama, $tanggal_lahir) {
    $query = "UPDATE office_boy SET 
              nama='$nama', 
              tanggal_lahir='$tanggal_lahir' 
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deleteOfficeBoy($koneksi, $id) {
    $query = "DELETE FROM office_boy WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_office_boy'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST["tanggal_lahir"]);

    if (insertOfficeBoy($koneksi, $nama, $tanggal_lahir)) {
        header("Location: ../office_boy/officeboy.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_office_boy'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST["tanggal_lahir"]);

    if (updateOfficeBoy($koneksi, $id, $nama, $tanggal_lahir)) {
        header("Location: ../office_boy/officeboy.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// DELETE
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteOfficeBoy($koneksi, $id)) {
        header("Location: ../office_boy/officeboy.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

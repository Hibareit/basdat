<?php
include "../../koneksi.php";

// FUNCTIONS
function insertPenghargaan($koneksi, $coach_id, $sertifikat_keahlian) {
    $query = "INSERT INTO penghargaan (coach_id, sertifikat_keahlian) 
              VALUES ('$coach_id', '$sertifikat_keahlian')";
    return mysqli_query($koneksi, $query);
}

function updatePenghargaan($koneksi, $id, $coach_id, $sertifikat_keahlian) {
    $query = "UPDATE penghargaan SET 
              coach_id='$coach_id', 
              sertifikat_keahlian='$sertifikat_keahlian' 
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deletePenghargaan($koneksi, $id) {
    $query = "DELETE FROM penghargaan WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_penghargaan'])) {
    $coach_id = isset($_POST["coach_id"]) ? mysqli_real_escape_string($koneksi, $_POST["coach_id"]) : null;
    $sertifikat_keahlian = mysqli_real_escape_string($koneksi, $_POST["sertifikat_keahlian"]);

    if (insertPenghargaan($koneksi, $coach_id, $sertifikat_keahlian)) {
        header("Location: penghargaan.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_penghargaan'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $coach_id = isset($_POST["coach_id"]) ? mysqli_real_escape_string($koneksi, $_POST["coach_id"]) : null;
    $sertifikat_keahlian = mysqli_real_escape_string($koneksi, $_POST["sertifikat_keahlian"]);

    if (updatePenghargaan($koneksi, $id, $coach_id, $sertifikat_keahlian)) {
        header("Location: penghargaan.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// DELETE
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deletePenghargaan($koneksi, $id)) {
        header("Location: penghargaan.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

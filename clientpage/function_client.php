<?php
include "../koneksi.php";

// FUNGSI
function insertClient($koneksi, $nama, $gender, $weight, $pengalaman, $coach_id = null) {
    $query = "INSERT INTO client (nama, gender, weight, pengalaman, coach_id) 
              VALUES ('$nama', '$gender', '$weight', '$pengalaman', " . ($coach_id ?: 'NULL') . ")";
    return mysqli_query($koneksi, $query);
}

function updateClient($koneksi, $id, $nama, $gender, $weight, $pengalaman, $coach_id = null) {
    $query = "UPDATE client SET 
              nama='$nama', 
              gender='$gender', 
              weight='$weight', 
              pengalaman='$pengalaman', 
              coach_id=" . ($coach_id ?: 'NULL') . "
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deleteClient($koneksi, $id) {
    $query = "DELETE FROM client WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_client'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $gender = mysqli_real_escape_string($koneksi, $_POST["gender"]);
    $weight = mysqli_real_escape_string($koneksi, $_POST["weight"]);
    $pengalaman = mysqli_real_escape_string($koneksi, $_POST["pengalaman"]);
    $coach_id = isset($_POST["coach_id"]) ? mysqli_real_escape_string($koneksi, $_POST["coach_id"]) : null;

    if (insertClient($koneksi, $nama, $gender, $weight, $pengalaman, $coach_id)) {
        header("Location: ../clientpage/client.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_client'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $gender = mysqli_real_escape_string($koneksi, $_POST["gender"]);
    $weight = mysqli_real_escape_string($koneksi, $_POST["weight"]);
    $pengalaman = mysqli_real_escape_string($koneksi, $_POST["pengalaman"]);
    $coach_id = isset($_POST["coach_id"]) ? mysqli_real_escape_string($koneksi, $_POST["coach_id"]) : null;

    if (updateClient($koneksi, $id, $nama, $gender, $weight, $pengalaman, $coach_id)) {
        header("Location: ../clientpage/coach.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// DELETE
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteClient($koneksi, $id)) {
        header("Location: ../clientpage/client.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>
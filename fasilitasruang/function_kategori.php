<?php
include "../koneksi.php";

// FUNGSI
function insertCoach($koneksi, $nama, $tanggal_lahir, $pengalaman, $kategori_coach_id, $kegiatan_id = null) {
    $query = "INSERT INTO coach (nama, tanggal_lahir, pengalaman, kategori_coach_id, kegiatan_id) 
              VALUES ('$nama', '$tanggal_lahir', '$pengalaman', '$kategori_coach_id', " . ($kegiatan_id ?: 'NULL') . ")";
    return mysqli_query($koneksi, $query);
}

function updateCoach($koneksi, $id, $nama, $tanggal_lahir, $pengalaman, $kategori_coach_id, $kegiatan_id = null) {
    $query = "UPDATE coach SET 
              nama='$nama', 
              tanggal_lahir='$tanggal_lahir', 
              pengalaman='$pengalaman', 
              kategori_coach_id='$kategori_coach_id', 
              kegiatan_id=" . ($kegiatan_id ?: 'NULL') . "
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deleteCoach($koneksi, $id) {
    $query = "DELETE FROM coach WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_coach'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST["tanggal_lahir"]);
    $pengalaman = mysqli_real_escape_string($koneksi, $_POST["pengalaman"]);
    $kategori_coach_id = mysqli_real_escape_string($koneksi, $_POST["kategori_coach_id"]);
    $kegiatan_id = isset($_POST["kegiatan_id"]) ? mysqli_real_escape_string($koneksi, $_POST["kegiatan_id"]) : null;

    if (insertCoach($koneksi, $nama, $tanggal_lahir, $pengalaman, $kategori_coach_id, $kegiatan_id)) {
        header("Location: ../coachpage/coach.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_coach'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST["tanggal_lahir"]);
    $pengalaman = mysqli_real_escape_string($koneksi, $_POST["pengalaman"]);
    $kategori_coach_id = mysqli_real_escape_string($koneksi, $_POST["kategori_coach_id"]);
    $kegiatan_id = isset($_POST["kegiatan_id"]) ? mysqli_real_escape_string($koneksi, $_POST["kegiatan_id"]) : null;

    if (updateCoach($koneksi, $id, $nama, $tanggal_lahir, $pengalaman, $kategori_coach_id, $kegiatan_id)) {
        header("Location: ../coachpage/coach.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// DELETE
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteCoach($koneksi, $id)) {
        header("Location: ../coachpage/coach.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

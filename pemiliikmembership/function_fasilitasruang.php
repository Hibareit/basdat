<?php
include "../koneksi.php";

// FUNGSI
function insertFasilitasRuang($koneksi, $nama, $jenis, $kegiatan_id = null, $office_boy_id) {
    $query = "INSERT INTO fasilitas_ruang (nama, jenis, kegiatan_id, office_boy_id) 
              VALUES ('$nama', '$jenis', " . ($kegiatan_id ?: 'NULL') . ", '$office_boy_id')";
    return mysqli_query($koneksi, $query);
}

function updateFasilitasRuang($koneksi, $id, $nama, $jenis, $kegiatan_id = null, $office_boy_id) {
    $query = "UPDATE fasilitas_ruang SET 
              nama='$nama', 
              jenis='$jenis', 
              kegiatan_id=" . ($kegiatan_id ?: 'NULL') . ", 
              office_boy_id='$office_boy_id' 
              WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

function deleteFasilitasRuang($koneksi, $id) {
    $query = "DELETE FROM fasilitas_ruang WHERE id=$id";
    return mysqli_query($koneksi, $query);
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_fasilitas'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $jenis = mysqli_real_escape_string($koneksi, $_POST["jenis"]);
    $kegiatan_id = isset($_POST["kegiatan_id"]) ? mysqli_real_escape_string($koneksi, $_POST["kegiatan_id"]) : null;
    $office_boy_id = mysqli_real_escape_string($koneksi, $_POST["office_boy_id"]);

    if (insertFasilitasRuang($koneksi, $nama, $jenis, $kegiatan_id, $office_boy_id)) {
        header("Location: ../fasilitaspage/fasilitas.php");
        exit;
    } else {
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_fasilitas'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST["id"]);
    $nama = mysqli_real_escape_string($koneksi, $_POST["nama"]);
    $jenis = mysqli_real_escape_string($koneksi, $_POST["jenis"]);
    $kegiatan_id = isset($_POST["kegiatan_id"]) ? mysqli_real_escape_string($koneksi, $_POST["kegiatan_id"]) : null;
    $office_boy_id = mysqli_real_escape_string($koneksi, $_POST["office_boy_id"]);

    if (updateFasilitasRuang($koneksi, $id, $nama, $jenis, $kegiatan_id, $office_boy_id)) {
        header("Location: ../fasilitasruang/fasilitas.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// DELETE
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteFasilitasRuang($koneksi, $id)) {
        header("Location: ../fasilitasruang/fasilitas.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

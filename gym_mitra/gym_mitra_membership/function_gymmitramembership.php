<?php
include "../../koneksi.php";

// FUNGSI
function insertGymMitraMembership($koneksi, $gym_mitra_id, $membership_id) {
    $query = "INSERT INTO gym_mitra_membership (gym_mitra_id, membership_id) 
              VALUES ('$gym_mitra_id', '$membership_id')";
    return mysqli_query($koneksi, $query);
}

function updateGymMitraMembership($koneksi, $gym_mitra_id, $membership_id) {
    // Hapus relasi lama
    mysqli_query($koneksi, "DELETE FROM gym_mitra_membership WHERE gym_mitra_id = $gym_mitra_id");
    // Tambahkan relasi baru
    return insertGymMitraMembership($koneksi, $gym_mitra_id, $membership_id);
}

function deleteGymMitraMembership($koneksi, $gym_mitra_id) {
    $query = "DELETE FROM gym_mitra_membership WHERE gym_mitra_id = $gym_mitra_id";
    return mysqli_query($koneksi, $query);
}

<?php
include "../../koneksi.php";

// FUNGSI
function insertGymMitraMembership($koneksi, $gym_mitra_id, $membership_id) {
    // Cek dulu apakah data sudah ada
    $check_query = "SELECT * FROM gym_mitra_membership 
                   WHERE gym_mitra_id = '$gym_mitra_id' AND membership_id = '$membership_id'";
    $result = mysqli_query($koneksi, $check_query);
    
    if (mysqli_num_rows($result) > 0) {
        // Jika data sudah ada, return false
        return false;
    }
    
    // Jika data belum ada, lakukan insert
    $query = "INSERT INTO gym_mitra_membership (gym_mitra_id, membership_id) 
              VALUES ('$gym_mitra_id', '$membership_id')";
    return mysqli_query($koneksi, $query);
}

// INSERT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_gym_mitra_membership'])) {
    $gym_mitra_id = mysqli_real_escape_string($koneksi, $_POST["gym_mitra_id"]);
    $membership_id = mysqli_real_escape_string($koneksi, $_POST["membership_id"]);

    $insert_result = insertGymMitraMembership($koneksi, $gym_mitra_id, $membership_id);
    
    if ($insert_result === false) {
        // Data sudah ada, tampilkan pesan error
        echo "<script>
                alert('Data sudah pernah ditambahkan! Kombinasi Gym Mitra dan Membership ini sudah ada.');
                window.history.back();
              </script>";
    } elseif ($insert_result) {
        // Berhasil ditambahkan
        header("Location: ../gymmitra.php");
        exit;
    } else {
        // Error lainnya
        echo "Data gagal disimpan: " . mysqli_error($koneksi);
    }
}

// ... [kode lainnya tetap sama]
?>
// EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_gym_mitra_membership'])) {
    $gym_mitra_id = mysqli_real_escape_string($koneksi, $_POST["gym_mitra_id"]);
    $membership_id = mysqli_real_escape_string($koneksi, $_POST["membership_id"]);

    if (updateGymMitraMembership($koneksi, $gym_mitra_id, $membership_id)) {
       header("Location: ../gymmitra.php");
        exit;
    } else {
        echo "Data gagal diubah: " . mysqli_error($koneksi);
    }
}

// DELETE
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $gym_mitra_id = mysqli_real_escape_string($koneksi, $_GET["id"]);

    if (deleteGymMitraMembership($koneksi, $gym_mitra_id)) {
        header("Location: ../gymmitra.php");
        exit;
    } else {
        echo "Data gagal dihapus: " . mysqli_error($koneksi);
    }
}
?>

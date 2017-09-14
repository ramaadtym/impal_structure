<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: ../../");
    } elseif ($_SESSION['user_level'] != "Administrator") {
        $cek_level = $_SESSION['user_level'];
        if ($cek_level == "Tutor") {
            header("Location: ../../tutor");
        } elseif ($cek_level == "Mahasiswa") {
            header("Location: ../../mahasiswa");
        }
    }
?>
<?php
    require '../../koneksi.php';

    if (!isset($_GET['id'])) {
        echo '<script>alert("Presensi Tidak Sesuai!");window.location.href=\'../presensi\';</script>';
    } else {
        $id = $_GET['id'];
        $sql = "SELECT id_absensi
                FROM absensi
                WHERE id_absensi='$id' AND status_acc='Pending'";
        $query = mysqli_query($connect, $sql);

        $hasil = mysqli_num_rows($query);

        if ($hasil != 0) {
            $sql = "DELETE
                    FROM absensi
                    WHERE id_absensi='$id'";
            $query = mysqli_query($connect, $sql);
            if ($query) {
                echo '<script>alert("Presensi Berhasil Dihapus!");window.location.href=\'../administrasi/presensi\';</script>';
            } else {
                echo '<script>alert("Presensi Gagal Dihapus!");window.location.href=\'../administrasi/presensi\';</script>';
            }

        } else {
            echo '<script>alert("Presensi Gagal Dihapus karena telah di ACC!");window.location.href=\'../administrasi/presensi\';</script>';
        }
    }
?>
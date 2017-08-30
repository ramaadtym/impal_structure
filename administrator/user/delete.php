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

    $access = $_SESSION['nim'];

    if (!isset($_GET['nim'])) {
        echo '<script>alert("NIM Tidak Sesuai!");window.location.href=\'../user\';</script>';
    } else {
        if ($access == $_GET['nim'] || $access == 1301154374) {
            $nim = $_GET['nim'];
            $sql = "DELETE
                FROM user
                WHERE nim='$nim'";
            $query = mysqli_query($connect, $sql);
            if ($query && $access == $_GET['nim']) {
                echo '<script>alert("Akun anda Berhasil Dihapus! Good bye :p ");window.location.href=\'../../logout.php\';</script>';
            } elseif ($access == 1301154374) {
                echo '<script>alert("User Berhasil Dihapus!");window.location.href=\'../user\';</script>';
            } else {
                echo '<script>alert("User Gagal Dihapus!");window.location.href=\'../user\';</script>';
            }
        } else {
            echo '<script>alert("Mohon maaf, anda bukan Super Admin!");window.location.href=\'../user\';</script>';
        }
    }
?>
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

    if (!isset($_GET['kode'])) {
        echo '<script>alert("Kode Kelas Tidak Sesuai!");window.location.href=\'../kelas\';</script>';
    } else {
        $kode = $_GET['kode'];
        $sql = "DELETE
                FROM kelas
                WHERE kode_kelas='$kode'";
        $query = mysqli_query($connect, $sql);
        if ($query) {
            echo '<script>alert("Kelas Berhasil Dihapus!");window.location.href=\'../kelas\';</script>';
        } else {
            echo '<script>alert("Kelas Gagal Dihapus!");window.location.href=\'../kelas\';</script>';
        }
    }
?>
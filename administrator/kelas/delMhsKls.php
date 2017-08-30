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

    if (!isset($_GET['kode']) && !isset($_GET['nim'])) {
        echo '<script>alert("Kode Kelas / NIM Tidak Sesuai!");window.location.href=\'../kelas\';</script>';
    } else {
        $kode = $_GET['kode'];
        $nim = $_GET['nim'];

        $sql_search = "SELECT * FROM detail_kelas WHERE kode_kelas='$kode' AND nim='$nim'";
        $query = mysqli_query($connect, $sql_search);

        if (mysqli_num_rows($query) >= 1) {
            $sql = "DELETE
                    FROM detail_kelas
                    WHERE kode_kelas='$kode' AND nim='$nim'";
            $query = mysqli_query($connect, $sql);
            if ($query) {
                echo '<script>alert("Data Berhasil Dihapus!");window.location.href=\'../kelas\';</script>';
            } else {
                echo '<script>alert("Data Gagal Dihapus!");window.location.href=\'../kelas\';</script>';
            }
        } else {
            echo '<script>alert("Data Gagal Dihapus!");window.location.href=\'../kelas\';</script>';
        }
    }
?>
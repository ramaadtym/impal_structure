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
        echo '<script>alert("Kode Matkul Tidak Sesuai!");window.location.href=\'../matkul\';</script>';
    } else {
        $kode = $_GET['kode'];
        $sql = "DELETE
                FROM matkul
                WHERE kode_matkul='$kode'";
        $query = mysqli_query($connect, $sql);
        if ($query) {
            echo '<script>alert("Mata Kuliah Berhasil Dihapus!");window.location.href=\'../matkul\';</script>';
        } else {
            echo '<script>alert("Mata Kuliah Gagal Dihapus!");window.location.href=\'../matkul\';</script>';
        }
    }
?>
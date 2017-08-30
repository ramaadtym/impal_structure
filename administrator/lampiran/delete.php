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
        echo '<script>alert("ID File Tidak Sesuai!");window.location.href=\'../lampiran\';</script>';
    } else {
        $id = $_GET['id'];

        $query = mysqli_query($connect,"SELECT file FROM lampiran WHERE id='$id'");
        $file = mysqli_fetch_array($query);

        $file_name = $file['file'];
        unlink("../../upload/".$file_name);

        $sql = "DELETE
                FROM lampiran
                WHERE id='$id'";

        $query = mysqli_query($connect, $sql);
        if ($query) {
            echo '<script>alert("File Berhasil Dihapus!");window.location.href=\'../lampiran\';</script>';
        } else {
            echo '<script>alert("File Gagal Dihapus!");window.location.href=\'../lampiran\';</script>';
        }
    }
?>
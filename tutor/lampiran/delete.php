<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: ../../");
    } elseif ($_SESSION['user_level'] != "Tutor") {
        $cek_level = $_SESSION['user_level'];
        if ($cek_level == "Administrator") {
            header("Location: ../../administrator");
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
        $nim = $_SESSION['nim'];

        $sql_search = "SELECT file FROM lampiran WHERE id='$id' AND uploader='$nim'";
        $query = mysqli_query($connect, $sql_search);

        $file = mysqli_fetch_array($sql_search);
        $file_name = $file['file'];

        unlink("../../upload/".$file_name);

        if (mysqli_num_rows($query) >= 1) {
            $sql = "DELETE
                FROM lampiran
                WHERE id='$id' AND uploader='$nim'";
            $query = mysqli_query($connect, $sql);
            if ($query) {
                echo '<script>alert("Data Berhasil Dihapus!");window.location.href=\'../lampiran\';</script>';
            } else {
                echo '<script>alert("Data Gagal Dihapus!");window.location.href=\'../lampiran\';</script>';
            }
        } else {
            echo '<script>alert("Data Gagal Dihapus!");window.location.href=\'../lampiran\';</script>';
        }
    }
?>
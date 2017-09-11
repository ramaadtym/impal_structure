<?php
    session_start();

    if (isset($_GET["login"]) && $_GET["login"] == "masuk"){
        login();
    }
    if (isset($_GET["logout"]) && $_GET["logout"] == "keluar"){
        logout();
    }
    function login(){
            include("../koneksi.php");
            $username = $_POST['username'];
            $password = sha1($_POST['password']);
            date_default_timezone_set('Asia/Jakarta');
            $last_login = date('Y-m-d H:i:s');

            $sql = "SELECT u.username username, u.password password, u.nim nim, u.user_level user_level, d.nama nama 
                FROM user u
                JOIN detil_user d USING (nim)
                WHERE (u.nim='$username' OR u.username = '$username') AND u.password = '$password'";
            $query = mysqli_query($connect, $sql);

            if (mysqli_num_rows($query) == 0) {
                echo '<script>alert("Username/Password Salah!"); window.location.href = \'../index.php\';</script>';
            } else {
                $user = mysqli_fetch_assoc($query);

                $_SESSION['username'] = $username;
                $_SESSION['nim'] = $user['nim'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['user_level'] = $user['user_level'];
                $cek_level = $_SESSION['user_level'];

                $nim = $user['nim'];

                $sql = "UPDATE user SET last_login = '$last_login'
                    WHERE nim = '$nim'";
                $query = mysqli_query($connect, $sql);

                if ($cek_level == "Administrator") {
                    //header("Location: administrator");
                    echo '<script>$(\'#sukses\').show();window.location.href=\'administrator\';</script>';
                } elseif ($cek_level == "Tutor") {
                    $nim = $user['nim'];
                    $sql = "SELECT kode_tutor
                        FROM tutor
                        WHERE nim = '$nim'";
                    $query = mysqli_query($connect, $sql);
                    $tutor = mysqli_fetch_assoc($query);
                    $_SESSION['kode_tutor'] = $tutor['kode_tutor'];
                    //header("Location: tutor");
                    echo '<script>$(\'#sukses\').show();window.location.href=\'tutor\';</script>';
                } elseif ($cek_level == "Mahasiswa") {
                    header("Location: ../mahasiswa");
                } else {
                    session_destroy();
                    die("Username/Password Salah!");
                }
            }
    }
    function logout(){
        session_start();
        session_destroy();
        header("Location: ../index.php");
    }

?>
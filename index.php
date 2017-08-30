<?php
    session_start();
    if ($_SESSION) {
        $cek_level = $_SESSION['user_level'];
        if ($cek_level == "Administrator") {
            header("Location: administrator");
        } elseif ($cek_level == "Tutor") {
            header("Location: tutor");
        } elseif ($cek_level == "Mahasiswa") {
            header("Location: mahasiswa");
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sistem Informasi BIMA</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="animated tada logo">
            <a href="javascript:void(0);"><img src="images/logo.png" width="200" height="230" /></a>
        </div>
        <div class="animated flipInX card">
            <div class="alert alert-success" id="sukses" style="display:none;">
                <strong>Login Sukses! Silakan tunggu...</strong>
            </div>
            <div class="alert alert-danger alert-dismissible" role="alert" id="gagal" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Username/Password Salah!
            </div>
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="NIM / Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2"></div>
                        <div class="col-xs-8">
                            <input class="btn btn-block bg-pink waves-effect" type="submit" value="LOG IN" name="login">
                        </div>
                        <div class="col-xs-2"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
</body>

</html>
<?php
    if (isset($_POST['login'])) {
        require ("koneksi.php");

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
            //echo '<script>alert("Username/Password Salah!");</script>';
            echo '<script>$(\'#gagal\').show();</script>';
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
                //header("Location: mahasiswa");
                echo '<script>$(\'#sukses\').show();window.location.href=\'mahasiswa\';</script>';
            } else {
                session_destroy();
                die("Username/Password Salah!");
            }
        }
    }
?>
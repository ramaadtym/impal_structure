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

    if (!isset($_SESSION['nim'])) {
        echo '<script>alert("NIM Tidak Sesuai");window.location.href=\'../tutor\';</script>';
    } else {
        $search = $_SESSION['nim'];
        $sql = "SELECT *
                FROM user u
                JOIN detil_user d ON (u.nim = d.nim)
                WHERE u.nim='$search'";
        $query = mysqli_query($connect, $sql);
        if (mysqli_num_rows($query) == 0) {
            echo '<script>alert("NIM Tidak Sesuai");window.location.href=\'../tutor\';</script>';

        }
        $user = mysqli_fetch_array($query);
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Dashboard - Profile</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="javascript:void(0);">BIMA - <?php echo strtoupper($_SESSION['user_level'])?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../../logout.php"><i class="material-icons">power_settings_new</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo strtoupper($_SESSION['nama'])?></div>
                    <div class="email"><?php echo $_SESSION['user_level']?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="../">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">local_library</i>
                            <span>Kelas</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../kelas">Data Kelas</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Presensi</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../presensi">Data Presensi</a>
                            </li>
                            <li>
                                <a href="../presensi/create.php">Tambah Presensi</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>Profile</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../profile">My Profile</a>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0);">Edit Profile</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">attachment</i>
                            <span>Lampiran</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../lampiran">Data Lampiran</a>
                            </li>
                            <li>
                                <a href="../lampiran/upload.php">Unggah Lampiran</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <?php include "../../footer.php"; ?>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
        </aside>
        <!-- #END# Right Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Input -->
            <form id="form_advanced_validation" method="POST">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    EDIT PROFILE
                                </h2>
                            </div>
                            <div class="body">
                                <h2 class="card-inside-title">Data Akun</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <label class="form-label">NIM</label>
                                            <div class="form-line">
                                                <input type="number" class="form-control" minlength="10" maxlength="10" name="nim" value="<?php echo $user['nim']?>" readonly>
                                            </div>
                                            <div class="help-info">Min. 10, Max. 10 characters</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <label class="form-label">Username</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" minlength="5" maxlength="255" name="username" value="<?php echo $user['username']?>">
                                                <?php $old_username = $user['username']; ?>
                                            </div>
                                            <div class="help-info">Min.5, Max. 255 characters</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <label class="form-label">Password</label>
                                            <a href="pass.php"><button type="button" class="btn btn-block btn-lg btn-warning waves-effect">Change Password</button></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <label class="form-label">Email</label>
                                            <div class="form-line">
                                                <input type="email" class="form-control" maxlength="255" name="email" value="<?php echo $user['email']?>">
                                                <div class="help-info">Max. 255 characters</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Tipe Akun</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <select class="form-control show-tick" name="user_level" required>
                                            <option value="">-- Pilih Tipe Akun --</option>
                                            <?php
                                            $tipe = ['Administrator', 'Tutor', 'Mahasiswa'];
                                            foreach ($tipe as $tipe) {
                                                echo "<option value='".$tipe."'";
                                                if ($user['user_level'] == $tipe) {
                                                    echo "selected";
                                                }
                                                echo ">";
                                                echo $tipe."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Nama Lengkap</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <label class="form-label">Nama Lengkap</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" maxlength="255" name="nama" value="<?php echo $user['nama']?>" required>
                                                <div class="help-info">Max. 255 characters</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Jenis Kelamin</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="demo-radio-button">
                                            <input name="jeniskelamin" type="radio" class="with-gap" id="laki-laki" value="Laki-laki" <?php if($user['jeniskelamin'] == 'Laki-laki') echo 'checked';?> />
                                            <label for="laki-laki">Laki - laki</label>
                                            <input name="jeniskelamin" type="radio" class="with-gap" id="perempuan" value="Perempuan" <?php if($user['jeniskelamin'] == 'Perempuan') echo 'checked';?> />
                                            <label for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Tanggal Lahir</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="datepicker form-control" name="tgl_lahir" placeholder="Please choose a date..." value="<?php echo $user['tgl_lahir']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Data Kampus</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <label class="form-label">Fakultas</label>
                                        <select class="selectpicker form-control show-tick" data-live-search="true" name="fakultas" required>
                                            <option value="">-- Pilih Fakultas --</option>
                                            <?php
                                            $fakultas = ['INFORMATIKA', 'TEKNIK ELEKTRO', 'REKAYASA INDUSTRI', 'EKONOMI DAN BISNIS', 'KOMUNIKASI DAN BISNIS', 'INDUSTRI KREATIF', 'ILMU TERAPAN', 'PASCASARJANA'];
                                            foreach ($fakultas as $fakultas) {
                                                echo "<option value='".$fakultas."'";
                                                if ($user['fakultas'] == $fakultas) {
                                                    echo "selected";
                                                }
                                                echo ">";
                                                echo $fakultas."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <label class="form-label">Jurusan</label>
                                            <select class="selectpicker form-control show-tick" data-live-search="true" name="jurusan" required>
                                                <option value="">-- Pilih Jurusan --</option>
                                                <?php
                                                $jurusan = ['S1 TEKNIK INFORMATIKA','S1 COMPUTATIONAL & DATA SCIENCE','S1 TEKNIK INFORMATIKA (LANJUTAN)','S1 TEKNIK INFORMATIKA (INTERNATIONAL CLASS)','S1 TEKNOLOGI INFORMASI','S1 TEKNIK TELEKOMUNIKASI','S1 TEKNIK ELEKTRO','S1 SISTEM  KOMPUTER','S1 TEKNIK FISIKA','S1 TEKNIK TELEKOMUNIKASI (LANJUTAN)','S1 SISTEM KOMPUTER (LANJUTAN)','S1 TEKNIK TELEKOMUNIKASI (INTERNATIONAL CLASS)','S1 TEKNIK INDUSTRI','S1 SISTEM INFORMASI','S1 TEKNIK INDUSTRI (INTERNATIONAL CLASS)','S1 SISTEM INFORMASI (INTERNATIONAL CLASS)','S1 INTERNATIONAL ICT BUSINESS','S1 MBTI','S1 AKUNTANSI','S1 AKUNTANSI (LANJUTAN)','S1 ILMU KOMUNIKASI','S1 ADMINISTRASI BISNIS','S1 ADMINISTRASI BISNIS (INTERNATIONAL CLASS)','S1 ADMINISTRASI BISNIS (LANJUTAN)','S1 DIGITAL PUBLIC RELATIONS','S1 ILMU KOMUNIKASI (INTERNATIONAL CLASS)','S1 DESAIN KOMUNIKASI VISUAL','S1 KRIYA TEKSTIL DAN MODE (FASHION DESAIN)','S1 DESAIN INTERIOR','S1 DESAIN PRODUK','S1 SENI RUPA INTERMEDIA','D3 TEKNIK TELEKOMUNIKASI','D3 TEKNIK INFORMATIKA','D3 MANAJEMEN PEMASARAN','D3 TEKNIK KOMPUTER','D3 MANAJEMEN INFORMATIKA','D3 KOMPUTERISASI AKUNTANSI','D3 PERHOTELAN','S1 TERAPAN MULTIMEDIA','S2 TEKNIK ELEKTRO-KOMUNIKASI','S2 TEKNIK INFORMATIKA','S2 TEKNIK INDUSTRI','S2 MANAJEMEN'];
                                                foreach ($jurusan as $jurusan) {
                                                    echo "<option value='".$jurusan."'";
                                                    if ($user['jurusan'] == $jurusan) {
                                                        echo "selected";
                                                    }
                                                    echo ">";
                                                    echo $jurusan."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-float">
                                            <label class="form-label">Kelas</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" maxlength="10" name="kelas" value="<?php echo $user['kelas']?>" required>
                                                <div class="help-info">Max. 10 characters</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="card-inside-title">Kontak</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group form-float">
                                            <label class="form-label">ID Line</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" maxlength="255" name="id_line" value="<?php echo $user['id_line']?>" required>
                                                <div class="help-info">Max. 255 characters</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-float">
                                            <label class="form-label">No HP</label>
                                            <div class="form-line">
                                                <input type="number" class="form-control" maxlength="13" name="telepon" value="<?php echo $user['telepon']?>" required>
                                                <div class="help-info">Max. 13 characters</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <input type="submit" name="submit" class="btn btn-block btn-lg bg-blue waves-effect">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- #END# Input -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="../../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="../../plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="../../plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>
    <script src="../../js/pages/forms/form-validation.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
</body>
</html>

<?php
    require '../../koneksi.php';
    if (isset($_POST['submit'])) {
        $nim = $_POST['nim'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $nama = strtoupper($_POST['nama']);
        $jeniskelamin = $_POST['jeniskelamin'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $fakultas = $_POST['fakultas'];
        $jurusan = $_POST['jurusan'];
        $kelas = $_POST['kelas'];
        $id_line = $_POST['id_line'];
        $telepon = $_POST['telepon'];

        //print_r($_POST);

        if ($username == $old_username) {
            $sql = "UPDATE user SET 
                username='$username',
                email='$email'
                WHERE nim='$nim';";

            $sql .= "UPDATE detil_user SET
                 nama='$nama',
                 jeniskelamin='$jeniskelamin',
                 tgl_lahir='$tgl_lahir',
                 fakultas='$fakultas',
                 jurusan='$jurusan',
                 kelas='$kelas',
                 id_line='$id_line',
                 telepon='$telepon'
                 WHERE nim='$nim';";

            $query = mysqli_multi_query($connect,$sql);

            if ($query) {
                echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../profile\';</script>';
            } else {
                echo '<script>alert("Data Gagal 1 disimpan");window.location.href=\'../profile\';</script>';
            }
            mysqli_close($connect);
        } else {
            //cek username
            $sql_search = "SELECT username
                    FROM user
                    WHERE username='$username'";
            $query = mysqli_query($connect, $sql_search);
            if (mysqli_num_rows($query) == 1) {
                echo '<script>alert("Username Telah Digunakan");window.location.href=\'../profile\';</script>';
            } else {
                $sql = "UPDATE user SET 
                username='$username',
                email='$email'
                WHERE nim='$nim';";

                $sql .= "UPDATE detil_user SET
                 nama='$nama',
                 jeniskelamin='$jeniskelamin',
                 tgl_lahir='$tgl_lahir',
                 fakultas='$fakultas',
                 jurusan='$jurusan',
                 kelas='$kelas',
                 id_line='$id_line',
                 telepon='$telepon'
                 WHERE nim='$nim';";

                $query = mysqli_multi_query($connect,$sql);

                if ($query) {
                    echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../profile\';</script>';
                } else {
                    echo '<script>alert("Data Gagal disimpan");window.location.href=\'../profile\';</script>';
                }
                mysqli_close($connect);
            }
        }
    }
?>
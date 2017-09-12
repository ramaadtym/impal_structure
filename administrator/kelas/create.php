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
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Dashboard - Kelas</title>
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
                    <li><a href="../logout.php"><i class="material-icons">power_settings_new</i></a></li>
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
                            <i class="material-icons">book</i>
                            <span>Mata Kuliah</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../matkul">Data Mata Kuliah</a>
                            </li>
                            <li>
                                <a href="../matkul/create.php">Tambah Mata Kuliah</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">people</i>
                            <span>Mahasiswa</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../mahasiswa">Data Mahasiswa</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">local_library</i>
                            <span>Kelas</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../kelas">Data Kelas</a>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0);">Tambah Kelas</a>
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
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">school</i>
                            <span>Tutor</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../tutor">Data Tutor</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">sentiment_very_satisfied</i>
                            <span>Users</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../user">Data User</a>
                            </li>
                            <li>
                                <a href="../user/create.php">Create User</a>
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
            <?php include '../../footer.php' ?>
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
            <form id="form_advanced_validation" action="../../fungsi/pendaftaran.php?addKelas=tambah" method="POST">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CREATE KELAS
                            </h2>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Data Kelas</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" minlength="4" maxlength="10" name="kode_kelas" required>
                                            <label class="form-label">Kode Kelas</label>
                                        </div>
                                        <div class="help-info">Min. 4, Max. 10 characters</div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label">Mata Kuliah</label>
                                    <select class="form-control show-tick" name="kode_matkul" required>
                                        <option value="">-- Pilih Mata Kuliah --</option>
                                        <?php
                                            $sql = "SELECT * FROM matkul";
                                            $matkul = mysqli_query($connect, $sql);
                                            if(mysqli_num_rows($matkul) == 0){
                                                echo '<option>-- Data Matkul Tidak Tersedia --</option>';
                                            } else {
                                                foreach ($matkul as $value) {
                                                    echo "<option value='".$value['kode_matkul']."'>".$value['nama_matkul']." (".$value['kode_matkul'].")"."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label">Tutor</label>
                                    <select class="form-control show-tick" name="kode_tutor" required>
                                        <option value="">-- Pilih Tutor --</option>
                                        <?php
                                        $sql = "
                                        SELECT *
                                        FROM user u
                                        JOIN detil_user d ON (u.nim = d.nim)
                                        JOIN tutor t ON (u.nim = t.nim)";
                                        $tutor = mysqli_query($connect, $sql);
                                        if(mysqli_num_rows($tutor) == 0){
                                            echo '<option>-- Data Tutor Tidak Tersedia --</option>';
                                        } else {
                                            foreach ($tutor as $value) {
                                                echo "<option value='".$value['kode_tutor']."'>".$value['nama']." (".$value['matkul1']." | ".$value['matkul2'].")"."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label class="form-label">Hari</label>
                                    <select class="form-control show-tick" name="hari" required>
                                        <option value="">-- Pilih Hari --</option>
                                        <?php
                                            $hari = ['SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU'];
                                            foreach ($hari as $hari) {
                                                echo "<option value='".$hari."'>".$hari."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Jam</label>
                                    <select class="form-control show-tick" name="jam" required>
                                        <option value="">-- Pilih Jam --</option>
                                        <?php
                                            $sesi = ['08.30 - 10.30', '10.30 - 12.30', '13.30 - 15.30', '15.30 - 17.30', '18.30 - 20.30'];
                                            foreach ($sesi as $jam) {
                                                echo "<option value='".$jam."'>".$jam."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <p>
                                        <b>Data Mahasiswa</b>
                                    </p>
                                    <select class="selectpicker form-control show-tick" data-live-search="true" data-max-options="5" name="data[]" multiple="multiple">
                                        <?php
                                        $sql = "
                                                SELECT *
                                                FROM user u
                                                JOIN detil_user d ON (u.nim = d.nim)
                                                WHERE user_level='Mahasiswa'";
                                        $mahasiswa = mysqli_query($connect, $sql);
                                        if(mysqli_num_rows($mahasiswa) == 0){
                                            echo '<option>-- Data Mahasiswa Tidak Tersedia --</option>';
                                        } else {
                                            foreach ($mahasiswa as $value) {
                                                echo "<option value='".$value['nim']."'>".$value['nama']."</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Group Line</label>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" maxlength="255" name="group_line" placeholder="ex : http://line.me/R/ti/g/_dQJisKKmf">
                                        </div>
                                        <div class="help-info">Max. 255 characters</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Tahun Ajaran</label>
                                    <select class="form-control show-tick" name="tahun" required>
                                        <option value="">-- Pilih Tahun Ajaran --</option>
                                        <?php
                                        $tahun = ['1617/1', '1617/2', '1718/1', '1718/2', '1819/1', '1819/2', '1920/1', '1920/2'];
                                        foreach ($tahun as $tahun) {
                                            echo "<option value='".$tahun."'>".$tahun."</option>";
                                        }
                                        ?>
                                    </select>
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


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
    <title>Dashboard - Presensi</title>
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
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">local_library</i>
                            <span>Kelas</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../kelas">Data Kelas</a>
                            </li>
                            <li>
                                <a href="../kelas/create.php">Tambah Kelas</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Presensi</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="active">
                                <a href="javascript:void(0);">Data Presensi</a>
                            </li>
                            <li>
                                <a href="create.php">Tambah Presensi</a>
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
            <!-- STEP 2 -->
            <?php if (isset($_GET["id"])){
                $id = $_GET['id'];
                $sql = "SELECT * 
                        FROM absensi a
                        JOIN matkul m ON (m.kode_matkul = a.kode_matkul)
                        WHERE id_absensi='$id'
                        ";
                $query = mysqli_query($connect, $sql);
                if (mysqli_num_rows($query) == 0) {
                    echo '<script>alert("Kode Kelas Tidak Sesuai!");window.location.href=\'../presensi\';</script>';
                }
                $presensi = mysqli_fetch_array($query);
                $kode = $presensi['kode_kelas'];
            ?>
            <form id="form_advanced_validation" method="POST" enctype="multipart/form-data">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DETAIL PRESENSI
                            </h2>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Data Kelas</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <?php echo "<input type='hidden' name='kode_kelas' class='form-control' value='$presensi[kode_kelas]'>" ?>
                                    <?php echo "<b>Kode Kelas : </b>".$presensi['kode_kelas']; ?>
                                </div>
                                <div class="col-sm-12">
                                    <?php echo "<input type='hidden' name='kode_matkul' class='form-control' value='$presensi[kode_matkul]'>" ?>
                                    <?php echo "<b>Mata Kuliah : </b>".$presensi['nama_matkul'].' ('.$presensi['kode_matkul'].')'; ?>
                                </div>
                                <div class="col-sm-12">
                                    <?php echo "<input type='hidden' name='kode_tutor' class='form-control' value=$presensi[kode_tutor]>"; ?>
                                    <?php echo "<b>Kode Tutor : </b>".$presensi['kode_tutor']; ?>
                                </div>
                            </div>
                            <h2 class="card-inside-title">Jadwal Utama</h2>
                            <?php
                            $sql = "SELECT hari, jam 
                                    FROM kelas
                                    WHERE kode_kelas='$kode'
                                    ";
                            $query = mysqli_query($connect, $sql);
                            $kelas = mysqli_fetch_array($query);
                            ?>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <?php echo "<b>Hari : </b>".$kelas['hari']; ?>
                                </div>
                                <div class="col-sm-12">
                                    <?php echo "<b>Jam : </b>".$kelas['jam']; ?>
                                </div>
                            </div>
                            <h2 class="card-inside-title">Pelaksanaan</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label class="form-label">Status Pertemuan</label>
                                    <div class="form-line">
                                        <?php echo $presensi['status_pertemuan']; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Tanggal</label>
                                    <div class="form-line">
                                        <?php echo $presensi['tanggal']; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Jam Mulai</label>
                                    <div class="form-line">
                                        <?php echo $presensi['waktu_mulai']; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Jam Selesai</label>
                                    <div class="form-line">
                                        <?php echo $presensi['waktu_selesai']; ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label">Tempat</label>
                                    <div class="form-line">
                                        <?php echo $presensi['tempat']; ?>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label">Catatan</label>
                                    <div class="form-line">
                                        <?php echo $presensi['catatan']; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Scan Absensi</label>
                                        <a href="../../images/presensi/<?php echo $presensi['img_absen']; ?>" data-sub-html="Demo Description" target="_blank">
                                            <img class="img-responsive thumbnail" src="../../images/presensi/<?php echo $presensi['img_absen']; ?>">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Foto Dokumentasi</label>
                                        <a href="../../images/dokumentasi/<?php echo $presensi['dokumentasi']; ?>" data-sub-html="Demo Description" target="_blank">
                                            <img class="img-responsive thumbnail" src="../../images/dokumentasi/<?php echo $presensi['dokumentasi']; ?>">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <h2 class="card-inside-title">Keterangan</h2>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <label class="form-label">Time Submit</label>
                                    <div class="form-line">
                                        <?php if (isset($presensi['time_submit'])) {echo $presensi['time_submit'];} else {echo '-';}  ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Time ACC</label>
                                    <div class="form-line">
                                        <?php if (isset($presensi['time_acc'])) {echo $presensi['time_acc'];} else {echo '-';}  ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Status ACC</label>
                                    <div class="form-line">
                                        <?php if (isset($presensi['status_acc'])) {echo $presensi['status_acc'];} else {echo '-';}  ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label">Admin ACC</label>
                                    <div class="form-line">
                                        <?php if (isset($presensi['admin_acc'])) {echo $presensi['admin_acc'];} else {echo '-';}  ?>
                                    </div>
                                </div>
                            </div>
                            <?php if ($presensi['status_acc'] != 'Sudah Diverifikasi') {  ?>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-block btn-lg bg-blue waves-effect">Verifikasi</button>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button class="btn btn-block btn-lg bg-green waves-effect">Cetak Presensi</button>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <!-- END STEP 2 -->
            <!-- STEP 1 -->
            <?php
                } else {
            ?>
            <form id="form_advanced_validation" method="GET">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    DETAIL PRESENSI
                                </h2>
                            </div>
                            <div class="body">
                                <h2 class="card-inside-title">Presensi</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <select class="form-control show-tick" name="id" required>
                                            <option value="">-- Pilih Presensi --</option>
                                            <?php
                                                $sql = "SELECT id_absensi from absensi ORDER BY id_absensi ASC";
                                                $presensi = mysqli_query($connect,$sql);
                                                if(mysqli_num_rows($presensi) == 0){
                                                    //echo '-- Data Kelas Tidak Tersedia --';
                                                } else {
                                                    foreach ($presensi as $value) {
                                                        echo "<option value='".$value['id_absensi']."'>".$value['id_absensi']."</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-block btn-lg bg-blue waves-effect">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <?php } ?>
            <!-- END STEP 2 -->
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

    <!-- Light Gallery Plugin Js -->
    <script src="../../plugins/light-gallery/js/lightgallery-all.js"></script>

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
    //verifikasi absen
    if (isset($_POST['submit'])) {
        $id = $_GET['id'];
        $admin_acc = $_SESSION['nama'];
        date_default_timezone_set('Asia/Jakarta');
        $time_acc = date('Y-m-d H:i:s');

        $sql = "UPDATE absensi SET admin_acc='$admin_acc', time_acc='$time_acc', status_acc='Sudah Diverifikasi' WHERE id_absensi='$id'";

        $query = mysqli_query($connect,$sql);
        if ($query) {
            echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../presensi\';</script>';
        } else {
            echo '<script>alert("Data Gagal disimpan");window.location.href=\'../presensi\';</script>';
        }
        mysqli_close($connect);
    }
?>
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
    $kode_tutor = $_SESSION['kode_tutor'];
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

    <!-- Wait Me Css -->
    <link href="../../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

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
                <li class="active">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">local_library</i>
                        <span>Kelas</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="active">
                            <a href="javascript:void(0);">Data Kelas</a>
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
                        <i class="material-icons">person</i>
                        <span>Profile</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="../profile">My Profile</a>
                        </li>
                        <li>
                            <a href="../profile/edit.php">Edit Profile</a>
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
</section>

<section class="content">
    <?php
        if (isset($_GET['kode'])) {
            $search = $_GET['kode'];
            $sql = "SELECT k.kode_kelas kode_kelas, m.nama_matkul nama_matkul, m.kode_matkul kode_matkul, k.kode_tutor kode_tutor, k.hari hari, k.jam jam, d.nama nama, k.group_line group_line, k.tahun tahun
                    FROM kelas k
                    JOIN tutor t ON (t.kode_tutor = k.kode_tutor)
                    JOIN matkul m ON (m.kode_matkul = k.kode_matkul)
                    JOIN user u ON (t.nim = u.nim)
                    JOIN detil_user d ON (u.nim = d.nim)
                    WHERE k.kode_kelas='$search' AND k.kode_tutor='$kode_tutor'";
            $query = mysqli_query($connect, $sql);
            if (mysqli_num_rows($query) == 0) {
                echo '<script>alert("Kode Kelas Tidak Sesuai");window.location.href=\'../kelas\';</script>';

            }
            $kelas = mysqli_fetch_array($query);
            $kode_kelas = $kelas['kode_kelas'];
    ?>
    <div class="container-fluid">
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DETAIL KELAS <?php echo $kelas['kode_kelas']?>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label class="form-label">Matakuliah</label>
                                <div class="form">
                                    <?php echo $kelas['nama_matkul'].' ('.$kelas['kode_matkul'].')'?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Tutor</label>
                                <div class="form">
                                    <?php echo $kelas['nama'].' ('.$kelas['kode_tutor'].')'?>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label class="form-label">Hari</label>
                                <div class="form">
                                    <?php echo $kelas['hari']?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Jam</label>
                                <div class="form">
                                    <?php echo $kelas['jam']?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Group Line</label>
                                <div class="form">
                                    <?php echo $kelas['group_line']?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Tahun Akademik</label>
                                <div class="form">
                                    <?php echo $kelas['tahun']?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DATA MAHASISWA KELAS <?php echo $kode_kelas ?>
                        </h2>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Kelas</th>
                                <th>Telepon</th>
                                <th>ID Line</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            // put your code here
                            require '../../koneksi.php';

                            $sql = "
                                SELECT *
                                FROM user u
                                JOIN detil_user d USING(nim)
                                JOIN detail_kelas k USING(nim)
                                WHERE kode_kelas='$kode_kelas'";

                            $kelas = mysqli_query($connect, $sql);
                            if(mysqli_num_rows($kelas) == 0){
                                //echo '<tr><td colspan="5"><em>Data Tidak Tersedia.</em></td></tr>';
                            } else {
                                foreach ($kelas as $value) {
                                    echo "
                                            <tr>
                                                <td>".$value['nim']."</td>
                                                <td>".$value['nama']."</td>
                                                <td>".$value['kelas']."</td>
                                                <td>".$value['telepon']."</td>
                                                <td>".$value['id_line']."</td>
                                            </tr>
                                        ";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DATA PRESENSI KELAS <?php echo $kode_kelas ?>
                        </h2>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertemuan</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Status ACC</th>
                                <th>Admin ACC</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            // put your code here
                            require '../../koneksi.php';

                            $sql = "SELECT * FROM absensi WHERE kode_kelas='$kode_kelas'";


                            $presensi = mysqli_query($connect, $sql);
                            if(mysqli_num_rows($presensi) == 0){
                                //echo '<tr><td colspan="15"><center>Data Tidak Tersedia.</center></td></tr>';
                            } else {
                                $i = 1;
                                foreach ($presensi as $value) {
                                    echo "
                                        <tr>
                                            <td>".$i."</td>
                                            <td>".$value['status_pertemuan']."</td>
                                            <td>".$value['tanggal']."</td>
                                            <td>".$value['waktu_mulai'].'-'.$value['waktu_selesai']."</td>
                                            <td>".$value['status_acc']."</td>
                                            <td>".$value['admin_acc']."</td>
                                            <td>
                                                <a href='../presensi/detail.php?id=$value[id_absensi]'>
                                                    <button type=\"button\" class=\"btn btn-default waves-effect\">
                                                        <i class=\"material-icons\">pageview</i>
                                                    </button>
                                                </a>
                                            </td>   
                                        </tr>
                                    ";
                                    $i++;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="container-fluid">
        <form id="form_advanced_validation" method="GET">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DETAIL KELAS
                            </h2>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Kelas</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <select class="form-control show-tick" name="kode" required>
                                        <option value="">-- Pilih Kelas --</option>
                                        <?php
                                            $sql = "SELECT kode_kelas from kelas WHERE kode_tutor='$kode_tutor' ORDER BY kode_kelas ASC";
                                            $kelas = mysqli_query($connect,$sql);
                                            if(mysqli_num_rows($kelas) == 0){
                                                //echo '-- Data Kelas Tidak Tersedia --';
                                            } else {
                                                foreach ($kelas as $value) {
                                                    echo "<option value='".$value['kode_kelas']."'>".$value['kode_kelas']."</option>";
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
    </div>
    <?php } ?>
</section>

<!-- Jquery Core Js -->
<script src="../../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../../plugins/node-waves/waves.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

<!-- Custom Js -->
<script src="../../js/admin.js"></script>
<script src="../../js/pages/tables/jquery-datatable.js"></script>

<!-- Demo Js -->
<script src="../../js/demo.js"></script>
</body>

</html>
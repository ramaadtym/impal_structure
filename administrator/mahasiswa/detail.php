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
                <li class="active">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">people</i>
                        <span>Mahasiswa</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="active">
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
                            <a href="create.php">Tambah Kelas</a>
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
        <?php include "../../footer.php"; ?>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>

<section class="content">
    <?php
        if (isset($_GET['nim'])) {
            $search = $_GET['nim'];
            $sql = "SELECT *
                    FROM user
                    JOIN detil_user USING (nim)
                    WHERE user_level='Mahasiswa' AND nim='$search'";
            $query = mysqli_query($connect, $sql);
            if (mysqli_num_rows($query) == 0) {
                echo '<script>alert("NIM Tidak Sesuai");window.location.href=\'../mahasiswa\';</script>';

            }
            $mahasiswa = mysqli_fetch_array($query);
            $nim = $mahasiswa['nim'];
    ?>
    <div class="container-fluid">
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DATA <?php echo $mahasiswa['nama'].' ('.$mahasiswa['nim'].')'?>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label class="form-label">NIM</label>
                                <div class="form">
                                    <?php echo $mahasiswa['nim'] ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Nama</label>
                                <div class="form">
                                    <?php echo $mahasiswa['nama'] ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Username</label>
                                <div class="form">
                                    <?php echo $mahasiswa['username'] ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">E-Mail</label>
                                <div class="form">
                                    <?php echo $mahasiswa['email'] ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <div class="form">
                                    <?php echo $mahasiswa['tgl_lahir'] ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="form">
                                    <?php echo $mahasiswa['jeniskelamin'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <label class="form-label">ID Line</label>
                                <div class="form">
                                    <?php echo $mahasiswa['id_line'] ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">No HP</label>
                                <div class="form">
                                    <?php echo $mahasiswa['telepon'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <label class="form-label">Fakultas</label>
                                <div class="form">
                                    <?php echo $mahasiswa['fakultas'] ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Jurusan</label>
                                <div class="form">
                                    <?php echo $mahasiswa['jurusan'] ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label">Kelas</label>
                                <div class="form">
                                    <?php echo $mahasiswa['kelas'] ?>
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
                            JADWAL <?php echo $mahasiswa['nama'].' ('.$mahasiswa['nim'].')'?>
                        </h2>
                    </div>
                    <div class="body">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                            <tr>
                                <th>Kode Kelas</th>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Kode Tutor</th>
                                <th>Nama Tutor</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            // put your code here
                            require '../../koneksi.php';

                            $sql = "
                            SELECT k.kode_kelas kode_kelas, m.nama_matkul nama_matkul, k.kode_tutor kode_tutor, k.hari hari, k.jam jam, d.nama nama
                            FROM kelas k
                            JOIN tutor t ON (t.kode_tutor = k.kode_tutor)
                            JOIN matkul m ON (m.kode_matkul = k.kode_matkul)
                            JOIN user u ON (t.nim = u.nim)
                            JOIN detil_user d ON (u.nim = d.nim)
                            WHERE k.kode_kelas IN (
                              SELECT kode_kelas from detail_kelas WHERE nim='$nim'
                            )";

                            $kelas = mysqli_query($connect, $sql);
                            if(mysqli_num_rows($kelas) == 0){
                                //echo '<tr><td colspan="5"><em>Data Tidak Tersedia.</em></td></tr>';
                            } else {
                                foreach ($kelas as $value) {
                                    echo "
                                            <tr>
                                                <td>".$value['kode_kelas']."</td>
                                                <td>".$value['hari']."</td>                                        
                                                <td>".$value['jam']."</td>                                        
                                                <td>".$value['kode_tutor']."</td>
                                                <td>".$value['nama']."</td>
                                                <td>
                                                    <a href='../kelas/detail.php?kode=$value[kode_kelas]'>
                                                        <button type=\"button\" class=\"btn btn-default waves-effect\">
                                                            <i class=\"material-icons\">pageview</i>
                                                        </button>
                                                    </a>
                                                </td>
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
    <?php } else { ?>
    <div class="container-fluid">
        <form id="form_advanced_validation" method="GET">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DETAIL MAHASISWA
                            </h2>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Nama Mahasiswa</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <select class="selectpicker form-control show-tick" data-live-search="true" name="nim" required>
                                        <option value="">-- Pilih Mahasiswa --</option>
                                        <?php
                                            $sql = "SELECT u.nim nim, d.nama nama 
                                                    FROM user u 
                                                    JOIN detil_user d ON (u.nim = d.nim)
                                                    WHERE u.user_level='Mahasiswa'
                                                    ORDER BY nama ASC";
                                            $mahasiswa = mysqli_query($connect,$sql);
                                            if(mysqli_num_rows($mahasiswa) == 0){
                                                //echo '-- Data Mahasiswa Tidak Tersedia --';
                                            } else {
                                                foreach ($mahasiswa as $value) {
                                                    echo "<option value='".$value['nim']."'>".$value['nama']."</option>";
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
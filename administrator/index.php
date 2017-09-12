<?php
    session_start();
    if (empty($_SESSION)) {
        header("Location: ../");
    } elseif ($_SESSION['user_level'] != "Administrator") {
        $cek_level = $_SESSION['user_level'];
        if ($cek_level == "Tutor") {
            header("Location: ../tutor");
        } elseif ($cek_level == "Mahasiswa") {
            header("Location: ../mahasiswa");
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
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
                <li><a href="../fungsi/pendaftaran.php?logout=keluar"><i class="material-icons">power_settings_new</i></a></li>
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
                <img src="../images/user.png" width="48" height="48" alt="User" />
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
                <li class="active">
                    <a href="javascript:void(0);">
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
                            <a href="matkul">Data Mata Kuliah</a>
                        </li>
                        <li>
                            <a href="matkul/create.php">Tambah Mata Kuliah</a>
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
                            <a href="mahasiswa">Data Mahasiswa</a>
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
                            <a href="kelas">Data Kelas</a>
                        </li>
                        <li>
                            <a href="kelas/create.php">Tambah Kelas</a>
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
                            <a href="presensi">Data Presensi</a>
                        </li>
                        <li>
                            <a href="presensi/create.php">Tambah Presensi</a>
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
                            <a href="tutor">Data Tutor</a>
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
                            <a href="user">Data User</a>
                        </li>
                        <li>
                            <a href="user/create.php">Create User</a>
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
                            <a href="lampiran">Data Lampiran</a>
                        </li>
                        <li>
                            <a href="lampiran/upload.php">Unggah Lampiran</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <?php include "../footer.php"; ?>
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
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <?php
        require '../koneksi.php';
        $matkul = mysqli_query($connect, "SELECT kode_matkul FROM matkul");
        $kelas = mysqli_query($connect, "SELECT kode_kelas FROM kelas");
        $mahasiswa = mysqli_query($connect, "SELECT nim FROM user WHERE user_level='Mahasiswa'");
        $tutor = mysqli_query($connect, "SELECT kode_tutor FROM tutor");
        ?>
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text">MATA KULIAH</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo mysqli_num_rows($matkul);?>" data-speed="1500" data-fresh-interval="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">local_library</i>
                    </div>
                    <div class="content">
                        <div class="text">KELAS</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo mysqli_num_rows($kelas);?>" data-speed="1500" data-fresh-interval="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text">MAHASISWA</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo mysqli_num_rows($mahasiswa);?>" data-speed="1500" data-fresh-interval="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">school</i>
                    </div>
                    <div class="content">
                        <div class="text">TUTOR</div>
                        <div class="number count-to" data-from="0" data-to="<?php echo mysqli_num_rows($tutor);?>" data-speed="1500" data-fresh-interval="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <!-- With Captions -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>GALLERY</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic_2" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic_2" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic_2" data-slide-to="2"></li>
                            </ol>
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img src="../images/image-gallery/quotes/1.jpg" />
                                </div>
                                <div class="item">
                                    <img src="../images/image-gallery/quotes/2.jpg" />
                                </div>
                                <div class="item">
                                    <img src="../images/image-gallery/quotes/3.jpg" />
                                </div>
                            </div>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic_2" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic_2" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
        </div>
        <!-- #END# With Captions -->
    </div>
</section>

<!-- Jquery Core Js -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../plugins/node-waves/waves.js"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="../plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Morris Plugin Js -->
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/morrisjs/morris.js"></script>

<!-- ChartJs -->
<script src="../plugins/chartjs/Chart.bundle.js"></script>

<!-- Flot Charts Plugin Js -->
<script src="../plugins/flot-charts/jquery.flot.js"></script>
<script src="../plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="../plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="../plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="../plugins/flot-charts/jquery.flot.time.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="../plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Custom Js -->
<script src="../js/admin.js"></script>
<script src="../js/pages/index.js"></script>

<!-- Demo Js -->
<script src="../js/demo.js"></script>
</body>

</html>
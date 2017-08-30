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
                            <li>
                                <a href="../presensi">Data Presensi</a>
                            </li>
                            <li class="active">
                                <a href="javascript:void(0);">Tambah Presensi</a>
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
            <?php if (isset($_GET["kode_kelas"])){
                $kode_kelas = $_GET['kode_kelas'];
                $sql = "SELECT * 
                        from kelas k
                        JOIN matkul m ON (m.kode_matkul = k.kode_matkul)
                        JOIN tutor t ON (t.kode_tutor = k.kode_tutor)
                        WHERE k.kode_kelas='$kode_kelas'
                        ";
                $query = mysqli_query($connect, $sql);
                if (mysqli_num_rows($query) == 0) {
                    echo '<script>alert("Kode Kelas Tidak Sesuai!");window.location.href=\'../presensi\';</script>';
                }
                $kelas = mysqli_fetch_array($query);
            ?>
            <form id="form_advanced_validation" method="POST" enctype="multipart/form-data">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CREATE PRESENSI
                            </h2>
                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Data Kelas</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <?php echo "<input type='hidden' name='kode_kelas' class='form-control' value='$kelas[kode_kelas]'>" ?>
                                    <?php echo "<b>Kode Kelas : </b>".$kelas['kode_kelas']; ?>
                                </div>
                                <div class="col-sm-12">
                                    <?php echo "<input type='hidden' name='kode_matkul' class='form-control' value='$kelas[kode_matkul]'>" ?>
                                    <?php echo "<b>Mata Kuliah : </b>".$kelas['nama_matkul']; ?>
                                </div>
                                <div class="col-sm-12">
                                    <?php echo "<input type='hidden' name='kode_tutor' class='form-control' value=$kelas[kode_tutor]>"; ?>
                                    <?php echo "<b>Kode Tutor : </b>".$kelas['kode_tutor']; ?>
                                </div>
                            </div>
                            <h2 class="card-inside-title">Jadwal Utama</h2>
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
                                    <select class="form-control show-tick" name="status_pertemuan" required>
                                        <option value="">-- Pilih Status Pertemuan --</option>
                                        <?php
                                        $status = ['Tetap', 'Pengganti', 'Responsi'];
                                        foreach ($status as $status) {
                                            echo "<option value='".$status."'>".$status."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Tanggal</label>
                                        <div class="form-line">
                                            <input type="text" class="datepicker form-control" name="tanggal" placeholder="Please choose a date..." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Jam Mulai</label>
                                        <div class="form-line">
                                            <input type="text" class="timepicker form-control" name="waktu_mulai" placeholder="Please choose a time..." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Jam Selesai</label>
                                        <div class="form-line">
                                            <input type="text" class="timepicker form-control" name="waktu_selesai" placeholder="Please choose a time..." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label class="form-label">Tempat</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="tempat" placeholder="ex : Gedung F Lantai 2" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <label class="form-label">Catatan</label>
                                        <div class="form-line">
                                            <textarea name="catatan" class="form-control no-resize auto-growth" placeholder="ex : Murid telat datang hingga lebih dari 30 menit dan/atau Saya telat 30 menit. Wajib diisi ya:)" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Scan Absensi</label>
                                        <div class="form-line">
                                            <input type="file" class="form-control" name="image" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Foto Dokumentasi</label>
                                        <div class="form-line">
                                            <input type="file" class="form-control" name="dokumentasi" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <input type="checkbox" id="pernyataan" name="pernyataan" required />
                                    <label for="pernyataan">Dengan ini saya menyatakan bahwa data yang saya berikan adalah benar.</label>
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
                                    CREATE PRESENSI
                                </h2>
                            </div>
                            <div class="body">
                                <h2 class="card-inside-title">Kelas</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <select class="form-control show-tick" name="kode_kelas" required>
                                            <option value="">-- Pilih Kelas --</option>
                                            <?php
                                                $sql = "SELECT kode_kelas from kelas";
                                                $kelas = mysqli_query($connect,$sql);
                                                if(mysqli_num_rows($kelas) == 0){
                                                    echo '-- Data Kelas Tidak Tersedia --';
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
    if (isset($_POST['submit']) && isset($_POST['pernyataan'])) {
        $kode_kelas = $_POST['kode_kelas'];
        $kode_matkul = $_POST['kode_matkul'];
        $kode_tutor = $_POST['kode_tutor'];
        $status_pertemuan = $_POST['status_pertemuan'];
        $tanggal = $_POST['tanggal'];
        $tempat = $_POST['tempat'];
        $waktu_mulai = $_POST['waktu_mulai'];
        $waktu_selesai = $_POST['waktu_selesai'];
        $catatan = $_POST['catatan'];
        date_default_timezone_set('Asia/Jakarta');
        $timesubmit = date('Y-m-d H:i:s');

        /*START UPLOAD FILE*/
        if(isset($_FILES['image']) && isset($_FILES['dokumentasi'])){

            //getLastAutoIncremet
            $sql_id = "SELECT `AUTO_INCREMENT`
                        FROM  INFORMATION_SCHEMA.TABLES
                        WHERE TABLE_SCHEMA = 'u5200991_garuda'
                        AND   TABLE_NAME   = 'absensi'";
            $query = mysqli_query($connect,$sql_id);
            
            $id = mysqli_fetch_array($query);

            $errors= array();
            $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
            $file_name = $id[0]."_".$kode_kelas."_".$kode_tutor.".".$file_ext;
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];

            $dok_ext=strtolower(end(explode('.',$_FILES['dokumentasi']['name'])));
            $dok_name = $id[0]."_DOK_".$kode_kelas."_".$kode_tutor.".".$file_ext;
            $dok_size = $_FILES['dokumentasi']['size'];
            $dok_tmp = $_FILES['dokumentasi']['tmp_name'];
            $dok_type = $_FILES['dokumentasi']['type'];

            $expensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$expensions)=== false || in_array($dok_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152 || $dok_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }

            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"../../images/presensi/".$file_name);
                move_uploaded_file($dok_tmp,"../../images/dokumentasi/".$dok_name);
                $sql = "INSERT INTO absensi (kode_kelas, kode_matkul, kode_tutor, img_absen, dokumentasi, status_pertemuan, tanggal, tempat, waktu_mulai, waktu_selesai, catatan, time_submit) VALUES ('$kode_kelas', '$kode_matkul', '$kode_tutor', '$file_name' , '$dok_name', '$status_pertemuan', '$tanggal', '$tempat', '$waktu_mulai', '$waktu_selesai', '$catatan', '$timesubmit')";

                $query = mysqli_query($connect,$sql);

                if ($query) {
                    echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../presensi\';</script>';
                } else {
                    echo '<script>alert("Data Gagal disimpan");window.location.href=\'../presensi\';</script>';
                }
            }else{
                print_r($errors);
                echo '<script>alert("Data Gagal disimpan");window.location.href=\'../presensi\';</script>';
            }
        }
        mysqli_close($connect);
    }
?>
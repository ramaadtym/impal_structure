<?php
if(!isset($_SESSION)){
    session_start();
}
    if (isset($_GET["login"]) && $_GET["login"] == "masuk"){
        login();
    }
    if (isset($_GET["logout"]) && $_GET["logout"] == "keluar"){
        logout();
    }
    if (isset($_GET["addKelas"]) && $_GET["addKelas"] == "tambah"){
        add_kelas();
    }
    if (isset($_GET["addPresensi"]) && $_GET["addPresensi"] == "tambahpresensi"){
        add_presensi();
    }
    if (isset($_GET["addUser"]) && $_GET["addUser"] == "tambahuser"){
        add_user();
    }
    if (isset($_GET["editTutor"]) && $_GET["editTutor"] == "mauedit"){
        editTutor();
    }
    if (isset($_GET["verif_presensi"]) && $_GET["verif_presensi"] == "verif"){
        verifikasi_presensi();
    }
    if (isset($_GET["editPresensi"]) && $_GET["editPresensi"] == "edit"){
       $a = $_GET["cari"];
        edit_presensi($a);
    }
    if (isset($_GET["delPresensi"]) && $_GET["delPresensi"] == "hapus"){
       $a = $_GET["id"];
       delete_presensi($a);
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
                   header("Location: ../administrator");
                } elseif ($cek_level == "Tutor") {
                    $nim = $user['nim'];
                    $sql = "SELECT kode_tutor
                        FROM tutor
                        WHERE nim = '$nim'";
                    $query = mysqli_query($connect, $sql);
                    $tutor = mysqli_fetch_assoc($query);
                    $_SESSION['kode_tutor'] = $tutor['kode_tutor'];
                    header("Location: ../tutor");
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

    function add_kelas(){
            include("../koneksi.php");
            $kode_kelas = strtoupper($_POST['kode_kelas']);
            $kode_matkul = strtoupper($_POST['kode_matkul']);
            $kode_tutor = strtoupper($_POST['kode_tutor']);
            $hari = strtoupper($_POST['hari']);
            $jam = $_POST['jam'];
            $group_line = $_POST['group_line'];
            $tahun = $_POST['tahun'];
            $data = $_POST['data'];

            //print_r($_POST);

            $sql = "INSERT INTO kelas (kode_kelas, kode_matkul, kode_tutor, hari, jam, group_line, tahun) VALUES('$kode_kelas', '$kode_matkul', '$kode_tutor', '$hari', '$jam', '$group_line', '$tahun');";
            $query = mysqli_query($connect,$sql);

            //insertMahasiswaKeTabel
            foreach ($data as $nim) {
                $sql_data = "INSERT INTO detail_kelas(kode_kelas, nim) VALUES ('$kode_kelas', '$nim')";
                $query_data = mysqli_query($connect,$sql_data);
            }

            if ($query) {
                echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../administrator/kelas\';</script>';
            } else {
                echo '<script>alert("Data Gagal disimpan");window.location.href=\'../administrator/kelas\';</script>';
            }
            mysqli_close($connect);
    }

    /*PRESENSI*/
    function add_presensi(){
        include("../koneksi.php");
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
                move_uploaded_file($file_tmp,"../images/presensi/".$file_name);
                move_uploaded_file($dok_tmp,"../images/dokumentasi/".$dok_name);
                $sql = "INSERT INTO absensi (kode_kelas, kode_matkul, kode_tutor, img_absen, dokumentasi, status_pertemuan, tanggal, tempat, waktu_mulai, waktu_selesai, catatan, time_submit) VALUES ('$kode_kelas', '$kode_matkul', '$kode_tutor', '$file_name' , '$dok_name', '$status_pertemuan', '$tanggal', '$tempat', '$waktu_mulai', '$waktu_selesai', '$catatan', '$timesubmit')";

                $query = mysqli_query($connect,$sql);

                if ($query) {
                    echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../administrator/presensi\';</script>';
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
    function view_presensi($connect){
        $sql = "SELECT * FROM absensi";


        $presensi = mysqli_query($connect, $sql);
        if(mysqli_num_rows($presensi) == 0){
            //echo '<tr><td colspan="15"><center>Data Tidak Tersedia.</center></td></tr>';
        } else {
            $i = 1;
            foreach ($presensi as $value) {
                echo "
                                        <tr>
                                            <td>".$value['kode_kelas']."</td>
                                            <td>".$value['kode_tutor']."</td>
                                            <td>".$value['status_pertemuan']."</td>
                                            <td>".$value['tanggal']."</td>
                                            <td>".$value['waktu_mulai'].'-'.$value['waktu_selesai']."</td>
                                            <td>".$value['status_acc']."</td>
                                            <td>".$value['admin_acc']."</td>
                                            <td>
                                                <a href='detail.php?id=$value[id_absensi]'>
                                                    <button type=\"button\" class=\"btn btn-default waves-effect\">
                                                        <i class=\"material-icons\">pageview</i>
                                                    </button>
                                                </a>
                                                <a href='edit.php?kode=$value[kode_kelas]&id=$value[id_absensi]'>
                                                    <button type=\"button\" class=\"btn btn-primary waves-effect\">
                                                        <i class=\"material-icons\">edit</i>
                                                    </button>
                                                </a>
                                                <a href='../../fungsi/pendaftaran.php?delPresensi=hapus&id=$value[id_absensi]'>
                                                    <button type=\"button\" class=\"btn btn-danger waves-effect\">
                                                        <i class=\"material-icons\">delete_forever</i>
                                                    </button>
                                                </a>
                                            </td>   
                                        </tr>
                                    ";
            }
        }
    }
    function verifikasi_presensi(){
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
    }
    function edit_presensi($search){
        require '../koneksi.php';
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

            $sql = "UPDATE absensi SET
                kode_kelas='$kode_kelas',
                kode_matkul='$kode_matkul', 
                kode_tutor='$kode_tutor', 
                status_pertemuan='$status_pertemuan', 
                tanggal='$tanggal', 
                tempat='$tempat',
                waktu_mulai='$waktu_mulai', 
                waktu_selesai='$waktu_selesai',
                catatan='$catatan'
                WHERE id_absensi='$search'";

            $query = mysqli_query($connect,$sql);

            if ($query) {
                echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../administrator/presensi\';</script>';
            } else {
                echo '<script>alert("Data Gagal disimpan");window.location.href=\'../administrator/presensi\';</script>';
            }
        }
    }
    function delete_presensi($id){
        require '../koneksi.php';
        if (!isset($id)) {
            echo '<script>alert("Presensi Tidak Sesuai!");window.location.href=\'../administrator/presensi\';</script>';
        } else {
            $sql = "SELECT id_absensi
                FROM absensi
                WHERE id_absensi='$id' AND status_acc='Pending'";
            $query = mysqli_query($connect, $sql);

            $hasil = mysqli_num_rows($query);

            if ($hasil > 0) {
                $sql = "DELETE
                    FROM absensi
                    WHERE id_absensi='$id'";
                $query = mysqli_query($connect, $sql);
                if ($query) {
                    echo '<script>alert("Presensi Berhasil Dihapus!");window.location.href=\'../administrator/presensi\';</script>';
                } else {
                    echo '<script>alert("Presensi Gagal Dihapus!");window.location.href=\'../administrator/presensi\';</script>';
                }

            } else {
                echo '<script>alert("Presensi Gagal Dihapus! Karena sudah di acc!");window.location.href=\'../administrator/presensi\';</script>';
            }
        }
    }

    /*USER*/
    function add_user(){
        include("../koneksi.php");
        $nim = $_POST['nim'];
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $email = $_POST['email'];
        $user_level = $_POST['user_level'];
        $nama = strtoupper($_POST['nama']);
        $jeniskelamin = $_POST['jeniskelamin'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $fakultas = $_POST['fakultas'];
        $jurusan = strtoupper($_POST['jurusan']);
        $kelas = strtoupper($_POST['kelas']);
        $id_line = $_POST['id_line'];
        $telepon = $_POST['telepon'];

        //print_r($_POST);

        //cek username
        $sql_search = "SELECT username
                    FROM user
                    WHERE username='$username'";
        $query = mysqli_query($connect, $sql_search);
        if (mysqli_num_rows($query) == 1) {
            echo '<script>alert("Username Telah Digunakan");window.location.href=\'../user\';</script>';
        } else {
            $sql = "INSERT INTO user (nim, username, password, email, user_level) VALUES('$nim', '$username', '$password', '$email', '$user_level');";
            $sql .= "INSERT INTO detil_user (nim, nama, jeniskelamin, tgl_lahir, fakultas, jurusan, kelas, id_line, telepon) VALUES('$nim', '$nama', '$jeniskelamin', '$tgl_lahir', '$fakultas', '$jurusan', '$kelas', '$id_line', '$telepon');";

            if ($user_level == "Tutor") {
                $temp = str_replace(" ","",$nama);
                $kode_tutor = strtoupper(substr($temp,(strlen($temp)/2),3));

                $sql .= "INSERT INTO tutor (kode_tutor, nim) VALUES ('$kode_tutor','$nim')";
                $query = mysqli_multi_query($connect,$sql);
            } else {
                $query = mysqli_multi_query($connect,$sql);
            }
            // Masukin Tutor
            if (($query) && ($user_level == "Tutor")) {
                echo '<script>alert("Data Tutor'.$nama($kode_tutor).'Berhasil disimpan");window.location.href=\'../administrator/user\';</script>';
            } else if ($query) {
                echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../administrator/user\';</script>';
            } else {
                echo '<script>alert("Data Gagal disimpan");window.location.href=\'../administrator/user\';</script>';
            }
            mysqli_close($connect);
        }
    }
    function viewUser($connect){
        // put your code here

        //$sql = "SELECT * FROM user";
        $user = mysqli_query($connect, "SELECT * FROM user");
        if(mysqli_num_rows($user) > 0){
            foreach ($user as $value) {
                echo "
                                <tr>
                                    <td>".$value['nim']."</td>
                                    <td>".$value['username']."</td>
                                    <td>".$value['email']."</td>
                                    <td>".$value['user_level']."</td>
                                    <td>".$value['last_login']."</td>
                                    <td>
                                        <a href='edit.php?nim=$value[nim]'>
                                            <button type=\"button\" class=\"btn btn-primary waves-effect\">
                                                <i class=\"material-icons\">edit</i>
                                            </button>
                                        </a>
                                        <a href='delete.php?nim=$value[nim]'>
                                            <button type=\"button\" class=\"btn btn-danger waves-effect\">
                                                <i class=\"material-icons\">delete_forever</i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            ";
            }
        }
    }
    function view_data_tutor($connect){
        $sql = "SELECT * FROM user u JOIN detil_user d ON (u.nim = d.nim)  JOIN tutor t ON (u.nim = t.nim) WHERE (u.user_level='Tutor')";
        $tutor = mysqli_query($connect, $sql);
        if(mysqli_num_rows($tutor) > 0){
            foreach ($tutor as $value) {
                echo "
                                    <tr>
                                        <td>".$value['kode_tutor']."</td>                                        
                                        <td>".$value['nim']."</td>
                                        <td>".$value['nama']."</td>
                                        <td>".$value['matkul1']."</td>
                                        <td>".$value['matkul2']."</td>
                                        <td>
                                            <a href='edit.php?nim=$value[nim]'>
                                                <button type=\"button\" class=\"btn btn-primary waves-effect\">
                                                    <i class=\"material-icons\">edit</i>
                                                </button>
                                            </a>
                                        </td>   
                                    </tr>
                                    ";
            }
        }
    }

    /*TUTOR*/
    function editTutor(){
        include "../koneksi.php";
        if (isset($_POST['submit'])) {
            $nim = $_POST['nim'];
            $kode_tutor = $_POST['kode_tutor'];
            $matkul1 = $_POST['matkul1'];
            $matkul2 = $_POST['matkul2'];

            //print_r($_POST);

            $sql = "UPDATE tutor SET kode_tutor='$kode_tutor', matkul1='$matkul1', matkul2='$matkul2' WHERE nim='$nim'";

            $query = mysqli_query($connect,$sql);

            if ($query) {
                echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../tutor\';</script>';
            } else {
                echo '<script>alert("Data Gagal disimpan");window.location.href=\'../tutor\';</script>';
            }
            mysqli_close($connect);
        }
    }
?>
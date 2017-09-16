<?php
session_start();

if (isset($_GET["tambahkelas"]) && $_GET["tambahkelas"] == "tambah") {
    tambahkelas();
}
if (isset($_GET["tambahmatkul"]) && $_GET["tambahmatkul"] == "tambah") {
    tambahmatkul();
}

if (isset($_GET["hapusmatkul"])) {
    hapusmatkul($_GET['hapusmatkul']);
}

function tambahmatkul()
{
    include("../koneksi.php");
    if (isset($_POST['submit'])) {
        $kode_matkul = strtoupper($_POST['kode_matkul']);
        $nama_matkul = strtoupper($_POST['nama_matkul']);

        //print_r($_POST);

        $sql = "INSERT INTO matkul(kode_matkul, nama_matkul) VALUES('$kode_matkul', '$nama_matkul')";

        $query = mysqli_query($connect, $sql);

        if ($query) {
            echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../index.php\';</script>';
        } else {
            echo '<script>alert("Data Gagal disimpan");window.location.href=\'../index.php\';</script>';
        }
        mysqli_close($connect);
    }
}

function hapusmatkul($kode)
{
    include("../koneksi.php");

    if (!isset($kode)) {
        echo '<script>alert("Kode Matkul Tidak Sesuai!");window.location.href=\'../matkul\';</script>';
    } else {
        $sql = "DELETE
                FROM matkul
                WHERE kode_matkul='$kode'";
        $query = mysqli_query($connect, $sql);
        if ($query) {
            echo '<script>alert("Mata Kuliah Berhasil Dihapus!");window.location.href=\'../index.php\';</script>';
        } else {
            echo '<script>alert("Mata Kuliah Gagal Dihapus!");window.location.href=\'../index.php\';</script>';
        }
    }
}

/*KELAS*/
function tambahkelas()
{
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
    $query = mysqli_query($connect, $sql);

    //insertMahasiswaKeTabel
    foreach ($data as $nim) {
        $sql_data = "INSERT INTO detail_kelas(kode_kelas, nim) VALUES ('$kode_kelas', '$nim')";
        $query_data = mysqli_query($connect, $sql_data);
    }

    if ($query) {
        echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../administrator/kelas\';</script>';
    } else {
        echo '<script>alert("Data Gagal disimpan");window.location.href=\'../administrator/kelas\';</script>';
    }
    mysqli_close($connect);
}

function tampildatakelas($connect)
{

    $sql = "
                            SELECT k.kode_kelas kode_kelas, m.nama_matkul nama_matkul, k.kode_tutor kode_tutor, k.hari hari, k.jam jam, d.nama nama
                            FROM kelas k
                            JOIN tutor t ON (t.kode_tutor = k.kode_tutor)
                            JOIN matkul m ON (m.kode_matkul = k.kode_matkul)
                            JOIN user u ON (t.nim = u.nim)
                            JOIN detil_user d ON (u.nim = d.nim)";


    $kelas = mysqli_query($connect, $sql);
    if (mysqli_num_rows($kelas) == 0) {
        //echo '<tr><td colspan="8"><center>Data Tidak Tersedia.</center></td></tr>';
    } else {
        foreach ($kelas as $value) {
            echo "
                                    <tr>
                                        <td>" . $value['kode_kelas'] . "</td>
                                        <td>" . $value['hari'] . "</td>                                        
                                        <td>" . $value['jam'] . "</td>                                        
                                        <td>" . $value['kode_tutor'] . "</td>
                                        <td>" . $value['nama'] . "</td>
                                        <td>
                                            <a href='detail.php?&kode=$value[kode_kelas]'>
                                                <button type=\"button\" class=\"btn btn-default waves-effect\">
                                                    <i class=\"material-icons\">pageview</i>
                                                </button>
                                            </a>
                                            <a href='edit.php?kode=$value[kode_kelas]'>
                                                <button type=\"button\" class=\"btn btn-primary waves-effect\">
                                                    <i class=\"material-icons\">edit</i>
                                                </button>
                                            </a>
                                            <a href='delete.php?kode=$value[kode_kelas]'>
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


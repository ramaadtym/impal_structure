<?php
session_start();

if (isset($_GET["tambahmatkul"]) && $_GET["tambahmatkul"] == "tambah") {
    tambahmatkul();
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
            echo '<script>alert("Data Berhasil disimpan");window.location.href=\'../matkul\';</script>';
        } else {
            echo '<script>alert("Data Gagal disimpan");window.location.href=\'../matkul\';</script>';
        }
        mysqli_close($connect);
    }
}


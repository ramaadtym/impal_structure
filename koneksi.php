<?php

//Konfigurasi Database
$host = "localhost";
$user = "root";
$password = "";
$database = "db_impal";

$connect = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()){
    echo "Gagal Terhubung. ".mysqli_connect_error();
} else {
	//echo "Koneksi Berhasil";
}

?>
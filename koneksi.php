<?php

//Konfigurasi Database
$host = "localhost";
$user = "root";
$password = "1202962432";
$database = "impal";

$connect = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()){
    echo "Gagal Terhubung. ".mysqli_connect_error();
} else {
	//echo "Koneksi Berhasil";
}

?>
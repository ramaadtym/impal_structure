<?php

//Konfigurasi Database
$host = "localhost";
$user = "u5200991_garuda";
$password = "u5200991_garuda";
$database = "u5200991_garuda";

$connect = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()){
    echo "Gagal Terhubung. ".mysqli_connect_error();
} else {
	//echo "Koneksi Berhasil";
}

?>
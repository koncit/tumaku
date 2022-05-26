<?php

$host = "localhost"; // nama host
$user = "root"; 	 // nama user default xampp
$password = "";		 // jika ada password xampp silahkan di masukan jika tidak dikosongkan saja
$db = "matuku";		 // nama database

// cek kalau semua yang diatas itu benar maka sudah bisa terkoneksi
$koneksi = mysqli_connect($host, $user, $password, $db) 

// jika gagal tampilkan pesan "Gagal Konek"
or die("<b>Gagal Konek: </b>".mysqli_error($koneksi));

?>
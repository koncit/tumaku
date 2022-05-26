<?php
session_start();
if(!isset($_SESSION['login'])){
	header("location: login.php");
}

include("konek.php");

$sql = "DELETE FROM tugas WHERE id=".$_GET['id'].";";
mysqli_query($koneksi, $sql);
header("location: http://localhost/matuku/");

?>

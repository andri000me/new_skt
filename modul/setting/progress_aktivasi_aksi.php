<?php
session_start();
error_reporting(0);
include "../../config/config.php";

 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/config.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus progress_aktivasi
if ($module=='progress_aktivasi' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_progress_aktivasi WHERE id_progress_aktivasi='$_GET[id]'");
  header('location:../../progress-aktivasi.html');
}

// Input progress_aktivasi
elseif ($module=='progress_aktivasi' AND $act=='input'){
	
    mysql_query("INSERT INTO tbl_progress_aktivasi(nama_progress_aktivasi)VALUES('$_POST[nama_progress_aktivasi]')");
	header('location:progress-aktivasi.html');
}

// Update progress_aktivasi
elseif ($module=='progress_aktivasi' AND $act=='update'){

    mysql_query("UPDATE tbl_progress_aktivasi SET nama_progress_aktivasi 	= '$_POST[nama_progress_aktivasi]',
                                         aktif			= '$_POST[aktif]'
                                 WHERE   id_progress_aktivasi    = '$_POST[id]'");

	
  header('location:progress-aktivasi.html');
}
}
?>

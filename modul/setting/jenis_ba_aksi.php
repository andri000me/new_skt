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

// Hapus jenis_ba
if ($module=='jenis_ba' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_jenis_ba WHERE id_jenis_ba='$_GET[id]'");
  header('location:../../jenis-ba.html');
}

// Input jenis_ba
elseif ($module=='jenis_ba' AND $act=='input'){
	
    mysql_query("INSERT INTO tbl_jenis_ba(nama_jenis_ba)VALUES('$_POST[nama_jenis_ba]')");
	header('location:jenis-ba.html');
}

// Update jenis_ba
elseif ($module=='jenis_ba' AND $act=='update'){

    mysql_query("UPDATE tbl_jenis_ba SET nama_jenis_ba 	= '$_POST[nama_jenis_ba]',
                                         aktif			= '$_POST[aktif]'
                                 WHERE   id_jenis_ba    = '$_POST[id]'");

	
  header('location:jenis-ba.html');
}
}
?>

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

// Hapus status_pembayaran
if ($module=='status_pembayaran' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_status_pembayaran WHERE id_status_pembayaran='$_GET[id]'");
  header('location:../../status-pembayaran.html');
}

// Input status_pembayaran
elseif ($module=='status_pembayaran' AND $act=='input'){
	
    mysql_query("INSERT INTO tbl_status_pembayaran(nama_status_pembayaran)VALUES('$_POST[nama_status_pembayaran]')");
	header('location:status-pembayaran.html');
}

// Update status_pembayaran
elseif ($module=='status_pembayaran' AND $act=='update'){

    mysql_query("UPDATE tbl_status_pembayaran SET nama_status_pembayaran 	= '$_POST[nama_status_pembayaran]',
                                         aktif			= '$_POST[aktif]'
                                 WHERE   id_status_pembayaran    = '$_POST[id]'");

	
  header('location:status-pembayaran.html');
}
}
?>

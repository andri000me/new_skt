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

// Hapus nama_pelanggan
if ($module=='nama_pelanggan' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_nama_pelanggan WHERE id_nama_pelanggan='$_GET[id]'");
  header('location:../../nama-pelanggan.html');
}

// Input nama_pelanggan
elseif ($module=='nama_pelanggan' AND $act=='input'){
	
    mysql_query("INSERT INTO tbl_nama_pelanggan(nama_pelanggan)VALUES('$_POST[nama_pelanggan]')");
	header('location:nama-pelanggan.html');
}

// Update nama_pelanggan
elseif ($module=='nama_pelanggan' AND $act=='update'){

    mysql_query("UPDATE tbl_nama_pelanggan SET nama_pelanggan 	= '$_POST[nama_pelanggan]',
                                         aktif			= '$_POST[aktif]'
                                 WHERE   id_nama_pelanggan    = '$_POST[id]'");

	
  header('location:nama-pelanggan.html');
}
}
?>

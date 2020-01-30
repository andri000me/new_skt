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

// Hapus sbu
if ($module=='sbu' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_sbu WHERE id_sbu='$_GET[id]'");
  header('location:../../sbu.html');
}

// Input sbu
elseif ($module=='sbu' AND $act=='input'){
	
    mysql_query("INSERT INTO tbl_sbu(nama_sbu)VALUES('$_POST[nama_sbu]')");
	header('location:sbu.html');
}

// Update sbu
elseif ($module=='sbu' AND $act=='update'){

    mysql_query("UPDATE tbl_sbu SET nama_sbu 	= '$_POST[nama_sbu]',
                                         aktif			= '$_POST[aktif]'
                                 WHERE   id_sbu    = '$_POST[id]'");

	
  header('location:sbu.html');
}
}
?>

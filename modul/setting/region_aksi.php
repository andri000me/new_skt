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

// Hapus region
if ($module=='region' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_region WHERE id_region='$_GET[id]'");
  header('location:../../region.html');
}

// Input region
elseif ($module=='region' AND $act=='input'){
	
    mysql_query("INSERT INTO tbl_region(nama_region)VALUES('$_POST[nama_region]')");
	header('location:region.html');
}

// Update region
elseif ($module=='region' AND $act=='update'){

    mysql_query("UPDATE tbl_region SET nama_region 	= '$_POST[nama_region]',
                                         aktif			= '$_POST[aktif]'
                                 WHERE   id_region    = '$_POST[id]'");

	
  header('location:region.html');
}
}
?>

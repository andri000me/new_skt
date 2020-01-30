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

// Hapus tahun
if ($module=='tahun' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_tahun WHERE id_tahun='$_GET[id]'");
  header('location:../../tahun.html');
}

// Input tahun
elseif ($module=='tahun' AND $act=='input'){
	
    mysql_query("INSERT INTO tbl_tahun(tahun)VALUES('$_POST[tahun]')");
	header('location:tahun.html');
}

// Update tahun
elseif ($module=='tahun' AND $act=='update'){

    mysql_query("UPDATE tbl_tahun SET tahun 	= '$_POST[tahun]',
                                         aktif			= '$_POST[aktif]'
                                 WHERE   id_tahun    = '$_POST[id]'");

	
  header('location:tahun.html');
}
}
?>

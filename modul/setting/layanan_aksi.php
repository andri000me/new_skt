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

// Hapus layanan
if ($module=='layanan' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_layanan WHERE id_layanan='$_GET[id]'");
  header('location:../../layanan.html');
}

// Input layanan
elseif ($module=='layanan' AND $act=='input'){
	
    mysql_query("INSERT INTO tbl_layanan(nama_layanan)VALUES('$_POST[nama_layanan]')");
	header('location:layanan.html');
}

// Update layanan
elseif ($module=='layanan' AND $act=='update'){

    mysql_query("UPDATE tbl_layanan SET nama_layanan 	= '$_POST[nama_layanan]',
                                         aktif			= '$_POST[aktif]'
                                 WHERE   id_layanan    = '$_POST[id]'");

	
  header('location:layanan.html');
}
}
?>

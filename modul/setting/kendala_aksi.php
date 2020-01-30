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

// Hapus kendala
if ($module=='kendala' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_kendala WHERE id_kendala='$_GET[id]'");
  header('location:../../kendala.html');
}

// Input kendala
elseif ($module=='kendala' AND $act=='input'){
	
    mysql_query("INSERT INTO tbl_kendala(nama_kendala)VALUES('$_POST[nama_kendala]')");
	header('location:kendala.html');
}

// Update kendala
elseif ($module=='kendala' AND $act=='update'){

    mysql_query("UPDATE tbl_kendala SET nama_kendala 	= '$_POST[nama_kendala]',
                                         aktif			= '$_POST[aktif]'
                                 WHERE   id_kendala    = '$_POST[id]'");

	
  header('location:kendala.html');
}
}
?>

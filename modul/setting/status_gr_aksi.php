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

// Hapus status_gr
if ($module=='status_gr' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_status_gr WHERE id_status_gr='$_GET[id]'");
  header('location:../../status-gr.html');
}

// Input status_gr
elseif ($module=='status_gr' AND $act=='input'){
	
    mysql_query("INSERT INTO tbl_status_gr(nama_status_gr)VALUES('$_POST[nama_status_gr]')");
	header('location:status-gr.html');
}

// Update status_gr
elseif ($module=='status_gr' AND $act=='update'){

    mysql_query("UPDATE tbl_status_gr SET nama_status_gr 	= '$_POST[nama_status_gr]',
                                         aktif			= '$_POST[aktif]'
                                 WHERE   id_status_gr    = '$_POST[id]'");

	
  header('location:status-gr.html');
}
}
?>

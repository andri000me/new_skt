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

// Hapus pelaksana_pekerjaan
if ($module=='pelaksana_pekerjaan' AND $act=='hapus'){
  mysql_query("DELETE FROM tbl_pelaksana_pekerjaan WHERE id_pelaksana_pekerjaan='$_GET[id]'");
  header('location:../../pelaksana-pekerjaan.html');
}

// Input pelaksana_pekerjaan
elseif ($module=='pelaksana_pekerjaan' AND $act=='input'){
	
    mysql_query("INSERT INTO tbl_pelaksana_pekerjaan(nama,region,email,telp)VALUES('$_POST[nama]','$_POST[region]','$_POST[email]','$_POST[telp]')");
	header('location:pelaksana-pekerjaan.html');
}

// Update pelaksana_pekerjaan
elseif ($module=='pelaksana_pekerjaan' AND $act=='update'){

    mysql_query("UPDATE tbl_pelaksana_pekerjaan SET nama	= '$_POST[nama]',
													region	= '$_POST[region]',
													email	= '$_POST[email]',
													telp	= '$_POST[telp]',
													aktif	= '$_POST[aktif]'
                                 WHERE   id_pelaksana_pekerjaan    = '$_POST[id]'");

	
  header('location:pelaksana-pekerjaan.html');
}
}
?>

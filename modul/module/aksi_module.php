<?php
session_start();
error_reporting(0);
include "../../config/config.php";
$tgl_sekarang = date("Y-m-d H:i:s");
$tgl = date("d");
$bln = date("m");
$thn = date("Y");

Function getHashEncrypt($str){
  return ($str != "") ? HASH('sha256',($str)) : "";
}
// cari id transaksi terakhir yang berawalan tanggal hari ini

$jam_sekarang = date("H:i:s");
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/config.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus module
if ($module=='module' AND $act=='hapus'){
  mysql_query("DELETE FROM module WHERE id_module='$_GET[id_module]'");
  header('location:../../module.html');
}

// Input module
elseif ($module=='module' AND $act=='input'){
  mysql_query("INSERT INTO module(	nama_module,
              	  									dir_module,
              										  ket_module
              									   )
                            VALUES('$_POST[nama_module]',
			                             '$_POST[dir_module]',
										               '$_POST[ket_module]'
								  )");
  header('location:module.html'); 

}

// Update module
elseif ($module=='module' AND $act=='update'){
  mysql_query("UPDATE module SET 
                                   nama_module 			= '$_POST[nama_module]',
                                   dir_module 		 	= '$_POST[dir_module]',
                								   ket_module	 		  = '$_POST[ket_module]',
                								   aktif	 		      = '$_POST[aktif]'
								   
                             WHERE id_module   			= '$_POST[id_module]'");
  header('location:module.html');

}
}
?>

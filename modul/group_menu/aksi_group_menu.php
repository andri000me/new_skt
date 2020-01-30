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

// Hapus group_menu
if ($module=='group_menu' AND $act=='hapus'){
  mysql_query("DELETE FROM mainmenu WHERE id_main='$_GET[id_main]'");
  header('location:../../group-menu.html');
}

// Input group_menu
elseif ($module=='group_menu' AND $act=='input'){
  mysql_query("INSERT INTO mainmenu(nama_menu,class,link,urutan
									)
                            VALUES(	'$_POST[nama_menu]','$_POST[class]','$_POST[link]','$_POST[urutan]'
								  )");
  header('location:group-menu.html'); 

}

// Update group_menu
elseif ($module=='group_menu' AND $act=='update'){
  mysql_query("UPDATE mainmenu SET 
                                    nama_menu 		 = '$_POST[nama_menu]',
                                    class 		 		 = '$_POST[class]',
								                    link	 		     = '$_POST[link]',
                                    urutan         = '$_POST[urutan]',
								                    aktif	 		     = '$_POST[aktif]'
								   
                             WHERE id_main   			 = '$_POST[id_main]'");
  header('location:group-menu.html');

}
}
?>

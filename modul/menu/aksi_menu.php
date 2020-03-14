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

// Hapus menu
if ($module=='menu' AND $act=='hapus'){
  mysql_query("DELETE FROM submenu WHERE id_sub='$_GET[id_sub]'");
  header('location:../../menu.html');
}

// Input menu
elseif ($module=='menu' AND $act=='input'){
  $query="INSERT INTO submenu(	nama_sub,
              	  									class_sub,
              										  link_sub,
                                    id_main,
                                    id_submain,
                                    module_name,
                                    urutan
              									   )
                            VALUES('$_POST[nama_sub]',
			                             '$_POST[class_sub]',
										               '$_POST[link_sub]',
                                   '$_POST[id_main]',
                                   '$_POST[id_submain]',
                                   '$_POST[module_name]',
                                   '$_POST[urutan]'
                  )";            
  mysql_query($query);             
  header('location:menu.html'); 

}

// Update menu
elseif ($module=='menu' AND $act=='update'){
  mysql_query("UPDATE submenu SET 
                                   nama_sub 			= '$_POST[nama_sub]',
                                   class_sub 		 	= '$_POST[class_sub]',
                								   link_sub	 		  = '$_POST[link_sub]',
                                   id_main        = '$_POST[id_main]',
                                   id_submain     = '$_POST[id_submain]',
                                   module_name    = '$_POST[module_name]',
                                   urutan         = '$_POST[urutan]',
                								   aktif	 		    = '$_POST[aktif]'
								   
                             WHERE id_sub   			= '$_POST[id_sub]'");
  header('location:menu.html');

}
}
?>

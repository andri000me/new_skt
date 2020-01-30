<?php
session_start();
error_reporting(0);
include "../../config/config.php";
$tgl_sekarang = date("Y-m-d H:i:s");
$tgl = date("d");
$bln = date("m");
$thn = date("Y");
// cari id transaksi terakhir yang berawalan tanggal hari ini

$jam_sekarang = date("H:i:s");
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/config.php";
include "../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Kantor Bayar
if ($module=='hak_akses' AND $act=='delete'){
  mysql_query("DELETE FROM hak_akses WHERE akses_id='$_GET[akses_id]'");
  
	 	header('location:hak-akses.html');
	
}

// Input Kantor Bayar
elseif ($module=='hak_akses' AND $act=='input'){
 	   mysql_query("INSERT INTO hak_akses(	user_level_id,
											sub_id
									)
										VALUES('$_POST[user_level_id]',
											   '$_POST[sub_id]'
                                  
								  )");
  
	 	header('location:hak-akses.html');
	
}

// Update Kantor Bayar
elseif ($module=='hak_akses' AND $act=='update'){
 
	 mysql_query("UPDATE hak_akses SET 
                                   user_level_id 		= '$_POST[user_level_id]',
                                   sub_id 				= '$_POST[sub_id]' 
							 WHERE akses_id   			= '$_POST[akses_id]'");
	
	 	header('location:hak-akses.html');
	
	
}
}
?>

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

// Hapus tipe
if ($module=='tipe' AND $act=='delete'){
  mysql_query("DELETE FROM tltipenasabah WHERE fnId='$_GET[fnId]'");
  header('location:tipe.html');
}

// Input tipe
elseif ($module=='tipe' AND $act=='input'){
 
	  mysql_query("INSERT INTO tltipenasabah(	ftCabang,
												ftTipe,
												ftKeterangan,
												fnStatus,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftCabang]',
											   '$_POST[ftTipe]',
											   '$_POST[ftKeterangan]',
											   '$_POST[fnStatus]',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:tipe.html'); 

}

// Update tipe
elseif ($module=='tipe' AND $act=='update'){
 
	 mysql_query("UPDATE tltipenasabah SET 
                                   ftCabang 			= '$_POST[ftCabang]',
                                   ftTipe 		 		= '$_POST[ftTipe]',
								   ftKeterangan	 		= '$_POST[ftKeterangan]',
								   fnStatus	 			= '$_POST[fnStatus_edit]',
								   ftModified_User  	= '$_SESSION[namalengkap]',
								   fdModified_Date  	= '$tgl_sekarang'
								  
								   
                             WHERE fnId   				= '$_POST[id]'");
  header('location:tipe.html');
	
}
}
?>

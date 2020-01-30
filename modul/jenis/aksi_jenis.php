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

// Hapus jenis
if ($module=='jenis' AND $act=='delete'){
  mysql_query("DELETE FROM tljenispensiun WHERE fnId='$_GET[fnId]'");
  header('location:jenis.html');
}

// Input jenis
elseif ($module=='jenis' AND $act=='input'){
 
	  mysql_query("INSERT INTO tljenispensiun(	
												ftKodeJenis,
												ftNamaJenis,
												ftCabang,
												fnStatus,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES(
											   '$_POST[ftKodeJenis]',
											   '$_POST[ftNamaJenis]',
											   '$_POST[ftCabang]',
											   '$_POST[fnStatus]',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:jenis.html'); 

}

// Update jenis
elseif ($module=='jenis' AND $act=='update'){
 
	 mysql_query("UPDATE tljenispensiun SET 
                                   ftCabang 			= '$_POST[ftCabang]',
                                   ftKodeJenis 		 	= '$_POST[ftKodeJenis]',
								   ftNamaJenis	 		= '$_POST[ftNamaJenis]',
								   fnStatus	 			= '$_POST[fnStatus_edit]',
								   ftModified_User  	= '$_SESSION[namalengkap]',
								   fdModified_Date  	= '$tgl_sekarang'
								  
								   
                             WHERE fnId   				= '$_POST[id]'");
  header('location:jenis.html');
	
}
}
?>

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

// Hapus kelompok
if ($module=='kelompok' AND $act=='delete'){
  mysql_query("DELETE FROM tlkelompok WHERE fnId='$_GET[fnId]'");
  header('location:kelompok.html');
}

// Input kelompok
elseif ($module=='kelompok' AND $act=='input'){
 
	  mysql_query("INSERT INTO tlkelompok(	ftBranch_Code,
												ftKodeKelompok,
												ftNamaKelompok,
												ftKodeWilayah,
												ftNamaAO,
												fnStatus,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftBranch_Code]',
											   '$_POST[ftKodeKelompok]',
											   '$_POST[ftNamaKelompok]',
											   '$_POST[ftKodeWilayah]',
											   '$_POST[ftNamaAO]',
											   '$_POST[fnStatus]',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:kelompok.html'); 

}

// Update kelompok
elseif ($module=='kelompok' AND $act=='update'){
 
	 mysql_query("UPDATE tlkelompok SET 
                                   ftBranch_Code 		= '$_POST[ftBranch_Code]',
                                   ftKodeKelompok 		= '$_POST[ftKodeKelompok]',
								   ftNamaKelompok	 	= '$_POST[ftNamaKelompok]',
								   ftKodeWilayah	 	= '$_POST[ftKodeWilayah]',
								   ftNamaAO	 			= '$_POST[ftNamaAO]',
								   fnStatus	 			= '$_POST[fnStatus_edit]',
								   ftModified_User  	= '$_SESSION[namalengkap]',
								   fdModified_Date  	= '$tgl_sekarang'
								  
								   
                             WHERE fnId   				= '$_POST[id]'");
  header('location:kelompok.html');
	
}
}
?>

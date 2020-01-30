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
if ($module=='kantor_bayar' || $module=='perusahaan' AND $act=='delete'){
  mysql_query("DELETE FROM tlkantorbayar WHERE fnId='$_GET[fnId]'");
  if($module=='kantor_bayar'){
	 	header('location:kantor-bayar.html');
	 }else{
	 	header('location:perusahaan.html');
	 }
}

// Input Kantor Bayar
elseif ($module=='kantor_bayar' || $module=='perusahaan' AND $act=='input'){
 
	  mysql_query("INSERT INTO tlkantorbayar(	ftCabang,
												ftKodeKantorBayar,
												ftNamaKantorBayar,
												fnStatus,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftCabang]',
											   '$_POST[ftKodeKantorBayar]',
											   '$_POST[ftNamaKantorBayar]',
											   '$_POST[fnStatus]',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  if($module=='kantor_bayar'){
	 	header('location:kantor-bayar.html');
	 }else{
	 	header('location:perusahaan.html');
	 }

}

// Update Kantor Bayar
elseif ($module=='kantor_bayar' || $module=='perusahaan' AND $act=='update'){
 
	 mysql_query("UPDATE tlkantorbayar SET 
                                   ftCabang 			= '$_POST[ftCabang]',
                                   ftKodeKantorBayar 	= '$_POST[ftKodeKantorBayar]',
								   ftNamaKantorBayar	= '$_POST[ftNamaKantorBayar]',
								   fnStatus	 			= '$_POST[fnStatus_edit]',
								   ftModified_User  	= '$_SESSION[namalengkap]',
								   fdModified_Date  	= '$tgl_sekarang'
								  
								   
                             WHERE fnId   				= '$_POST[id]'");
	 if($module=='kantor_bayar'){
	 	header('location:kantor-bayar.html');
	 }else{
	 	header('location:perusahaan.html');
	 }
  
	
}
}
?>

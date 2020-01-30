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

// Hapus no_perkiraan
if ($module=='no_perkiraan' AND $act=='delete'){
  mysql_query("DELETE FROM tlnoperkiraan WHERE ftKodePerkiraan='$_GET[ftKodePerkiraan]'");
  header('location:no-perkiraan.html');
}

// Input no_perkiraan
elseif ($module=='no_perkiraan' AND $act=='input'){
 
	  mysql_query("INSERT INTO tlnoperkiraan(	ftKodePerkiraan,
												ftNamaPerkiraan,
												ftKodeKategori,
												fnStatus,
												
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftKodePerkiraan]',
											   '$_POST[ftNamaPerkiraan]',
											   '$_POST[ftKodeKategori]',
											   '$_POST[fnStatus]',
											  
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:no-perkiraan.html'); 

}

// Update no_perkiraan
elseif ($module=='no_perkiraan' AND $act=='update'){
 
	 mysql_query("UPDATE tlnoperkiraan SET 
                                   
                                   ftNamaPerkiraan 		= '$_POST[ftNamaPerkiraan]',
								   ftKodeKategori	 	= '$_POST[ftKodeKategori]',
								   fnStatus 		 	= '$_POST[fnStatus]',
								   
								   ftModified_User  	= '$_SESSION[namalengkap]',
								   fdModified_Date  	= '$tgl_sekarang'
								  
								   
                             WHERE ftKodePerkiraan   				= '$_POST[ftKodePerkiraan]'");
  header('location:no-perkiraan.html');
	
}
}
?>

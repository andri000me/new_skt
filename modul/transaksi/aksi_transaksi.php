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

// Hapus nasabah
if ($module=='nasabah' AND $act=='delete'){
  mysql_query("DELETE FROM tlnasabah WHERE fnId='$_GET[fnId]'");
  header('location:nasabah.html');
}

// Input nasabah
elseif ($module=='nasabah' AND $act=='input'){
 
	  mysql_query("INSERT INTO tlnasabah(		ftCabang,
												ftNoRekening,
												ftNamaNasabah,
												ftAlamat,
												ftKota,
												ftPropinsi,
												fnTipeNasabah,
												ftJenis,
												ftDapem,
												ftKantorBayar,
												fcGaji,
												fnStatus,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftCabang]',
											   '$_POST[ftNoRekening]',
											   '$_POST[ftNamaNasabah]',
											   '$_POST[ftAlamat]',
											   '$_POST[ftKota]',
											   '$_POST[ftPropinsi]',
											   '$_POST[fnTipeNasabah]',
											   '$_POST[ftJenis]',
											   '$_POST[ftDapem]',
											   '$_POST[ftKantorBayar]',
											   '$_POST[fcGaji]',
											   '$_POST[fnStatus]',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:nasabah.html'); 

}

// Update nasabah
elseif ($module=='nasabah' AND $act=='update'){
 
	 mysql_query("UPDATE tlnasabah SET 
                                   ftCabang 			= '$_POST[ftCabang]',
                                   ftNoRekening 		= '$_POST[ftNoRekening]',
								   ftNamaNasabah	 	= '$_POST[ftNamaNasabah]',
								   ftAlamat 		 	= '$_POST[ftAlamat]',
								   ftKota	 			= '$_POST[ftKota]',
								   ftPropinsi 		 	= '$_POST[ftPropinsi]',
								   fnTipeNasabah	 	= '$_POST[fnTipeNasabah]',
								   ftJenis 		 		= '$_POST[ftJenis]',
								   ftDapem	 			= '$_POST[ftDapem]',
								   ftKantorBayar 		= '$_POST[ftKantorBayar]',
								   fcGaji	 			= '$_POST[fcGaji]',
								   fnStatus	 			= '$_POST[fnStatus]',
								   ftModified_User  	= '$_SESSION[namalengkap]',
								   fdModified_Date  	= '$tgl_sekarang'
								  
								   
                             WHERE fnId   				= '$_POST[id]'");
  header('location:nasabah.html');
	
}
}
?>

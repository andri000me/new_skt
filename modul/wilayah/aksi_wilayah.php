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

// Hapus wilayah
if ($module=='wilayah' AND $act=='delete'){
  mysql_query("DELETE FROM tlwilayah WHERE fnId='$_GET[fnId]'");
  header('location:wilayah.html');
}

// Input wilayah
elseif ($module=='wilayah' AND $act=='input'){
 
	  mysql_query("INSERT INTO tlwilayah(		ftBranch_Code,
												ftKodeWilayah,
												ftNamaWilayah,
												ftAdmKredit,
												fnStatus,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftBranch_Code]',
											   '$_POST[ftKodeWilayah]',
											   '$_POST[ftNamaWilayah]',
											   '$_POST[ftAdmKredit]',
											   '$_POST[fnStatus]',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:wilayah.html'); 

}

// Update wilayah
elseif ($module=='wilayah' AND $act=='update'){
 
	 mysql_query("UPDATE tlwilayah SET 
                                   ftBranch_Code 			= '$_POST[ftBranch_Code]',
                                   ftKodeWilayah 		 	= '$_POST[ftKodeWilayah]',
								   ftNamaWilayah	 		= '$_POST[ftNamaWilayah]',
								   ftAdmKredit	 			= '$_POST[ftAdmKredit]',
								   fnStatus	 				= '$_POST[fnStatus_edit]',
								   ftModified_User  		= '$_SESSION[namalengkap]',
								   fdModified_Date  		= '$tgl_sekarang'
						     WHERE fnId   					= '$_POST[id]'");
  header('location:wilayah.html');
	
}
}
?>

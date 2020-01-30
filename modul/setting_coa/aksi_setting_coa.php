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

// Hapus setting_coa
if ($module=='setting_coa' AND $act=='delete'){
  mysql_query("DELETE FROM tlcoa_seting WHERE ftCOA_No='$_GET[ftCOA_No]'");
  header('location:setting-coa.html');
}

// Input setting_coa
elseif ($module=='setting_coa' AND $act=='input'){
 
	  mysql_query("INSERT INTO tlcoa_seting(	ftCOA_No,
												ftCOA_LinkGL,
												ftKodePerkiraan,
												ftModul,
												
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftCOA_No]',
											   '$_POST[ftCOA_LinkGL]',
											   '$_POST[ftKodePerkiraan]',
											   '$_POST[ftModul]',
											  
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:setting-coa.html'); 

}

// Update setting_coa
elseif ($module=='setting_coa' AND $act=='update'){
 
	 mysql_query("UPDATE tlcoa_seting SET 
                                   
                                   ftCOA_LinkGL 		= '$_POST[ftCOA_LinkGL]',
								   ftKodePerkiraan	 	= '$_POST[ftKodePerkiraan]',
								   ftModul 		 		= '$_POST[ftModul]',
								   
								   ftModified_User  	= '$_SESSION[namalengkap]',
								   fdModified_Date  	= '$tgl_sekarang'
								  
								   
                             WHERE ftCOA_No   				= '$_POST[ftCOA_No]'");
  header('location:setting-coa.html');
	
}
}
?>

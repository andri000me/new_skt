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

// Hapus sub_group_perkiraan
if ($module=='sub_group_perkiraan' AND $act=='delete'){
  mysql_query("DELETE FROM tlkategoriperkiraan WHERE ftCategoryCode='$_GET[ftCategoryCode]'");
  header('location:sub-group-perkiraan.html');
}

// Input sub_group_perkiraan
elseif ($module=='sub_group_perkiraan' AND $act=='input'){
 
	  mysql_query("INSERT INTO tlkategoriperkiraan(	
												ftBranch_Code,
												ftCategoryCode,
												ftCategoryName,
												fnStatus,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES(
											   '$_POST[ftBranch_Code]',
											   '$_POST[ftCategoryCode]',
											   '$_POST[ftCategoryName]',
											   '$_POST[fnStatus]',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:sub-group-perkiraan.html'); 

}

// Update sub_group_perkiraan
elseif ($module=='sub_group_perkiraan' AND $act=='update'){
 
	 mysql_query("UPDATE tlkategoriperkiraan SET 
                                   ftCategoryName 			= '$_POST[ftCategoryName]',
                                   ftBranch_Code 		 	= '$_POST[ftBranch_Code]',
								   ftCategoryCode	 		= '$_POST[ftCategoryCode]',
								   fnStatus	 			= '$_POST[fnStatus]',
								   ftModified_User  	= '$_SESSION[namalengkap]',
								   fdModified_Date  	= '$tgl_sekarang'
								  
								   
                             WHERE ftCategoryCode   				= '$_POST[ftCategoryCode]'");
  header('location:sub-group-perkiraan.html');
	
}
}
?>

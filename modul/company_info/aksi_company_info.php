<?php
session_start();
error_reporting(0);
include "../../config/config.php";
$tgl_sekarang = date("Y-m-d");
$datetime = date("Y-m-d H:i:s");
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

// Hapus company_info
if ($module=='company_info' AND $act=='delete'){
  mysql_query("DELETE FROM tscompany_info WHERE fnid='$_GET[fnid]'");
  header('location:company-info.html');
}

// Input company_info
elseif ($module=='company_info' AND $act=='input'){
 
	  mysql_query("INSERT INTO tscompany_info(	ftCompany_Code,
												ftCompany_Name,
												ftCompany_Address,
												ftCity,
												ftZip_code,
												ftBranch_Code,
												ftCountry,
												ftTelephone,
												ftFax,
												ftSpecial_Notes,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftCompany_Code]',
											   '$_POST[ftCompany_Name]',
											   '$_POST[ftCompany_Address]',
											   '$_POST[ftCity]',
											   '$_POST[ftZip_code]',
											   '$_POST[ftBranch_Code]',
											   '$_POST[ftCountry]',
											   '$_POST[ftTelephone]',
											   '$_POST[ftFax]',
											   '$_POST[ftSpecial_Notes]',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:company-info.html'); 

}

// Update company_info
elseif ($module=='company_info' AND $act=='update'){
 
	 mysql_query("UPDATE tscompany_info SET 
                                   ftCompany_Code 		= '$_POST[ftCompany_Code]',
                                   ftCompany_Name 		= '$_POST[ftCompany_Name]',
								   ftCompany_Address	= '$_POST[ftCompany_Address]',
								   ftCity	 			= '$_POST[ftCity]',
								   ftZip_code	 		= '$_POST[ftZip_code]',
								   ftBranch_Code		= '$_POST[ftBranch_Code]',
								   ftCountry	 		= '$_POST[ftCountry]',
								   ftTelephone	 		= '$_POST[ftTelephone]',
								   ftFax	 			= '$_POST[ftFax]',
								   ftSpecial_Notes	 	= '$_POST[ftSpecial_Notes]',
								   ftModified_User  	= '$_SESSION[namalengkap]',
								   fdModified_Date  	= '$tgl_sekarang'
								  
								   
                             WHERE fnid   				= '$_POST[id]'");
  header('location:company-info.html');
	
}

// Aktifkan company_info
elseif ($module=='company_info' AND $act=='aktif'){
  $query1=mysql_query("UPDATE tscompany_info SET aktif='Y' WHERE fnid='$_GET[fnid]'");
  $query2=mysql_query("UPDATE tscompany_info SET aktif='N' WHERE fnid!='$_GET[fnid]'");
  header('location:company-info.html');
}
}
?>

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

$module=$_GET['module'];
$act=$_GET['act'];
$fcSimpanan=str_replace(',', '',$_POST['fcSimpanan']);
$fcPlafond=str_replace(',', '',$_POST['fcPlafond']);
$fcOutstanding=str_replace(',', '',$_POST['fcOutstanding']);
$fcPokokAngsuran=str_replace(',', '',$_POST['fcPokokAngsuran']);
$fcBunganAngsuran=str_replace(',', '',$_POST['fcBunganAngsuran']);
$fcAdmAngsuran=str_replace(',', '',$_POST['fcAdmAngsuran']);
$fcPbltAngsuran=str_replace(',', '',$_POST['fcPbltAngsuran']);
$fcTabAngsuran=str_replace(',', '',$_POST['fcTabAngsuran']);
$fcTotalAngsuran=str_replace(',', '',$_POST['fcTotalAngsuran']);
$fcDiskon=str_replace(',', '',$_POST['fcDiskon']);
$fcPayment=str_replace(',', '',$_POST['fcPayment']);
$branch=mysql_fetch_array(mysql_query("SELECT ftBranch_Code FROM tscompany_info WHERE aktif ='Y'"));
$ftBranch_Code=$branch['ftBranch_Code'];
// Hapus realisasi-tagihan-umum
if ($module=='realisasi_tagihan_umum' AND $act=='delete'){
  mysql_query("DELETE FROM TXRealisasi_Tagihan_Umum_Hdr WHERE fnid='$_GET[fnid]'");
  header('location:realisasi-tagihan-umum.html');
}

// Input realisasi-tagihan-umum
elseif ($module=='realisasi_tagihan_umum' AND $act=='input'){
 
	  mysql_query("INSERT INTO TXRealisasi_Tagihan_Umum_Hdr(ftTrans_No,
	  														ftBranch_Code,
															fdTrans_date,
															fcSimpanan,
															ftNotes,
															ftCustomer_Code,
															
															ftLoan_No,
															fcPlafond,
															ffBunga,
															fnJW,
															fcOutstanding,
															fnStatus,
															fnPaymentMethod,
															fcPokokAngsuran,
															fcBunganAngsuran,
															fcAdmAngsuran,
															fcPbltAngsuran,
															fcTabAngsuran,
															fcTotalAngsuran,
															fcDiskon,
															fcPayment,
															ftCreated_User,
															fdCreated_Date
												)
													VALUES('$_POST[ftTrans_No]',
														   '$ftBranch_Code',
														   '$_POST[fdTrans_date]',
														   '$fcSimpanan',
														   '$_POST[ftNotes]',
														   '$_POST[ftCustomer_Code]',
														   '$_POST[ftLoan_No]',
														   '$fcPlafond',
														   '$_POST[ffBunga]',
														   '$_POST[fnJW]',
														   '$fcOutstanding',
														   '1',
														   '$_POST[fnPaymentMethod]',
														   '$fcPokokAngsuran',
														   '$fcBunganAngsuran',
														   '$fcAdmAngsuran',
														   '$fcPbltAngsuran',
														   '$fcTabAngsuran',
														   '$fcTotalAngsuran',
														   '$fcDiskon',
														   '$fcPayment',
														   '$_SESSION[namalengkap]',
														   '$tgl_sekarang'
                                  
								  )");

	  /* mysql_query("UPDATE txpinjaman_umum_hdr set fcOutstanding = fcOutstanding - '$fcPokokAngsuran' where ftTrans_No='$_POST[ftLoan_No]' and ftCustomer_Code='$_POST[ftCustomer_Code]'");*/

  header('location:realisasi-tagihan-umum.html'); 

}

// update realisasi-tagihan-umum
elseif ($module=='realisasi_tagihan_umum' AND $act=='update'){
 
	  mysql_query("UPDATE TXRealisasi_Tagihan_Umum_Hdr SET	fnStatus = '99',
															ftModified_User	= '$_SESSION[namalengkap]',
															fdModified_date	= '$tgl_sekarang'
											WHERE fnid   				= '$_POST[id]'
											");
  header('location:realisasi-tagihan-umum.html'); 

}
}
?>

<?php
session_start();
error_reporting(0);
include "../../config/config.php";
$tgl_sekarang = date("Y-m-d");

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

// Hapus pinjaman-umum
if ($module=='pinjaman_umum' AND $act=='delete'){
  mysql_query("DELETE FROM tlbiayaadmumum WHERE fnid='$_GET[fnid]'");
  header('location:pinjaman-umum.html');
}

// Input pinjaman-umum
elseif ($module=='pinjaman_umum' AND $act=='input'){
	
	$materai= $_POST['fcMaterai'] ;
	$clean = preg_replace('/\D/','',$materai);
	$fcAdmAngsuran= $_POST['fcAdmAngsuran'] ;
	$cleanfcAdmAngsuran = preg_replace('/\D/','',$fcAdmAngsuran);
	  mysql_query("INSERT INTO tlbiayaadmumum(ffBunga,
												ffAdm,
												ffProvisi,
												ffAsuransi,
												ffPpap,
												fcMaterai,
												fcAdmAngsuran,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ffBunga]',
											   '$_POST[ffAdm]',
											   '$_POST[ffProvisi]',
											   '$_POST[ffAsuransi]',
											   '$_POST[ffPpap]',
											   '$clean',
											   '$cleanfcAdmAngsuran',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:pinjaman-umum.html'); 
	}

// Update pinjaman-umum
elseif ($module=='pinjaman_umum' AND $act=='update'){ 
    $materai= $_POST['fcMaterai'] ;
	$clean = preg_replace('/\D/','',$materai);
	$fcAdmAngsuran= $_POST['fcAdmAngsuran'] ;
	$cleanfcAdmAngsuran = preg_replace('/\D/','',$fcAdmAngsuran);
	 mysql_query("UPDATE tlbiayaadmumum SET 
                                   ffBunga 			= '$_POST[ffBunga]',
                                   ffAdm 			= '$_POST[ffAdm]',
                                   ffProvisi 		= '$_POST[ffProvisi]',
								   ffAsuransi	 	= '$_POST[ffAsuransi]',
								   ffPpap    	 	= '$_POST[ffPpap]',
								   fcMaterai 		= '$clean',
								   fcAdmAngsuran 	= '$cleanfcAdmAngsuran',
								   ftModified_User  = '$_SESSION[namalengkap]',
								   fdModified_Date  = '$tgl_sekarang'
								  
								   
                             WHERE fnid   				= '$_POST[id]'");
  header('location:pinjaman-umum.html');
		
}

// Aktifkan pinjaman umum
elseif ($module=='pinjaman_umum' AND $act=='aktif'){
  $query1=mysql_query("UPDATE tlbiayaadmumum SET aktif='Y' WHERE fnid='$_GET[fnid]'");
  $query2=mysql_query("UPDATE tlbiayaadmumum SET aktif='N' WHERE fnid!='$_GET[fnid]'");
  header('location:pinjaman-umum.html');
}
}
?>

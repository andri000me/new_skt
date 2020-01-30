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

// Hapus pinjaman-mikro
if ($module=='pinjaman_mikro' AND $act=='delete'){
  mysql_query("DELETE FROM tlbiayaadmmikro WHERE fnid='$_GET[fnid]'");
  header('location:pinjaman-mikro.html');
}

// Input pinjaman-mikro
elseif ($module=='pinjaman_mikro' AND $act=='input'){
	
	$materai= $_POST['fcMaterai'] ;
	$clean = preg_replace('/\D/','',$materai);
	$fcAdmAngsuran= $_POST['fcAdmAngsuran'] ;
	$cleanfcAdmAngsuran = preg_replace('/\D/','',$fcAdmAngsuran);
	  mysql_query("INSERT INTO tlbiayaadmmikro(ffBunga,
												ffAdm,
												ffAsuransi,
												fcMaterai,
												fcAdmAngsuran,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ffBunga]',
											   '$_POST[ffAdm]',
											   '$_POST[ffAsuransi]',
											   '$clean',
											   '$cleanfcAdmAngsuran',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:pinjaman-mikro.html'); 
	}

// Update pinjaman-mikro
elseif ($module=='pinjaman_mikro' AND $act=='update'){
    $materai= $_POST['fcMaterai'] ;
	$clean = preg_replace('/\D/','',$materai);
	$fcAdmAngsuran= $_POST['fcAdmAngsuran'] ;
	$cleanfcAdmAngsuran = preg_replace('/\D/','',$fcAdmAngsuran);
	 mysql_query("UPDATE tlbiayaadmmikro SET 
                                   ffBunga 			= '$_POST[ffBunga]',
                                   ffAdm 			= '$_POST[ffAdm]',
								   ffAsuransi	 	= '$_POST[ffAsuransi]',
								   fcMaterai 		= '$clean',
								   fcAdmAngsuran 	= '$cleanfcAdmAngsuran',
								   ftModified_User  = '$_SESSION[namalengkap]',
								   fdModified_Date  = '$tgl_sekarang'
								  
								   
                             WHERE fnid   				= '$_POST[id]'");
  header('location:pinjaman-mikro.html');
		
}


// Aktifkan pinjaman mikro
elseif ($module=='pinjaman_mikro' AND $act=='aktif'){
  $query1=mysql_query("UPDATE tlbiayaadmmikro SET aktif='Y' WHERE fnid='$_GET[fnid]'");
  $query2=mysql_query("UPDATE tlbiayaadmmikro SET aktif='N' WHERE fnid!='$_GET[fnid]'");
  header('location:pinjaman-mikro.html');
}
}
?>

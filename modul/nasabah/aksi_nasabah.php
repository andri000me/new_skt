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
$tipe=$_GET[tipe2];
//var_dump($tipe);exit;
// Hapus nasabah
if ($module=='nasabah_pensiun' || $module=='nasabah_umum' || $module=='nasabah_mikro' AND $act=='delete'){
  mysql_query("DELETE FROM tlnasabah WHERE fnId='$_GET[fnId]'");
  header('location:nasabah-'.$tipe.'.html');
}

// Input nasabah
elseif ($module=='nasabah_pensiun' || $module=='nasabah_umum' || $module=='nasabah_mikro' AND $act=='input'){
	$norek= $_POST['ftNoRekening'];
 	$checknorek=mysql_query("SELECT ftNoRekening FROM tlnasabah WHERE ftNoRekening='$norek'");
 	$findnorek=mysql_num_rows($checknorek);
 	if ($findnorek == 0){
	  mysql_query("INSERT INTO tlnasabah(		ftCabang,
												ftSubCabang,
												ftNoRekening,
												ftNamaNasabah,
												ftPekerjaan,
												ftTempatTglLahir,
												ftTgl_Lahir,
												ftStatusRumah,
												ftAlamat,
												ftAlamat2,
												ftKota,
												ftPropinsi,
												ftJabatan,
												ftNohp,
												fnStatusnasabah,
												fnTipeNasabah,
												ftJenis,
												ftDapem,
												ftKantorBayar,
												fcGaji,
												ftTgl_Gaji,
												ftTimSurvey,
												ftRegu,
												ftNamaKelompok,
												ftJaminan,
												fnStatus,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftCabang]',
											   '$_POST[ftSubCabang]',
											   '$_POST[ftNoRekening]',
											   '$_POST[ftNamaNasabah]',
											   '$_POST[ftPekerjaan]',
											   '$_POST[ftTempatTglLahir]',
											   '$_POST[ftTgl_Lahir]',
											   '$_POST[ftStatusRumah]',
											   '$_POST[ftAlamat]',
											   '$_POST[ftAlamat2]',
											   '$_POST[ftKota]',
											   '$_POST[ftPropinsi]',
											   '$_POST[ftJabatan]',
											   '$_POST[ftNohp]',
											   '$_POST[fnStatusnasabah]',
											   '$_POST[fnTipeNasabah]',
											   '$_POST[ftJenis]',
											   '$_POST[ftDapem]',
											   '$_POST[ftKantorBayar]',
											   '$_POST[fcGaji]',
											   '$_POST[ftTgl_Gaji]',
											   '$_POST[ftTimSurvey]',
											   '$_POST[ftRegu]',
											   '$_POST[ftNamaKelompok]',
											   '$_POST[ftJaminan]',
											   '$_POST[fnStatus]',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
	header('location:nasabah-'.$tipe.'.html'); 
	}else{
		echo "<script language=\"JavaScript\">";
			echo "alert(\"No Rekening Sudah Ada\");";
			echo "location.href=\"javascript:history.back()\";";
			echo "</script>";
	}

}

// Update nasabah
elseif ($module=='nasabah_pensiun' || $module=='nasabah_umum' || $module=='nasabah_mikro' AND $act=='update'){
 
	 mysql_query("UPDATE tlnasabah SET 
                                   ftCabang 			= '$_POST[ftCabang]',
								   ftSubCabang 			= '$_POST[ftSubCabang]',
                                   ftNoRekening 		= '$_POST[ftNoRekening]',
								   ftNamaNasabah	 	= '$_POST[ftNamaNasabah]',
								   ftPekerjaan	 		= '$_POST[ftPekerjaan]',
								   ftTempatTglLahir	 	= '$_POST[ftTempatTglLahir]',
								   ftTgl_Lahir	 		= '$_POST[ftTgl_Lahir]',
								   ftStatusRumah	 	= '$_POST[ftStatusRumah]',
								   ftAlamat 		 	= '$_POST[ftAlamat]',
								   ftAlamat2 		 	= '$_POST[ftAlamat2]',
								   ftKota	 			= '$_POST[ftKota]',
								   ftPropinsi 		 	= '$_POST[ftPropinsi]',
								   ftJabatan 		 	= '$_POST[ftJabatan]',
								   ftNohp 		 		= '$_POST[ftNohp]',
								   fnStatusnasabah 		= '$_POST[fnStatusnasabah]',
								   fnTipeNasabah	 	= '$_POST[fnTipeNasabah]',
								   ftJenis 		 		= '$_POST[ftJenis]',
								   ftDapem	 			= '$_POST[ftDapem]',
								   ftKantorBayar 		= '$_POST[ftKantorBayar]',
								   fcGaji	 			= '$_POST[fcGaji]',
								   ftTgl_Gaji	 		= '$_POST[ftTgl_Gaji]',
								   ftTimSurvey	 		= '$_POST[ftTimSurvey]',
								   ftRegu	 			= '$_POST[ftRegu]',
								   ftNamaKelompok	 	= '$_POST[ftNamaKelompok]',
								   ftJaminan	 		= '$_POST[ftJaminan]',
								   fnStatus	 			= '$_POST[fnStatus]',
								   ftModified_User  	= '$_SESSION[namalengkap]',
								   fdModified_Date  	= '$tgl_sekarang'
								  
								   
                             WHERE fnId   				= '$_POST[id]'");
  header('location:nasabah-'.$tipe.'.html');
	
}
}
?>

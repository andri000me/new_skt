<?php
session_start();
error_reporting(0);
include "../../config/config.php";
$tgl_sekarang = date("Y-m-d H:i:s");

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

// Hapus jabatan
if ($module=='jabatan' AND $act=='delete'){
  mysql_query("DELETE FROM tljabatan WHERE fnid='$_GET[fnid]'");
  header('location:jabatan.html');
}

// Input jabatan
elseif ($module=='jabatan' AND $act=='input'){
	$cekdirektur = mysql_num_rows(mysql_query("SELECT * FROM tljabatan WHERE ftNIKDirektur='$_POST[ftNIKDirektur]'"));
	$cekkabid = mysql_num_rows(mysql_query("SELECT * FROM tljabatan WHERE ftNIKKabidOps='$_POST[ftNIKKabidOps]'"));	
	$cekadm = mysql_num_rows(mysql_query("SELECT * FROM tljabatan WHERE ftNIKAdmKredit='$_POST[ftNIKAdmKredit]'"));	
	$ceksimpanan = mysql_num_rows(mysql_query("SELECT * FROM tljabatan WHERE ftNIKSimpanan='$_POST[ftNIKSimpanan]'"));	
	$cekkasir = mysql_num_rows(mysql_query("SELECT * FROM tljabatan WHERE ftNIKKasir='$_POST[ftNIKKasir]'"));	
	$cekakutansi = mysql_num_rows(mysql_query("SELECT * FROM tljabatan WHERE ftNIKAkuntansi='$_POST[ftNIKAkuntansi]'"));											
    if ($cekdirektur > 0){
    echo "<script>window.alert('NIK Direktur yang anda masukan sudah ada')
    window.history.go(-1);</script>";
    }else if ($cekkabid > 0){
    echo "<script>window.alert('NIK Kabid Operasi yang anda masukan sudah ada')
    window.history.go(-1);</script>";
	}else if ($cekadm > 0){
    echo "<script>window.alert('NIK Adm Kredit yang anda masukan sudah ada')
    window.history.go(-1);</script>";
	}else if ($ceksimpanan > 0){
    echo "<script>window.alert('NIK Simpanan yang anda masukan sudah ada')
    window.history.go(-1);</script>";
	}else if ($cekkasir > 0){
    echo "<script>window.alert('NIK Kasir yang anda masukan sudah ada')
    window.history.go(-1);</script>";
	}else if ($cekakutansi > 0){
    echo "<script>window.alert('NIK Akuntansi yang anda masukan sudah ada')
    window.history.go(-1);</script>";
	}else {
	  mysql_query("INSERT INTO tljabatan(		ftNamaDirektur,
												ftNIKDirektur,
												ftJabatanDIrektur,
												ftNamaKabidOps,
												ftNIKKabidOps,
												ftJabatanKabidOps,
												ftNamaAdmKredit,
												ftNIKAdmKredit,
												ftJabatanAdmKredit,
												ftNamaSimpanan,
												ftNIKSimpanan,
												ftJabatanSimpanan,
												ftNamaKasir,
												ftNIKKasir,
												ftJabatanKasir,
												ftNamaAkuntansi,
												ftNIKAkuntansi,
												ftJabatanAkuntansi,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftNamaDirektur]',
											   '$_POST[ftNIKDirektur]',
											   '$_POST[ftJabatanDIrektur]',
											   '$_POST[ftNamaKabidOps]',
											   '$_POST[ftNIKKabidOps]',
											   '$_POST[ftJabatanKabidOps]',
											   '$_POST[ftNamaAdmKredit]',
											   '$_POST[ftNIKAdmKredit]',
											   '$_POST[ftJabatanAdmKredit]',
											   '$_POST[ftNamaSimpanan]',
											   '$_POST[ftNIKSimpanan]',
											   '$_POST[ftJabatanSimpanan]',
											   '$_POST[ftNamaKasir]',
											   '$_POST[ftNIKKasir]',
											   '$_POST[ftJabatanKasir]',
											   '$_POST[ftNamaAkuntansi]',
											   '$_POST[ftNIKAkuntansi]',
											   '$_POST[ftJabatanAkuntansi]',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
  header('location:jabatan.html'); 
	}

}

// Update jabatan
elseif ($module=='jabatan' AND $act=='update'){
 
	 mysql_query("UPDATE tljabatan SET 
                                   ftNamaDirektur 			= '$_POST[ftNamaDirektur]',
                                   ftNIKDirektur 			= '$_POST[ftNIKDirektur]',
								   ftJabatanDIrektur	 	= '$_POST[ftJabatanDIrektur]',
								   ftNamaKabidOps 		 	= '$_POST[ftNamaKabidOps]',
								   ftNIKKabidOps	 		= '$_POST[ftNIKKabidOps]',
								   ftJabatanKabidOps 		= '$_POST[ftJabatanKabidOps]',
								   ftNamaAdmKredit	 		= '$_POST[ftNamaAdmKredit]',
								   ftNIKAdmKredit 		 	= '$_POST[ftNIKAdmKredit]',
								   ftJabatanAdmKredit	 	= '$_POST[ftJabatanAdmKredit]',
								   ftNamaSimpanan 			= '$_POST[ftNamaSimpanan]',
								   ftNIKSimpanan	 		= '$_POST[ftNIKSimpanan]',
								   ftJabatanSimpanan	 	= '$_POST[ftJabatanSimpanan]',
								   ftNamaKasir	 			= '$_POST[ftNamaKasir]',
								   ftNIKKasir 		 		= '$_POST[ftNIKKasir]',
								   ftJabatanKasir	 		= '$_POST[ftJabatanKasir]',
								   ftNamaAkuntansi 			= '$_POST[ftNamaAkuntansi]',
								   ftNIKAkuntansi	 		= '$_POST[ftNIKAkuntansi]',
								   ftJabatanAkuntansi	 	= '$_POST[ftJabatanAkuntansi]',
								   ftModified_User  		= '$_SESSION[namalengkap]',
								   fdModified_Date  		= '$tgl_sekarang'
								  
								   
                             WHERE fnid   				= '$_POST[id]'");
  header('location:jabatan.html');
		
}
}
?>

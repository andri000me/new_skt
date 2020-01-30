<?php 
session_start();
error_reporting(0);
include "../../config/config.php";

$tgl_sekarang = date("Y-m-d");
$datetime = date("Y-m-d H:i:s");
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
$fcSaldosimpanan=str_replace(',', '',$_POST['fcSaldosimpanan']);
$fcPlafond=str_replace(',', '',$_POST['fcPlafond']);
$ffBunga =str_replace(',', '',$_POST['ffBunga']);
$fnJW =str_replace(',', '',$_POST['fnJW']);
$ffAdm =str_replace(',', '',$_POST['ffAdm']);
$fcAdm =str_replace(',', '',$_POST['fcAdm']);
$ffAsuransi =str_replace(',', '',$_POST['ffAsuransi']);
$fcAsuransi =str_replace(',', '',$_POST['fcAsuransi']);
$fcMaterai =str_replace(',', '',$_POST['fcMaterai']);
$fcPblt =str_replace(',', '',$_POST['fcPblt']);
$fcPelunasan =str_replace(',', '',$_POST['fcPelunasan']);
$fcDiskon =str_replace(',', '',$_POST['fcDiskon']);
$fcSimpanan =str_replace(',', '',$_POST['fcSimpanan']);
$fcTerimaBersih =str_replace(',', '',$_POST['fcTerimaBersih']);
$fcPokokAngsuran =str_replace(',', '',$_POST['fcPokokAngsuran']);
$fcBunganAngsuran  =str_replace(',', '',$_POST['fcBunganAngsuran']);
$fcAdmAngsuran  =str_replace(',', '',$_POST['fcAdmAngsuran']);
$fcPbltAngsuran  =str_replace(',', '',$_POST['fcPbltAngsuran']);
$fcTabAngsuran  =str_replace(',', '',$_POST['fcTabAngsuran']);
$fcTotalAngsuran  =str_replace(',', '',$_POST['fcTotalAngsuran']);
												
$fcTotalPelunasanPokok =str_replace(',', '',$_POST['fcTotalPelunasanPokok']);
$fcTotalPelunasanBunga =str_replace(',', '',$_POST['fcTotalPelunasanBunga']);
$fcTotalPelunasanAdm  =str_replace(',', '',$_POST['fcTotalPelunasanAdm']);
$fcTotalPelunasanPblt =str_replace(',', '',$_POST['fcTotalPelunasanPblt']);
$fcTotalPelunasan =str_replace(',', '',$_POST['fcTotalPelunasan']);
$branch=mysql_fetch_array(mysql_query("SELECT ftBranch_Code FROM tscompany_info WHERE aktif ='Y'"));
$ftBranch_Code=$branch['ftBranch_Code'];

$query=mysql_fetch_array(mysql_query("SELECT fnTipeNasabah FROM tlnasabah WHERE ftNoRekening='$_POST[ftCustomer_Code]'"));
/*$Branch_Code=$query["ftCabang"];*/
$Tipe=	$query["fnTipeNasabah"];

// Hapus transaksi
if ($module=='transaksi_mikro' AND $act=='delete'){
/*	$id=$_GET['fnid'];
  $fnid=$_GET['ftTrans_No'];
  var_dump($id);var_dump($fnid);exit;*/	
  mysql_query("DELETE FROM txpinjaman_mikro_hdr WHERE fnid='$_GET[fnid]'");
  mysql_query("DELETE FROM txpinjaman_mikro_nasabah_hdr WHERE ftTrans_No='$_GET[ftTrans_No]'");
  header('location:transaksi-mikro.html');
}else if ($module=='transaksi_mikro' AND $act=='deletenasabah'){
  $id=$_GET['id'];
  $fnid=$_GET['fnid'];
//  var_dump($id);var_dump($fnid);exit;	
  mysql_query("DELETE FROM txpinjaman_mikro_nasabah_hdr WHERE fnid='$_GET[fnid]'");
  header('location:add-transaksimikro-'.$id.'.html');
}
 
// Input transaksi
elseif ($module=='transaksi_mikro' AND $act=='input'){
	 $check=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE ftKodeKelompok='$_POST[ftKodeKelompok]' ");
	 $ketemu=mysql_num_rows($check);
	//var_dump( $ketemu);exit;
	if ($ketemu == 0){
	  mysql_query("INSERT INTO txpinjaman_mikro_hdr(
												ftTrans_No,
												ftBranch_Code,
												fdTrans_date,
												fcSaldosimpanan,
												ftNotes,
												ftKodeKelompok,
												ftKodeWilayah,
												fnStatus,
												fnStatusPembayaran,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftTrans_No]',
											   '$ftBranch_Code',
											   '$_POST[fdTrans_date]',
											   '$fcSaldosimpanan',
											   '$_POST[ftNotes]',
											   '$_POST[ftKodeKelompok]',
											   '$_POST[ftKodeWilayah]',
											    '1',
											    '0',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
								  )");

	  mysql_query("INSERT INTO txpinjaman_mikro_nasabah_hdr(
												ftTrans_No,
												ftBranch_Code,
												fdTrans_date,
												fcSaldosimpanan,
												ftNotes,
												ftKodeKelompok,
												ftKodeWilayah,
												ftCustomer_Code,
												fcPlafond,
												fcOutstanding,
												ffBunga,
												fnJW,
												ffAdm,
												fcAdm,
												ffAsuransi,
												fcAsuransi,
												fcMaterai,
												fcPblt,
												fcPelunasan,
												fcDiskon,
												fcSimpanan,
												fcTerimaBersih,
												fcPokokAngsuran,
												fcBunganAngsuran,
												fcAdmAngsuran,
												fcPbltAngsuran,
												fcTabAngsuran,
												fcTotalAngsuran,
												ftCreated_User,
												fdCreated_Date,
												fnStatus,
												fnStatusPembayaran
									)
										VALUES('$_POST[ftTrans_No]',
											   '$ftBranch_Code',
											   '$_POST[fdTrans_date]',
											   '$fcSaldosimpanan',
											   '$_POST[ftNotes]',
											   '$_POST[ftKodeKelompok]',
											   '$_POST[ftKodeWilayah]',
											   '$_POST[ftCustomer_Code]',
											   '$fcPlafond',
											   '$fcPlafond',
											   '$ffBunga',
											   '$fnJW',
											   '$ffAdm',
											   '$fcAdm',
											   '$ffAsuransi',
											   '$fcAsuransi',
											   '$fcMaterai',
											   '$fcPblt',
											   '$fcPelunasan',
											   '$fcDiskon',
											   '$fcSimpanan',
											   '$fcTerimaBersih',
											   '$fcPokokAngsuran',
											   '$fcBunganAngsuran',
											   '$fcAdmAngsuran',
											   '$fcPbltAngsuran',
											   '$fcTabAngsuran',
											   '$fcTotalAngsuran',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang',
											   '1',
											   '0'		
								  )");
								  
	
											
	$tgl = date("d");
	$bln = date("m");
	$thn = date("Y");
	$thn2 = substr($thn, -2);
	$no = "0001";
	// cari id transaksi terakhir yang berawalan tanggal hari ini
	$query = "SELECT max(fnid) AS last FROM txangsuran_mikro_hdr  ";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$lastNoTransaksi = $data['last'];
	$number = range(1,9999);
	$newID = sprintf("%04s", $lastNoTransaksi);
	
	$cariid=mysql_query("SELECT max(ftTrans_No) as notrans FROM txangsuran_mikro_hdr");
	$cari=mysql_fetch_array($cariid);
	$id=$cari['notrans'];
	$pot=substr($id,-4);
	$unik=(string)$pot+1;
	
	if(strlen($unik)==1){
		$unik2='000'.$unik;
	}else if (strlen($unik)==2){
		$unik2='00'.$unik;
	}else if (strlen($unik)==3){
		$unik2='0'.$unik;
	}else{
		$unik2=$unik;
	}	
if($_POST['ftTrans_No_old']!=''){	
	$w=	 mysql_query("INSERT INTO txangsuran_mikro_hdr(ftLoan_No,
												ftBranch_Code,
												fdTrans_date,
												fcPlafond,
												fcPokokAngsuran,
												fcBunganAngsuran,
												fcAdmAngsuran,
												fcPbltAngsuran,
												fcTotalAngsuran,
												ftCustomer_Code,
												ftTrans_No,
												ffBunga,
												fnJW,
												fcOutstanding,
												fcTabAngsuran,
												fcPayment,
												fnStatus,
												ftCreated_User,
												fdCreated_Date
									)
										VALUES('$_POST[ftTrans_No]',
											   '$ftBranch_Code',
											   '$_POST[fdTrans_date]',
											   '$_POST[fcTotalPelunasanPokok]',
											   '$_POST[fcTotalPelunasanPokok]',
											   '$_POST[fcTotalPelunasanBunga]',
											   '$_POST[fcTotalPelunasanAdm]',
											   '$_POST[fcTotalPelunasanPblt]',
											   '$_POST[fcTotalPelunasan]',
											   '$_POST[ftCustomer_Code]',
											   'AM$thn2$bln$unik2',
											   '$_POST[ffBunga]',
											   '$_POST[fnJW]',
											   '$_POST[fcOutstanding]',
											   '$_POST[fcTabAngsuran]',
											   '$_POST[fcTotalPelunasan]',
											   '1',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'     
								  )");								
	}else{}		


$jw=$_POST['fnJW'];		
$transdate=$_POST['fdTrans_date'];	
$date2 = date("Y-m-d", strtotime($transdate));
$date = new DateTime($date2);
/*$query=mysql_fetch_array(mysql_query("SELECT ftCabang,fnTipeNasabah FROM tlnasabah WHERE ftNoRekening='$_POST[ftCustomer_Code]'"));
$Branch_Code=$query["ftCabang"];*/
/*$Tipe=	$query["fnTipeNasabah"];*/

for ($i=1;$i <= $jw;$i++){
	$date->modify("+1 week"); 
	$expired_date = $date->format('Ymd');
//	$expired_date = date ("Y-m-d", strtotime("+1 month", strtotime($expired_date)));
	mysql_query("INSERT INTO txtagihan (
										ftBranch_Code,
										fnIndex,
										ftTrans_No,
										fdTrans_date,
										fcPokokAngsuran,
										fcBungaAngsuran,
										fcAdmAngsuran,
										fcPbltAngsuran,
										fcTabAngsuran,
										fcTotalAngsuran,
										ftTipe,
										ftCustomer_Code,
										ftFlag,
										ftCreated_User,
										fdCreated_Date
										) 
									VALUES(
										'$ftBranch_Code',
										'$i',
										'$_POST[ftTrans_No]',
										'$expired_date',
										'$fcPokokAngsuran',
										'$fcBunganAngsuran',
										'$fcAdmAngsuran',
										'$fcPbltAngsuran',
										'$fcTabAngsuran',
										'$fcTotalAngsuran',
										'$Tipe',
										'$_POST[ftCustomer_Code]',
										'minggu',
										'$_SESSION[namalengkap]',
										'$datetime' ) ");
	
}	
					  
  header('location:transaksi-mikro.html'); 

}else if($ketemu == 1){
	
	echo "<script language=\"JavaScript\">";
	echo "alert(\"Nama Kelompok $_POST[ftKodeKelompok] Sudah Ada\");";
//	echo "location.href=\"tambah-transaksimikro.html\";";
	echo "location.href=\"tambah-transaksimikro-error.html\";";
	echo "</script>";
}
}

// Update transaksi
elseif ($module=='transaksi_mikro' AND $act=='update'){
 
	 mysql_query("UPDATE txpinjaman_mikro_hdr SET fnStatus		= '99',
													ftModified_User	= '$_SESSION[namalengkap]',
													fdModified_date	= '$tgl_sekarang'
											WHERE fnid = '$_POST[id]'
											");
  header('location:transaksi-mikro.html');
	
}elseif ($module=='transaksi_mikro' AND $act=='aksieditnasabah'){
 $fnid=$_GET['fnid'];
 $id=$_GET['id'];
// var_dump($id);var_dump($fnid);exit;
 mysql_query("UPDATE txpinjaman_mikro_nasabah_hdr SET fnStatus		= '99',
													ftModified_User	= '$_SESSION[namalengkap]',
													fdModified_date	= '$tgl_sekarang'
											WHERE fnid = '$_POST[fnid]'
											");
  header('location:add-transaksimikro-'.$id.'.html');
	
}elseif ($module=='transaksi_mikro' AND $act=='add'){
 $id=$_POST['fnid'];
// var_dump($id);exit;
	  mysql_query("INSERT INTO txpinjaman_mikro_nasabah_hdr(
												ftTrans_No,
												ftBranch_Code,
												fdTrans_date,
												fcSaldosimpanan,
												ftNotes,
												ftKodeKelompok,
												ftKodeWilayah,
												ftCustomer_Code,
												fcPlafond,
												fcOutstanding,
												ffBunga,
												fnJW,
												ffAdm,
												fcAdm,
												ffAsuransi,
												fcAsuransi,
												fcMaterai,
												fcPblt,
												fcPelunasan,
												fcDiskon,
												fcSimpanan,
												fcTerimaBersih,
												fcPokokAngsuran,
												fcBunganAngsuran,
												fcAdmAngsuran,
												fcPbltAngsuran,
												fcTabAngsuran,
												fcTotalAngsuran,
												ftCreated_User,
												fdCreated_Date,
												fnStatus,
												fnStatusPembayaran
									)
										VALUES('$_POST[ftTrans_No]',
											   '$ftBranch_Code',
											   '$_POST[fdTrans_date]',
											   '$fcSaldosimpanan',
											   '$_POST[ftNotes]',
											   '$_POST[ftKodeKelompok]',
											   '$_POST[ftKodeWilayah]',
											   '$_POST[ftCustomer_Code]',
											   '$fcPlafond',
											   '$fcPlafond',
											   '$ffBunga',
											   '$fnJW',
											   '$ffAdm',
											   '$fcAdm',
											   '$ffAsuransi',
											   '$fcAsuransi',
											   '$fcMaterai',
											   '$fcPblt',
											   '$fcPelunasan',
											   '$fcDiskon',
											   '$fcSimpanan',
											   '$fcTerimaBersih',
											   '$fcPokokAngsuran',
											   '$fcBunganAngsuran',
											   '$fcAdmAngsuran',
											   '$fcPbltAngsuran',
											   '$fcTabAngsuran',
											   '$fcTotalAngsuran',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang',
											   '1',
											   '0'		
								  )");
	  $jw=$_POST['fnJW'];		
$transdate=$_POST['fdTrans_date'];	
$date2 = date("Y-m-d", strtotime($transdate));
$date = new DateTime($date2);


for ($i=1;$i <= $jw;$i++){
	$date->modify("+1 week"); 
	$expired_date = $date->format('Ymd');
//	$expired_date = date ("Y-m-d", strtotime("+1 month", strtotime($expired_date)));
	mysql_query("INSERT INTO txtagihan (
										ftBranch_Code,
										fnIndex,
										ftTrans_No,
										fdTrans_date,
										fcPokokAngsuran,
										fcBungaAngsuran,
										fcAdmAngsuran,
										fcPbltAngsuran,
										fcTabAngsuran,
										fcTotalAngsuran,
										ftTipe,
										ftCustomer_Code,
										ftFlag,
										ftCreated_User,
										fdCreated_Date
										) 
									VALUES(
										'$ftBranch_Code',
										'$i',
										'$_POST[ftTrans_No]',
										'$expired_date',
										'$fcPokokAngsuran',
										'$fcBunganAngsuran',
										'$fcAdmAngsuran',
										'$fcPbltAngsuran',
										'$fcTabAngsuran',
										'$fcTotalAngsuran',
										'$Tipe',
										'$_POST[ftCustomer_Code]',
										'minggu',
										'$_SESSION[namalengkap]',
										'$datetime' ) ");
	
}
  header('location:add-transaksimikro-'.$id.'.html');
	
}elseif ($module=='transaksi_mikro' AND $act=='edittglmikro'){
 $fdTransdate=$_POST['fdTransdate'];	
 $fdTransId=$_POST['fdTransId'];	
 $fdTransNo=$_POST['fdTransNo'];
// var_dump($fdTransdate);var_dump($fdTransId);var_dump($fdTransNo);exit;
mysql_query("UPDATE txpinjaman_mikro_hdr SET fdTrans_date	= '$fdTransdate',
											 ftModified_User	= '$_SESSION[namalengkap]',
											 fdModified_date	= '$tgl_sekarang'
										 WHERE fnid = '$fdTransId'
										");
 mysql_query("UPDATE txpinjaman_mikro_nasabah_hdr SET fdTrans_date	= '$fdTransdate',
													  ftModified_User	= '$_SESSION[namalengkap]',
													  fdModified_date	= '$tgl_sekarang'
											      WHERE ftTrans_No = '$fdTransNo'
											");
  header('location:add-transaksimikro-'.$fdTransId.'.html');
	
}
}
?>

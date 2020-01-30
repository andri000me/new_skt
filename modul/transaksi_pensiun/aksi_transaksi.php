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
$ffProvisi =str_replace(',', '',$_POST['ffProvisi']);
$fcProvisi =str_replace(',', '',$_POST['fcProvisi']);
$ffAsuransi =str_replace(',', '',$_POST['ffAsuransi']);
$fcAsuransi =str_replace(',', '',$_POST['fcAsuransi']);
$ffPpap =str_replace(',', '',$_POST['ffPpap']);
$fcPpap =str_replace(',', '',$_POST['fcPpap']);
$fcMaterai =str_replace(',', '',$_POST['fcMaterai']);
$fcRrp =str_replace(',', '',$_POST['fcRrp']);
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

$query=mysql_fetch_array(mysql_query("SELECT ftCabang,fnTipeNasabah FROM tlnasabah WHERE ftNoRekening='$_POST[ftCustomer_Code]'"));
/*$Branch_Code=$query["ftCabang"];*/
$Tipe=	$query["fnTipeNasabah"];
// Hapus transaksi
if ($module=='transaksi_pensiun' AND $act=='delete'){
  mysql_query("DELETE FROM txpinjaman_pensiun_hdr WHERE fnid='$_GET[fnid]'");
  header('location:transaksi.html');
}

// Input transaksi
elseif ($module=='transaksi_pensiun' AND $act=='input'){
	$sql=mysql_query("SELECT ftTrans_No FROM txpinjaman_pensiun_hdr WHERE ftTrans_No='$_POST[ftTrans_No]' ");
	$duplicate=mysql_num_rows($sql);
	if($duplicate != 0){
		$tgl = date("d");
		$bln = date("m");
		$thn = date("Y");
		$thn2 = substr($thn, -2);
		$cariid=mysql_query("SELECT max(fnid) AS notrans FROM txpinjaman_pensiun_hdr");
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
		$ftTrans_No= "PJP$thn2$bln$unik2";
	}else{
		$ftTrans_No= $_POST['ftTrans_No'];
	}
	$exec=  mysql_query("INSERT INTO txpinjaman_pensiun_hdr(
												ftTrans_No,
												ftBranch_Code,
												fdTrans_date,
												fcSaldosimpanan,
												ftNotes,
												ftCustomer_Code,
												fcPlafond,
												fcOutstanding,
												ffBunga,
												fnJW,
												ffAdm,
												fcAdm,
												ffProvisi,
												fcProvisi,
												ffAsuransi,
												fcAsuransi,
												ffPpap,
												fcPpap,
												fcMaterai,
												fcRrp,
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
										VALUES('$ftTrans_No',
											   '$ftBranch_Code',
											   '$_POST[fdTrans_date]',
											   '$fcSaldosimpanan',
											   '$_POST[ftNotes]',
											   '$_POST[ftCustomer_Code]',
											   '$fcPlafond',
											   '$fcPlafond',
											   '$ffBunga',
											   '$fnJW',
											   '$ffAdm',
											   '$fcAdm',
											   '$ffProvisi',
											   '$fcProvisi',
											   '$ffAsuransi',
											   '$fcAsuransi',
											   '$ffPpap',
											   '$fcPpap',
											   '$fcMaterai',
											   '$fcRrp',
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
								  
	
//	var_dump($exec);	exit;									
	$tgl = date("d");
	$bln = date("m");
	$thn = date("Y");
	$thn2 = substr($thn, -2);
	$no = "0001";
	// cari id transaksi terakhir yang berawalan tanggal hari ini
	$query = "SELECT max(fnid) AS last FROM txangsuran_pensiun_hdr  ";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$lastNoTransaksi = $data['last'];
	$number = range(1,9999);
	$newID = sprintf("%04s", $lastNoTransaksi);
	
	$cariid=mysql_query("SELECT max(ftTrans_No) as notrans FROM txangsuran_pensiun_hdr");
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
 	
	$w=	 mysql_query("INSERT INTO txangsuran_pensiun_hdr(ftLoan_No,
												ftBranch_Code,
												fcPlafond,
												fcPokokAngsuran,
												fcBunganAngsuran,
												fcAdmAngsuran,
												fcPbltAngsuran,
												fcTotalAngsuran,
												fdTrans_date,
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
											   '$_POST[fcTotalPelunasanPokok]',
											   '$_POST[fcTotalPelunasanPokok]',
											   '$_POST[fcTotalPelunasanBunga]',
											   '$_POST[fcTotalPelunasanAdm]',
											   '$_POST[fcTotalPelunasanPblt]',
											   '$_POST[fcTotalPelunasan]',
											   '$_POST[fdTrans_date]',
											   '$_POST[ftCustomer_Code]',
											   'AU$thn2$bln$unik2',
											   '$_POST[ffBunga]',
											   '$_POST[fnJW]',
											   '$_POST[fcOutstanding]',
											   '$_POST[fcTabAngsuran]',
											   '$_POST[fcTotalPelunasan]',
											   '1',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'     
								  )");	
 }								  
	
$jw=$_POST['fnJW'];		
$transdate=$_POST['fdTrans_date'];	
$date2 = date("Y-m-d", strtotime($transdate));
$date = new DateTime($date2);

for ($i=1;$i <= $jw;$i++){
	$date->modify("+1 month");
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
										'bulan',
										'$_SESSION[namalengkap]',
										'$datetime' ) ");
	
}							  
  header('location:transaksi.html'); 

}

// Update transaksi
elseif ($module=='transaksi_pensiun' AND $act=='update'){
 
	 mysql_query("UPDATE txpinjaman_pensiun_hdr SET fnStatus		= '99',
													ftModified_User	= '$_SESSION[namalengkap]',
													fdModified_date	= '$tgl_sekarang'
											WHERE fnid = '$_POST[id]'
											");
  header('location:transaksi.html');
	
}
}
?>

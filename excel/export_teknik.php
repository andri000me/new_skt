<?php
session_start();
include "../config/config.php";

$fullname	= $_SESSION['fullname'];
$time=date("h:i:s a");
$time2=date('Y-m-d (H:i:s)');
$tanggal=date('d-F-Y');
$tanggal2=date('Y-m-d');
header("Content-Type: application/msexcel");
header('Content-Disposition: attachment; filename="Export Teknik ' .$time2.'.xls"');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Export Teknik</title>
<style type="text/css"></style>
</head>
<body>
<span >Export Teknik</span><br>
<span >DATE  :  <?php echo $tanggal;?> </span><br>
<span >TIME  :  <?php echo $time;?> </span><br>

<table border="1"  width="100%" >
	<tr>
		<td width="50" height="50"><b>No</b></td>
        <td width="100"><b>DIVISI</b></td>    
		<td width="100"><b>NO INTERNAL USER</b></td> 
		<td width="100"><b>NO SO</b></td>
		<td width="100"><b>JUDUL PEKERJAAN</b></td>
		<td width="100"><b>NO PKB</b></td>    
		<td width="100"><b>TANGGAL PKB</b></td> 
		<td width="100"><b>NOMINAL</b></td>
		<td width="100"><b>NAMA PELAKSANA</b></td>
		<td width="100"><b>NAMA PELANGGAN</b></td>    
		<td width="100"><b>SBU</b></td> 
		<td width="100"><b>LAIN - LAIN</b></td>
		<td width="100"><b>PEMBERI KERJA</b></td>
		<td width="100"><b>LAYANAN</b></td>    
		<td width="100"><b>PROGRESS AKTIVASI</b></td> 
		<td width="100"><b>DETAIL PROGRESS</b></td>
		<td width="100"><b>MASA BERLAKU PEKERJAAN</b></td>		
		<td width="100"><b>KENDALA</b></td>
		<td width="100"><b>DETAIL KENDALA</b></td>
		<td width="100"><b>NO BAI</b></td>
		<td width="100"><b>TANGGAL BAI</b></td>
		<td width="100"><b>NO QC</b></td>
		<td width="100"><b>TANGGAL QC</b></td>
		<td width="100"><b>NO PKT</b></td>
		<td width="100"><b>TANGGAL PKT</b></td>
		<td width="100"><b>NOMINAL PKT</b></td>
		<td width="100"><b>JENIS BA</b></td>
		<td width="100"><b>NO BAST/ BAPS</b></td>
		<td width="100"><b>TGL BAST/ BAPS</b></td>
		<td width="100"><b>RINCIAN BAUK</b></td>
		<td width="100"><b>NO BAUK</b></td>
		<td width="100"><b>TANGGAL BAUK</b></td>
		<td width="100"><b>RINCIAN BAUK2</b></td>
		<td width="100"><b>NO BAUK2</b></td>
		<td width="100"><b>TANGGAL BAUK2</b></td>
		<td width="100"><b>RINCIAN BAUK3</b></td>
		<td width="100"><b>NO BAUK3</b></td>
		<td width="100"><b>TANGGAL BAUK3</b></td>
		<td width="100"><b>RINCIAN BAUK4</b></td>
		<td width="100"><b>NO BAUK4</b></td>
		<td width="100"><b>TANGGAL BAUK4</b></td>
		<td width="100"><b>RINCIAN BAUK5</b></td>
		<td width="100"><b>NO BAUK5</b></td>
		<td width="100"><b>TANGGAL BAUK5</b></td>
		<td width="100"><b>RINCIAN BAUK6</b></td>
		<td width="100"><b>NO BAUK6</b></td>
		<td width="100"><b>TANGGAL BAUK6</b></td>
		<td width="100"><b>RINCIAN BAUK7</b></td>
		<td width="100"><b>NO BAUK7</b></td>
		<td width="100"><b>TANGGAL BAUK7</b></td>
		<td width="100"><b>RINCIAN BAUK8</b></td>
		<td width="100"><b>NO BAUK8</b></td>
		<td width="100"><b>TANGGAL BAUK8</b></td>
		<td width="100"><b>RINCIAN BAUK9</b></td>
		<td width="100"><b>NO BAUK9</b></td>
		<td width="100"><b>TANGGAL BAUK9</b></td>
		<td width="100"><b>RINCIAN BAUK10</b></td>
		<td width="100"><b>NO BAUK10</b></td>
		<td width="100"><b>TANGGAL BAUK10</b></td>
		<td width="100"><b>RINCIAN BAUK11</b></td>
		<td width="100"><b>NO BAUK11</b></td>
		<td width="100"><b>TANGGAL BAUK11</b></td>
		<td width="100"><b>RINCIAN BAUK12</b></td>
		<td width="100"><b>NO BAUK12</b></td>
		<td width="100"><b>TANGGAL BAUK12</b></td>
		
	</tr>
	<?php 
	if($_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='3' || $_SESSION[leveluser]=='6' || $_SESSION[leveluser]=='7'){
		$tampil=mysql_query("SELECT * FROM tbl_teknik WHERE aktif='Y' ORDER BY id_teknik DESC");
	}else if($_SESSION[leveluser]=='4'){
		$tampil=mysql_query("SELECT * FROM tbl_teknik WHERE aktif='Y' AND created_by='$_SESSION[namauser]' ORDER BY id_teknik DESC");
	}

$exequeabsdetail = mysql_query($strsql);
while($row = mysql_fetch_array($tampil)){
//	 $tgl_pengajuan=tgl_indo($row[tgl_pengajuan]);
	?>
	<tr>
		<td  ><?php echo ++$c ?></td>
        <td ><?php echo $row['divisi'];?></td>   
		<td ><?php echo $row['no_in_user'];?></td>   
		<td ><?php echo $row['no_so'];?></td>   
		<td ><?php echo $row['judul_pekerjaan'];?></td>   
		<td ><?php echo $row['no_pkb'];?></td>   
		<td ><?php echo $row['tgl_pkb'];?></td>   
		<td ><?php echo $row['nominal'];?></td>   
		<td ><?php echo $row['nama_pelaksana'];?></td>   
		<td ><?php echo $row['nama_pelanggan'];?></td>   
		<td ><?php echo $row['sbu'];?></td>   
		<td ><?php echo $row['lain_lain'];?></td>
        <td ><?php echo $row['pemberi_kerja'];?></td>
        <td ><?php echo $row['layanan'];?></td>
		<td ><?php echo $row['progress_aktivasi'];?></td>
		<td ><?php echo $row['detail_progress'];?></td>
		<td ><?php echo $row['masa_berlaku_pekerjaan'];?></td>
        <td ><?php echo $row['kendala'];?></td>
		<td ><?php echo $row['detail_kendala'];?></td>
		<td ><?php echo $row['no_bai'];?></td>
		<td ><?php echo $row['tgl_bai'];?></td>
		<td ><?php echo $row['no_qc'];?></td>
		<td ><?php echo $row['tgl_qc'];?></td>
		<td ><?php echo $row['no_pkt'];?></td>
		<td ><?php echo $row['tgl_pkt'];?></td>
		<td ><?php echo $row['nominal_pkt'];?></td>
		<td ><?php echo $row['jenis_ba'];?></td>
		<td ><?php echo $row['no_bast'];?></td>
		<td ><?php echo $row['tgl_bast'];?></td>
		<td ><?php echo $row['rincian_bauk'];?></td>
		<td ><?php echo $row['no_bauk'];?></td>
		<td ><?php echo $row['tgl_bauk'];?></td>
		<td ><?php echo $row['rincian_bauk2'];?></td>
		<td ><?php echo $row['no_bauk2'];?></td>
		<td ><?php echo $row['tgl_bauk2'];?></td>
		<td ><?php echo $row['rincian_bauk3'];?></td>
		<td ><?php echo $row['no_bauk3'];?></td>
		<td ><?php echo $row['tgl_bauk3'];?></td>
		<td ><?php echo $row['rincian_bauk4'];?></td>
		<td ><?php echo $row['no_bauk4'];?></td>
		<td ><?php echo $row['tgl_bauk4'];?></td>
		<td ><?php echo $row['rincian_bauk5'];?></td>
		<td ><?php echo $row['no_bauk5'];?></td>
		<td ><?php echo $row['tgl_bauk5'];?></td>
		<td ><?php echo $row['rincian_bauk6'];?></td>
		<td ><?php echo $row['no_bauk6'];?></td>
		<td ><?php echo $row['tgl_bauk6'];?></td>
		<td ><?php echo $row['rincian_bauk7'];?></td>
		<td ><?php echo $row['no_bauk7'];?></td>
		<td ><?php echo $row['tgl_bauk7'];?></td>
		<td ><?php echo $row['rincian_bauk8'];?></td>
		<td ><?php echo $row['no_bauk8'];?></td>
		<td ><?php echo $row['tgl_bauk8'];?></td>
		<td ><?php echo $row['rincian_bauk9'];?></td>
		<td ><?php echo $row['no_bauk9'];?></td>
		<td ><?php echo $row['tgl_bauk9'];?></td>
		<td ><?php echo $row['rincian_bauk10'];?></td>
		<td ><?php echo $row['no_bauk10'];?></td>
		<td ><?php echo $row['tgl_bauk10'];?></td>
		<td ><?php echo $row['rincian_bauk11'];?></td>
		<td ><?php echo $row['no_bauk11'];?></td>
		<td ><?php echo $row['tgl_bauk11'];?></td>
		<td ><?php echo $row['rincian_bauk12'];?></td>
		<td ><?php echo $row['no_bauk12'];?></td>
		<td ><?php echo $row['tgl_bauk12'];?></td>
		
	</tr>
	<?php } ?>
</table>
</body>
</html>
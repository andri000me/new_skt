<?php
session_start();
include "../config/config.php";

$fullname	= $_SESSION['fullname'];
$time=date("h:i:s a");
$time2=date('Y-m-d (H:i:s)');
$tanggal=date('d-F-Y');
$tanggal2=date('Y-m-d');
header("Content-Type: application/msexcel");
header('Content-Disposition: attachment; filename="Export Keuangan ' .$time2.'.xls"');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Export Keuangan</title>
<style type="text/css"></style>
</head>
<body>
<span >Export Keuangan</span><br>
<span >DATE  :  <?php echo $tanggal;?> </span><br>
<span >TIME  :  <?php echo $time;?> </span><br>

<table border="1"  width="100%" >
	<tr>
		<td width="50" height="50"><b>No</b></td>
        <td width="100"><b>DIVISI</b></td>    
		<td width="100"><b>NO INTERNAL USER</b></td> 
		<td width="100"><b>NO SO</b></td>
		<td width="100"><b>JUDUL PEKERJAAN</b></td>
		<td width="100"><b>NO GR</b></td>    
		<td width="100"><b>TANGGAL GR</b></td> 
		<td width="100"><b>NOMINAL GR</b></td>
		<td width="100"><b>STATUS GR</b></td>
		<td width="100"><b>NO INVOICE</b></td>    
		<td width="100"><b>TGL INVOICE</b></td> 
		<td width="100"><b>NOMINAL INVOICE</b></td>
		<td width="100"><b>STATUS PEMBAYARAN</b></td>
		<td width="100"><b>TGL PEMBAYARAN</b></td>    
		<td width="100"><b>NOMINAL PEMBAYARAN</b></td> 
		<td width="100"><b>CATATAN</b></td>
				
	</tr>
	<?php 
	$tampil=mysql_query("SELECT * FROM tbl_keuangan a LEFT JOIN tbl_teknik b ON a.id_teknik=b.id_teknik AND a.aktif='Y' ORDER BY a.id_keuangan DESC");

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
		<td ><?php echo $row['no_gr'];?></td>   
		<td ><?php echo $row['tgl_gr'];?></td>   
		<td ><?php echo $row['nominal_gr'];?></td>   
		<td ><?php echo $row['status_gr'];?></td>   
		<td ><?php echo $row['no_invoice'];?></td>   
		<td ><?php echo $row['tgl_invoice'];?></td>   
		<td ><?php echo $row['nominal_invoice'];?></td>
        <td ><?php echo $row['status_pembayaran'];?></td>
        <td ><?php echo $row['tgl_pembayaran'];?></td>
		<td ><?php echo $row['nominal_pembayaran'];?></td>
		<td ><?php echo $row['catatan'];?></td>
		
		
	</tr>
	<?php } ?>
</table>
</body>
</html>
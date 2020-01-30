<?php
$emprut=$_POST['export'];
$startDate = substr($emprut,0,10);
$endDate = substr($emprut,-10);

session_start();
include "../config/config.php";
include "../config/fungsi_rupiah.php";
//include "../modul/laporan_daftar_tagihan_pensiun/tampil.php";
//$fullname	= $_SESSION['fullname'];
$time=date("h:i:s a");
$time2=date('Y-m-d (H:i:s)');
$tanggal=date('d-F-Y');
$tanggal2=date('Y-m-d');

if(isset($_POST['export']))
	{

header("Content-Type: application/msexcel");
header('Content-Disposition: attachment; filename="EXPORT LAPORAN PELUNASAN KREDIT PENSIUN ' .$time2.'.xls"');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EXPORT LAPORAN PELUNASAN KREDIT PENSIUN</title>
<style type="text/css"></style>
</head>
<body id="export">
<span >EXPORT LAPORAN PELUNASAN KREDIT PENSIUN</span><br>
<span >DATE  :  <?php echo $tanggal2;?> </span><br>
<span >TIME  :  <?php echo $time;?> </span><br><br>

<span ><center><b>LAPORAN PELUNASAN KREDIT PENSIUN <?php echo $startDate;?> Sampai <?php echo $endDate;?></b></center></span ><br><br>


<table border="1"  width="100%" >
	<tr class="success">
        <th rowspan="2"><b><center>NO<center></b></th>
        <th rowspan="2" ><b><center>TGL. TRANS<center></b></th>
        <th rowspan="2" width="90"><b><center>NOREK<center></b></th>
        <th rowspan="2" width="200"><b><center>NAMA<center></b></th>
        <th rowspan="2" width="200"><b><center>PERUSAHAAN<center></b></th>
        <th rowspan="2" width="50"><b><center>USIA<center></b></th>
        <th rowspan="2" width="50"><b><center>JW<center></b></th>
        <th><b><center>TGL<center></b></th>
        <th><b><center>NOMINAL<center></b></th>
        <th><b><center>ANGS<center></b></th>
        <th><b><center>TAB<center></b></th>
        <th><b><center>TOTAL</th>
        <th colspan="7"><b><center>POTONGAN</center><center></b></th>
        <th></th>
        <th colspan="5"><b><center>PELUNASAN<center></b></th>
        <th><b><center>TOTAL<center></b></th>
        <th><b><center>TERIMA<center></b></th>
    </tr>
    <tr class="success">
        <th><b><center>GAJI<center></b></th>
        <th><b><center>PINJAMAN<center></b></th>
        <th></th>
        <th></th>
        <th><b><center>ANGS<center></b></th>
        <th><b><center>ADM<center></b></th>
        <th><b><center>PROVISI<center></b></th>
        <th><b><center>ASS<center></b></th>
        <th><b><center>PPAP<center></b></th>
        <th><b><center>MAT<center></b></th>
        <th><b><center>PBLT<center></b></th>
        <th><b><center>TAB<center></b></th>
        <th><b><center>RRP<center></b></th>
        <th><b><center>POKOK<center></b></th>
        <th><b><center>BUNGA<center></b></th>
        <th><b><center>ADM<center></b></th>
        <th><b><center>TAB<center></b></th>
        <th><b><center>PNOL<center></b></th>
        <th><b><center>POT<center></b></th>
        <th><b><center>BERSIH<center></b></th>
    </tr>
	<?php 
	
		$tampil=mysql_query("SELECT a.fdTrans_date, a.ftCustomer_Code,  b.ftNamaNasabah, '' AS ftPerusahaan, 0 AS fnUsia, a.fnJw,
CURDATE() AS fdTgl_gaji, a.ftTrans_No AS ftNoPinjaman,  a.fcPlafond,
a.fcPokokAngsuran + a.fcBunganAngsuran + a.fcAdmAngsuran + a.fcPbltAngsuran AS fcAngsuran, a.fcTabAngsuran,
a.fcTotalAngsuran, a.fcAdm, a.fcProvisi, a.fcAsuransi, 0 AS fcPPAP, a.fcMaterai, a.fcPblt, a.fcSimpanan, 0 AS fcRRP,
IFNULL(c.fcPokokAngsuran,0) AS fcPokokPelunasan, IFNULL(c.fcBunganAngsuran,0) AS fcBungaPelunasan, 
IFNULL(c.fcAdmAngsuran,0) AS fcAdmPelunasan , IFNULL(c.fcPbltAngsuran,0) AS fcPbltPelunasan,a.fcSimpanan,
a.fcAdm + a.fcProvisi + a.fcAsuransi + 0 + a.fcMaterai + a.fcPblt + a.fcSimpanan + 0 AS fcTotalPotongan,
a.fcTerimaBersih
FROM TxPinjaman_Pensiun_hdr a
LEFT JOIN TLnasabah b ON a.ftCustomer_Code = b.ftNoRekening
LEFT JOIN TXAngsuran_Pensiun_Hdr c ON c.ftLoan_No = a.ftTrans_No
WHERE a.fnStatus <> 9 AND LEFT(a.ftTrans_No,3) = 'PJP' AND a.fdTrans_date between '$startDate' AND '$endDate' ORDER BY a.fdTrans_date ASC");
	
$no1 = 0;

while($row = mysql_fetch_array($tampil)){
		$NOMINAL=$row['fcPlafond'];
		$ANGS=$row['fcAngsuran'];
		$TAB=$row['fcTabAngsuran'];
		$TOTAL_ANGS=$row['fcTotalAngsuran'];
		$ADM_POT=$row['fcAdm'];
		$PROVISI=$row['fcProvisi'];
		$ASS=$row['fcAsuransi'];
		$PPAP=$row['fcPPAP'];
		$MAT=$row['fcMaterai'];
		$PBLT=$row['fcPblt'];
		$TAB_POT=$row['fcSimpanan'];
		$RRP=$row['fcRRP'];
		$POKOK=$row['fcPokokPelunasan'];
		$BUNGA=$row['fcBungaPelunasan'];
		$ADM_PEL=$row['fcAdmPelunasan'];
		$TAB_PEL=$row['fcSimpanan'];
		$PNOL=$row['fcPbltPelunasan'];
		$POT=$row['fcTotalPotongan'];
		$BERSIH=$row['fcTerimaBersih'];
		
		$no1++;	
	?>
	<tr>
		<td  ><?php echo $no1 ?></td>
        <td ><?php echo $row['fdTrans_date'];?></td>   
		<td ><?php echo $row['ftCustomer_Code'];?></td>   
		<td ><?php echo $row['ftNamaNasabah'];?></td>   
		<td ><?php echo $row['ftPerusahaan'];?></td>   
		<td ><?php echo $row['fnUsia'];?></td>   
		<td ><?php echo $row['fnJw'];?></td>   
		<td ><?php echo $row['fdTgl_gaji'];?></td>   
		<td ><?php echo $NOMINAL;?></td>   
		<td ><?php echo $ANGS;?></td>   
		<td ><?php echo $TAB;?></td>   
		<td ><?php echo $TOTAL_ANGS;?></td>
        <td ><?php echo $ADM_POT;?></td>
        <td ><?php echo $PROVISI;?></td>
		<td ><?php echo $ASS;?></td>
		<td ><?php echo $PPAP;?></td>
		<td ><?php echo $MAT;?></td>
        <td ><?php echo $PBLT;?></td>
		<td ><?php echo $TAB_POT;?></td>
		<td ><?php echo $RRP;?></td>
		<td ><?php echo $POKOK;?></td>
		<td ><?php echo $BUNGA;?></td>
		<td ><?php echo $ADM_PEL;?></td>
		<td ><?php echo $TAB_PEL;?></td>
		<td ><?php echo $PNOL;?></td>
		<td ><?php echo $POT;?></td>
		<td ><?php echo $BERSIH;?></td>
		
		
		
	</tr>
	<?php } ?>
</table>
</body>
</html>
<?php } ?>
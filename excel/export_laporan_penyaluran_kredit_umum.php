<?php 
$emprut=$_POST['export'];
$startDate = substr($emprut,0,10);
$endDate = substr($emprut,-10);

session_start();
include "../config/config.php";
//include "../config/fungsi_rupiah.php";
//include "../modul/laporan_penyaluran_kredit_pensiun/tampil.php";
//$fullname	= $_SESSION['fullname'];
$time=date("h:i:s a");
$time2=date('Y-m-d (H:i:s)');
$tanggal=date('d-F-Y');
$tanggal2=date('Y-m-d');

if(isset($_POST['export']))
	{

header("Content-Type: application/msexcel");
header('Content-Disposition: attachment; filename="EXPORT LAPORAN PENYALURAN KREDIT UMUM ' .$time2.'.xls"');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EXPORT LAPORAN PENYALURAN KREDIT UMUM</title>
<style type="text/css"></style>
</head>
<body id="export">
<span >EXPORT LAPORAN PENYALURAN KREDIT UMUM</span><br>
<span >DATE  :  <?php echo $tanggal2;?> </span><br>
<span >TIME  :  <?php echo $time;?> </span><br><br>
<?php
 $header=mysql_query("SELECT b.ftKantorBayar AS ftKantorBayar,a.fdTrans_date FROM txpinjaman_umum_hdr a LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening WHERE a.fnStatus <> 9 AND a.fdTrans_date between '$startDate' AND '$endDate' GROUP BY ftKantorBayar ");
              //while($w=mysql_fetch_array($header)){
                $ketemu=mysql_num_rows($header);
               while($w=mysql_fetch_array($header)){
            $d=$w[ftKantorBayar];
            $e=$w[fdTrans_date];
$temp ="<center><b>LAPORAN PENYALURAN KREDIT UMUM<br>TANGGAL : $e<br>Kantor Bayar :$d";
$temp .="</b></center><table  id='table' class='table table-bordered table-striped' border=1 width=100%>
        <thead>
        <tr class='success'>
                <th rowspan='2'><b><center>NO<center></b></th>
                <th rowspan='2' ><b><center>TGL. TRANS<center></b></th>
                <th rowspan='2' width='90'><b><center>NOREK<center></b></th>
                <th rowspan='2' width='200'><b><center>NAMA<center></b></th>
                <th rowspan='2' width='200'><b><center>PERUSAHAAN<center></b></th>
                <th rowspan='2' width='50'><b><center>USIA<center></b></th>
                <th rowspan='2' width='50'><b><center>JW<center></b></th>
                <th><b><center>TGL<center></b></th>
                <th><b><center>NOMINAL<center></b></th>
                <th><b><center>ANGS<center></b></th>
                <th><b><center>TAB<center></b></th>
                <th><b><center>TOTAL</th>
                <th colspan='7'><b><center>POTONGAN</center><center></b></th>
                <th></th>
                <th colspan='5'><b><center>PELUNASAN<center></b></th>
                <th><b><center>TOTAL<center></b></th>
                <th><b><center>TERIMA<center></b></th>
            </tr>
            <tr class='success'>
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
            <thead>
            <tbody>"; 
	
	
		$tampil=mysql_query("SELECT a.fdTrans_date, a.ftCustomer_Code,  b.ftNamaNasabah, b.ftkantorbayar AS ftPerusahaan, 0 AS fnUsia, a.fnJw,
CURDATE() AS fdTgl_gaji,  
FORMAT(a.fcPlafond,0) AS fcPlafond,
FORMAT(a.fcPokokAngsuran + a.fcBunganAngsuran + a.fcAdmAngsuran + a.fcPbltAngsuran,0) AS fcAngsuran, 
FORMAT(a.fcTabAngsuran,0) AS fcTabAngsuran,
FORMAT(a.fcTotalAngsuran,0) AS fcTotalAngsuran, 
FORMAT(a.fcAdm,0) AS fcAdm, 
FORMAT(a.fcProvisi,0) AS fcProvisi, 
FORMAT(a.fcAsuransi,0) AS fcAsuransi, 
FORMAT(a.fcPpap,0) AS fcPPAP, 
FORMAT(a.fcMaterai,0) AS fcMaterai, 
FORMAT(a.fcPblt,0) AS fcPblt, 
FORMAT(a.fcSimpanan,0) AS fcSimpanan, 
FORMAT(a.fcRRP,0) AS fcRRP,
FORMAT(IFNULL(c.fcPokokAngsuran,0),0) AS fcPokokPelunasan, 
FORMAT(IFNULL(c.fcBunganAngsuran,0),0) AS fcBungaPelunasan, 
FORMAT(IFNULL(c.fcAdmAngsuran,0),0) AS fcAdmPelunasan , 
FORMAT(IFNULL(c.fcPbltAngsuran,0),0) AS fcPbltPelunasan,
a.fcSimpanan,
FORMAT(a.fcAdm + a.fcProvisi + a.fcAsuransi + 0 + a.fcMaterai + a.fcPblt + a.fcSimpanan + 0,0) AS fcTotalPotongan,
FORMAT(a.fcTerimaBersih,0) AS fcTerimaBersih
FROM txpinjaman_umum_hdr a
LEFT JOIN TLnasabah b ON a.ftCustomer_Code = b.ftNoRekening
LEFT JOIN txangsuran_umum_hdr c ON c.ftLoan_No = a.ftTrans_No
WHERE a.fnStatus <> 9 AND LEFT(a.ftTrans_No,3) = 'PJU' AND b.ftkantorbayar='$d' AND a.fdTrans_date between '$startDate' AND '$endDate' 
UNION ALL

SELECT  '' ,
        '' ,
        '' ,
        '' ,
        '' ,
        '' ,
        
        '<b>GRAND TOTAL -></b>' AS ftNoPinjaman,
        FORMAT(SUM(a.fcPlafond),0) AS fcPlafond,
        FORMAT(SUM(a.fcPokokAngsuran + a.fcBunganAngsuran + a.fcAdmAngsuran + a.fcPbltAngsuran),0) AS fcAngsuran,
        FORMAT(SUM(a.fcTabAngsuran),0) AS fcTabAngsuran,
        FORMAT(SUM(a.fcTotalAngsuran),0) AS fcTotalAngsuran,
        FORMAT(SUM(a.fcAdm),0) AS fcAdm,
        FORMAT(SUM(a.fcProvisi),0) AS fcProvisi,
        FORMAT(SUM(a.fcAsuransi),0) AS fcAsuransi,
        FORMAT(SUM(a.fcPpap),0) AS fcPPAP,
        FORMAT(SUM(a.fcMaterai),0) AS fcMaterai,
        FORMAT(SUM(a.fcPblt),0) AS fcPblt,
        FORMAT(SUM(a.fcSimpanan),0) AS fcSimpanan,
        FORMAT(SUM(a.fcRRP),0) AS fcRRP,
        FORMAT(SUM(c.fcPokokAngsuran),0) AS fcPokokPelunasan,
        FORMAT(SUM(c.fcBunganAngsuran),0) AS fcBungaPelunasan,
        FORMAT(SUM(c.fcAdmAngsuran),0) AS fcAdmPelunasan,
        FORMAT(SUM(c.fcPbltAngsuran),0) AS fcPbltPelunasan,
        FORMAT(SUM(a.fcSimpanan),0) AS fcSimpanan,
        FORMAT(SUM( a.fcProvisi + a.fcAsuransi + 0 + a.fcMaterai + a.fcPblt + a.fcSimpanan + 0),0) AS fcTotalPotongan,
        FORMAT(SUM(a.fcTerimaBersih),0) AS fcTerimaBersih
FROM txpinjaman_umum_hdr a
LEFT JOIN TLnasabah b ON a.ftCustomer_Code = b.ftNoRekening
LEFT JOIN txangsuran_umum_hdr c ON c.ftLoan_No = a.ftTrans_No
WHERE a.fnStatus <> 9 AND LEFT(a.ftTrans_No,3) = 'PJU' AND b.ftkantorbayar='$d' AND a.fdTrans_date between '$startDate' AND '$endDate' 
");
	
$no1 = 0;

while($r = mysql_fetch_array($tampil)){
		$no1++;	
$temp .="<tr>
        <td>$no1</td>
        <td >$r[fdTrans_date]</td>
        <td>$r[ftCustomer_Code]</td>
        <td>$r[ftNamaNasabah]</td>
        <td>$r[ftPerusahaan]</td>
        <td>$r[fnUsia]</td>
        <td>$r[fnJw]</td>
        <td>$r[fdTgl_gaji]</td>
        
        <td>$r[fcPlafond]</td>
        <td>$r[fcAngsuran]</td>
        <td>$r[fcTabAngsuran]</td>
        <td>$r[fcTotalAngsuran]</td>
        <td>$r[fcAdm]</td>
        <td>$r[fcProvisi]</td>
        <td>$r[fcAsuransi]</td>
        <td>$r[fcPPAP]</td>
        <td>$r[fcMaterai]</td>
        <td>$r[fcPblt]</td>
        <td>$r[fcSimpanan]</td>
        <td>$r[fcRRP]</td>
        <td>$r[fcPokokPelunasan]</td>
        <td>$r[fcBungaPelunasan]</td>
        <td>$r[fcAdmPelunasan]</td>
        <td>$r[fcPbltPelunasan]</td>
        <td>$r[fcSimpanan]</td>
        <td>$r[fcTotalPotongan]</td>
        <td>$r[fcTerimaBersih]</td>
    </tr>";
   }
$temp .="</tbody>
    	 </table><br><br>";
echo $temp;
	}
}
 ?>
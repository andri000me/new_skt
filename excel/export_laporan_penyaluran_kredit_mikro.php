<?php 
session_start();
error_reporting(0);
include "../config/config.php";
$emprut=$_POST['export'];
$startDate = substr($emprut,0,10);
$endDate = substr($emprut,-10);
//var_dump($emprut);exit;
//include "../config/fungsi_rupiah.php";
//include "../modul/laporan_penyaluran_kredit_pensiun/tampil.php";
//$fullname	= $_SESSION['fullname'];
$time=date("h:i:s a");
$time2=date('Y-m-d (H:i:s)');
$tanggal=date('d-F-Y');
$tanggal2=date('Y-m-d');

if(isset($_POST['export'])){
header("Content-Type: application/msexcel");
header('Content-Disposition: attachment; filename="EXPORT LAPORAN PENYALURAN KREDIT MIKRO ' .$time2.'.xls"');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EXPORT LAPORAN PENYALURAN KREDIT MIKRO</title>
<style type="text/css"></style>
</head>
<body id="export">
<span >EXPORT LAPORAN PENYALURAN KREDIT MIKRO</span><br>
<span >DATE  :  <?php echo $tanggal2;?> </span><br>
<span >TIME  :  <?php echo $time;?> </span><br><br>
<?php
 $header=mysql_query("SELECT b.ftNamaKelompok AS ftkelompok,a.fdTrans_date FROM txpinjaman_mikro_nasabah_hdr a LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening WHERE a.fnStatus <> 9 AND a.fdTrans_date between '$startDate' AND '$endDate' GROUP BY ftkelompok ");
              //while($w=mysql_fetch_array($header)){
                $ketemu=mysql_num_rows($header);
               while($w=mysql_fetch_array($header)){
            $d=$w[ftkelompok];
            $e=$w[fdTrans_date];
$temp ="<center><b>LAPORAN PENYALURAN KREDIT MIKRO<br>TANGGAL : $e<br>KELOMPOK :$d";
$temp .="</b></center>
            <table  id='table' class='table table-bordered table-striped' border=1 width=100%>
            <thead>
            <tr class='info'>
                <th rowspan='2'><div align='center'>NO</div></th>
                <th rowspan='2'><div align='center'>TGL TRANS </div></th>
                <th rowspan='2'><div align='center'>NOREK</div></th>
                <th rowspan='2'><div align='center'>NAMA</div></th>
                <th rowspan='2'><div align='center'>JW</div></th>
                <th><div align='center'>NOMINAL</div></th>
                <th><div align='center'>ANGS</div></th>
                <th><div align='center'>TAB</div></th>
                <th><div align='center'>TOTAL</div></th>
                <th colspan='4'><div align='center'>POTONGAN</div></th>
                <th><div align='center'>TOTAL</div></th>
                <th><div align='center'>TERIMA</div></th>
              </tr>
              <tr class='info'>
                <th><div align='center'>PINJAMAN</div></th>
                <th><div align='center'></div></th>
                <th><div align='center'></div></th>
                <th><div align='center'>ANGS</div></th>
                <th><div align='center'>ADM</div></th>
                <th><div align='center'>MAT</div></th>
                <th><div align='center'>PBLT</div></th>
                <th><div align='center'>TAB</div></th>
                <th><div align='center'>POT</div></th>
                <th><div align='center'>BERSIH</div></th>
              </tr>
                <thead>
                <tbody>";
	
	
		$tampil=mysql_query("SELECT a.ftCustomer_Code , a.fdTrans_date, b.ftNamaNasabah, b.ftSubCabang AS ftwilayah, b.ftNamaKelompok AS ftkelompok,
    a.fnJW, FORMAT(a.fcPlafond,0) AS fcPlafond, FORMAT(a.fcPokokAngsuran + a.fcBunganAngsuran + a.fcAdmAngsuran + a.fcPbltAngsuran,0) AS fcAngsuran,
    FORMAT(a.fcTabAngsuran,0) AS fcTabAngsuran, FORMAT(a.fcTotalAngsuran,0) AS fcTotalAngsuran, FORMAT(a.fcAdm,0) AS fcAdm, FORMAT(a.fcSimpanan,0) AS fcSimpanan, FORMAT(a.fcMaterai,0) AS fcMaterai, FORMAT(a.fcPblt,0) AS fcPblt,
    FORMAT(a.fcAdm + a.fcSimpanan+ a.fcMaterai+ a.fcPblt,0) AS fcTotalPotongan,
    FORMAT(a.fcTerimaBersih,0) AS fcTerimaBersih  
    FROM txpinjaman_mikro_nasabah_hdr a
    LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening
    WHERE a.fnStatus <> 9 AND b.ftNamaKelompok='$d' AND a.fdTrans_date between '$startDate' AND '$endDate'
            UNION ALL
            SELECT  '' ,
                    '' ,
                    '' ,
                    '' ,
                    '' ,
                '<b>GRAND TOTAL -></b>' AS fnJW,
                    FORMAT(SUM(a.fcPlafond),0) AS fcPlafond,
                    FORMAT(SUM(a.fcPokokAngsuran + a.fcBunganAngsuran + a.fcAdmAngsuran + a.fcPbltAngsuran),0) AS fcAngsuran,
                    FORMAT(SUM(a.fcTabAngsuran),0) AS fcTabAngsuran,
                    FORMAT(SUM(a.fcTotalAngsuran),0) AS fcTotalAngsuran,
                    FORMAT(SUM(a.fcAdm),0) AS fcAdm,
                    FORMAT(SUM(a.fcSimpanan),0) AS fcSimpanan,
                    FORMAT(SUM(a.fcMaterai),0) AS fcMaterai,
                    FORMAT(SUM(a.fcPblt),0) AS fcPblt,
                    FORMAT(SUM(a.fcAdm + a.fcSimpanan+ a.fcMaterai+ a.fcPblt),0) AS fcTotalPotongan,
                    FORMAT(SUM(a.fcTerimaBersih),0) AS fcTerimaBersih
                    
            FROM txpinjaman_mikro_nasabah_hdr a
                LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening
                WHERE a.fnStatus <> 9 AND b.ftNamaKelompok='$d' AND a.fdTrans_date between '$startDate' AND '$endDate'");
	
$no1 = 0;

while($r = mysql_fetch_array($tampil)){
		$no1++;	
$temp .="   <tr>
		    <td>$no1</td>
		    <td>$r[fdTrans_date]</td>
		    <td>$r[ftCustomer_Code]</td>
		    <td>$r[ftNamaNasabah]</td>
		    <td>$r[fnJW]</td>
		    <td>$r[fcPlafond]</td>
		    <td>$r[fcAngsuran]</td>
		    <td>$r[fcPlafond]</td>
		    <td>$r[fcTotalAngsuran]</td>
		    <td>$r[fcAdm]</td>
		    <td>$r[fcMaterai]</td>
		    <td>$r[fcPblt]</td>
		    <td>$r[fcTabAngsuran]</td>
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
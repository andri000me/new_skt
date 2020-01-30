<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
$allDate = $_GET['allDate'];
$kelompok = $_GET['kel'];
$startDate = substr($allDate,0,10);
$endDate = substr($allDate,-10);
/*var_dump($allDate);
var_dump($startDate);
var_dump($endDate);exit;*/

?>
 <style type="text/css">

 </style>
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
                <th colspan='5'><div align='center'>POTONGAN</div></th>
                <th><div align='center'>TOTAL</div></th>
                <th><div align='center'>TERIMA</div></th>
              </tr>
              <tr class='info'>
                <th><div align='center'>PINJAMAN</div></th>
                <th><div align='center'></div></th>
                <th><div align='center'></div></th>
                <th><div align='center'>ANGS</div></th>
                <th><div align='center'>ADM</div></th>
                <th><div align='center'>ASURANSI</div></th>
                <th><div align='center'>MAT</div></th>
                <th><div align='center'>PBLT</div></th>
                <th><div align='center'>TAB</div></th>
                <th><div align='center'>POT</div></th>
                <th><div align='center'>BERSIH</div></th>
              </tr>
                <thead>
                <tbody>";



//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
    $tampil=mysql_query("SELECT a.ftCustomer_Code , a.fdTrans_date, b.ftNamaNasabah, b.ftSubCabang AS ftwilayah, b.ftNamaKelompok AS ftkelompok,
    a.fnJW, FORMAT(a.fcPlafond,0) AS fcPlafond, FORMAT(a.fcPokokAngsuran + a.fcBunganAngsuran + a.fcAdmAngsuran + a.fcPbltAngsuran,0) AS fcAngsuran,
    FORMAT(a.fcTabAngsuran,0) AS fcTabAngsuran, FORMAT(a.fcTotalAngsuran,0) AS fcTotalAngsuran, FORMAT(a.fcAdm,0) AS fcAdm, FORMAT(a.fcAsuransi,0) AS fcAsuransi, FORMAT(a.fcSimpanan,0) AS fcSimpanan, FORMAT(a.fcMaterai,0) AS fcMaterai, FORMAT(a.fcPblt,0) AS fcPblt,
    FORMAT(a.fcAdm + a.fcAsuransi + a.fcSimpanan+ a.fcMaterai+ a.fcPblt,0) AS fcTotalPotongan,
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
                    FORMAT(SUM(a.fcAsuransi),0) AS fcAsuransi,
                    FORMAT(SUM(a.fcSimpanan),0) AS fcSimpanan,
                    FORMAT(SUM(a.fcMaterai),0) AS fcMaterai,
                    FORMAT(SUM(a.fcPblt),0) AS fcPblt,
                    FORMAT(SUM(a.fcAdm + a.fcAsuransi + a.fcSimpanan+ a.fcMaterai+ a.fcPblt),0) AS fcTotalPotongan,
                    FORMAT(SUM(a.fcTerimaBersih),0) AS fcTerimaBersih
                    
            FROM txpinjaman_mikro_nasabah_hdr a
                LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening
                WHERE a.fnStatus <> 9 AND b.ftNamaKelompok='$d' AND a.fdTrans_date between '$startDate' AND '$endDate'
    ");
	$no1 = 0;
	while($r=mysql_fetch_array($tampil)){
		/*$fnJW=format_rupiah($r['fnJW']);
		$fcPlafond=format_rupiah($r['fcPlafond']);
		$fcAngsuran=format_rupiah($r['fcAngsuran']);
		$fcTabAngsuran=format_rupiah($r['fcTabAngsuran']);
		$fcTotalAngsuran=format_rupiah($r['fcTotalAngsuran']);
		$fcAdm=format_rupiah($r['fcAdm']);
		$fcSimpanan=format_rupiah($r['fcSimpanan']);
		$fcMaterai=format_rupiah($r['fcMaterai']);
		$fcPblt=format_rupiah($r['fcPblt']);
		$fcTotalPotongan=format_rupiah($r['fcTotalPotongan']);
		$fcTerimaBersih=format_rupiah($r['fcTerimaBersih']);*/
		
		
				 $no1++;	
				
				
 $temp .="   <tr>
        <td>$no1</td>
        <td>$r[fdTrans_date]</td>
        <td>$r[ftCustomer_Code]</td>
        <td>$r[ftNamaNasabah]</td>
        <td>$r[fnJW]</td>
        <td>$r[fcPlafond]</td>
        <td>$r[fcAngsuran]</td>
        <td>$r[fcTabAngsuran]</td>
        <td>$r[fcTotalAngsuran]</td>
        <td>$r[fcAdm]</td>
        <td>$r[fcAsuransi]</td>
        <td>$r[fcMaterai]</td>
        <td>$r[fcPblt]</td>
        <td>$r[fcTabAngsuran]</td>
        <td>$r[fcTotalPotongan]</td>
        <td>$r[fcTerimaBersih]</td>
   </tr>";

    /*$total_nominal_pinjaman += $r['fcPlafond'];
    $total_fcAngsuran += $r['fcAngsuran'];
    $total_tabungan += $r['fcPlafond'];
    $total_fcTotalAngsuran += $r['fcTotalAngsuran'];
    $total_fcAdm += $r['fcAdm'];
    $total_fcMaterai += $r['fcMaterai'];
    $total_fcPblt += $r['fcPblt'];
    $total_fcTabAngsuran += $r['fcTabAngsuran'];
    $total_fcTotalPotongan += $r['fcTotalPotongan'];
    $total_fcTerimaBersih += $r['fcTerimaBersih'];*/
	}
    /*$total_nominal_pinjaman=format_rupiah($total_nominal_pinjaman);
    $total_fcAngsuran=format_rupiah($total_fcAngsuran);
    $total_tabungan=format_rupiah($total_tabungan);
    $total_fcTotalAngsuran=format_rupiah($total_fcTotalAngsuran);
    $total_fcAdm=format_rupiah($total_fcAdm);
    $total_fcMaterai=format_rupiah($total_fcMaterai);
    $total_fcPblt=format_rupiah($total_fcPblt);
    $total_fcTabAngsuran=format_rupiah($total_fcTabAngsuran);
    $total_fcTotalPotongan=format_rupiah($total_fcTotalPotongan);
    $total_fcTerimaBersih=format_rupiah($total_fcTerimaBersih);*/

$temp .="</tbody>
    
	</table>";




echo $temp;
}
    ?>
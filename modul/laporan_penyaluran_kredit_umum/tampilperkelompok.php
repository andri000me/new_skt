<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";

$ALLDate = $_GET['ALLDate'];
$startDate = substr($ALLDate,0,10);
$endDate = substr($ALLDate,18,10);
$kelompok = substr($ALLDate,28);
/*var_dump($ALLDate);
var_dump($startDate);
var_dump($endDate);
var_dump($kelompok);exit;*/

?>
 <style type="text/css">

 </style>
 <?php
if($kelompok !="all"){
    $header=mysql_query("SELECT b.ftKantorBayar AS ftKantorBayar,a.fdTrans_date FROM txpinjaman_umum_hdr a LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening WHERE a.fnStatus <> 9 AND  b.ftKantorBayar='$kelompok' AND a.fdTrans_date between '$startDate' AND '$endDate' GROUP BY ftKantorBayar ");
            $w=mysql_fetch_array($header);
            $e=$w[fdTrans_date];
  $temp2 ="<center><b>LAPORAN PENYALURAN KREDIT UMUM<br>TANGGAL : $e<br>Kantor Bayar :$kelompok";
   
  $temp2 .="</b></center><table  id='table' class='table table-bordered table-striped' border=1 width=100%>
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



//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
    $tampil=mysql_query("SELECT a.fdTrans_date, a.ftCustomer_Code,  b.ftNamaNasabah, b.ftkantorbayar AS ftPerusahaan, 0 AS fnUsia, a.fnJw,
CURDATE() AS fdTgl_gaji, a.ftTrans_No AS ftNoPinjaman,  
a.fcPlafond AS fcPlafond,
a.fcPokokAngsuran + a.fcBunganAngsuran + a.fcAdmAngsuran + a.fcPbltAngsuran AS fcAngsuran, 
a.fcTabAngsuran AS fcTabAngsuran,
a.fcTotalAngsuran AS fcTotalAngsuran, 
a.fcAdm AS fcAdm, 
a.fcProvisi AS fcProvisi, 
a.fcAsuransi AS fcAsuransi, 
a.fcPpap AS fcPPAP, 
a.fcMaterai AS fcMaterai, 
a.fcPblt AS fcPblt, 
a.fcSimpanan AS fcSimpanan, 
a.fcRRP AS fcRRP,
IFNULL(c.fcPokokAngsuran,0) AS fcPokokPelunasan, 
IFNULL(c.fcBunganAngsuran,0) AS fcBungaPelunasan, 
IFNULL(c.fcAdmAngsuran,0) AS fcAdmPelunasan , 
IFNULL(c.fcPbltAngsuran,0) AS fcPbltPelunasan,
IFNULL(c.fcTabAngsuran,0) AS fcTabPelunasan,
a.fcAdm + a.fcProvisi + a.fcAsuransi + a.fcRRP  + a.fcPPAP + a.fcMaterai + a.fcPblt + a.fcSimpanan + 0 AS fcTotalPotongan,
a.fcTerimaBersih AS fcTerimaBersih
FROM txpinjaman_umum_hdr a
LEFT JOIN TLnasabah b ON a.ftCustomer_Code = b.ftNoRekening
LEFT JOIN txangsuran_umum_hdr c ON c.ftLoan_No = a.ftTrans_No
WHERE a.fnStatus <> 9 AND LEFT(a.ftTrans_No,3) = 'PJU' AND b.ftkantorbayar='$kelompok' AND a.fdTrans_date between '$startDate' AND '$endDate' 
                ");
    $no1 = 0;
    while($r=mysql_fetch_array($tampil)){
        $NOMINAL=format_rupiah($r['fcPlafond']);
        $ANGS=format_rupiah($r['fcAngsuran']);
        $TAB=format_rupiah($r['fcTabAngsuran']);
        $TOTAL_ANGS=format_rupiah($r['fcTotalAngsuran']);
        $ADM_POT=format_rupiah($r['fcAdm']);
        $PROVISI=format_rupiah($r['fcProvisi']);
        $ASS=format_rupiah($r['fcAsuransi']);
        $PPAP=format_rupiah($r['fcPPAP']);
        $MAT=format_rupiah($r['fcMaterai']);
        $PBLT=format_rupiah($r['fcPblt']);
        $TAB_POT=format_rupiah($r['fcSimpanan']);
        $RRP=format_rupiah($r['fcRRP']);
        $POKOK=format_rupiah($r['fcPokokPelunasan']);
        $BUNGA=format_rupiah($r['fcBungaPelunasan']);
        $ADM_PEL=format_rupiah($r['fcAdmPelunasan']);
        $TAB_PEL=format_rupiah($r['fcTabPelunasan']);
        $PNOL=format_rupiah($r['fcPbltPelunasan']);
        $POT=format_rupiah($r['fcTotalPotongan']);
        $BERSIH=format_rupiah($r['fcTerimaBersih']);
        
        
                 $no1++;    
                
                
 $temp2 .="   <tr>
        <td>$no1</td>
        <td >$r[fdTrans_date]</td>
        <td>$r[ftCustomer_Code]</td>
        <td>$r[ftNamaNasabah]</td>
        <td>$r[ftPerusahaan]</td>
        <td>$r[fnUsia]</td>
        <td>$r[fnJw]</td>
        <td>$r[fdTgl_gaji]</td>
        <td>$NOMINAL</td>
        <td>$ANGS</td>
        <td>$TAB</td>
        <td>$TOTAL_ANGS</td>
        <td>$ASDM_POT</td>
        <td>$PROVISI</td>
        <td>$ASS</td>
        <td>$PPAP</td>
        <td>$MAT</td>
        <td>$PBLT</td>
        <td>$TAB_POT</td>
        <td>$RRP</td>
        <td>$POKOK</td>
        <td>$BUNGA</td>
        <td>$ADM_PEL</td>
        <td>$TAB_PEL</td>
        <td>$PNOL</td>
        <td>$POT</td>
        <td>$BERSIH</td>
    </tr>";
        $NOMINAL=format_rupiah($r['fcPlafond']);
        $ANGS=format_rupiah($r['fcAngsuran']);
        $TAB=format_rupiah($r['fcTabAngsuran']);
        $TOTAL_ANGS=format_rupiah($r['fcTotalAngsuran']);
        $ADM_POT=format_rupiah($r['fcAdm']);
        $PROVISI=format_rupiah($r['fcProvisi']);
        $ASS=format_rupiah($r['fcAsuransi']);
        $PPAP=format_rupiah($r['fcPPAP']);
        $MAT=format_rupiah($r['fcMaterai']);
        $PBLT=format_rupiah($r['fcPblt']);
        $TAB_POT=format_rupiah($r['fcSimpanan']);
        $RRP=format_rupiah($r['fcRRP']);
        $POKOK=format_rupiah($r['fcPokokPelunasan']);
        $BUNGA=format_rupiah($r['fcBungaPelunasan']);
        $ADM_PEL=format_rupiah($r['fcAdmPelunasan']);
        $TAB_PEL=format_rupiah($r['fcSimpanan']);
        $PNOL=format_rupiah($r['fcPbltPelunasan']);
        $POT=format_rupiah($r['fcTotalPotongan']);
        $BERSIH=format_rupiah($r['fcTerimaBersih']);

    $total_fcPlafond += $r['fcPlafond'];
    $total_fcAngsuran += $r['fcAngsuran'];
    $total_fcTabAngsuran += $r['fcTabAngsuran'];
    $total_fcTotalAngsuran += $r['fcTotalAngsuran'];
    $total_fcAdm += $r['fcAdm'];
    $total_fcProvisi += $r['fcProvisi'];
    $total_fcAsuransi += $r['fcAsuransi'];
    $total_fcPPAP += $r['fcPPAP'];
    $total_fcMaterai += $r['fcMaterai'];
    $total_fcPblt += $r['fcPblt'];
    $total_fcSimpanan += $r['fcSimpanan'];
    $total_fcRRP += $r['fcRRP'];
    $total_fcPokokPelunasan += $r['fcPokokPelunasan'];
    $total_fcBungaPelunasan += $r['fcBungaPelunasan'];
    $total_fcAdmPelunasan += $r['fcAdmPelunasan'];
    $total_fcSimpanan += $r['fcSimpanan'];
    $total_fcPbltPelunasan += $r['fcPbltPelunasan'];
    $total_fcTotalPotongan += $r['fcTotalPotongan'];
    $total_fcTerimaBersih += $r['fcTerimaBersih'];
    }
    $total_fcPlafond=format_rupiah($total_fcPlafond);
    $total_fcAngsuran=format_rupiah($total_fcAngsuran);
    $total_fcTabAngsuran=format_rupiah($total_fcTabAngsuran);
    $total_fcTotalAngsuran=format_rupiah($total_fcTotalAngsuran);
    $total_fcAdm=format_rupiah($total_fcAdm);
    $total_fcProvisi=format_rupiah($total_fcProvisi);
    $total_fcAsuransi=format_rupiah($total_fcAsuransi);
    $total_fcPPAP=format_rupiah($total_fcPPAP);
    $total_fcMaterai=format_rupiah($total_fcMaterai);
    $total_fcPblt=format_rupiah($total_fcPblt);
    $total_fcSimpanan=format_rupiah($total_fcSimpanan);
    $total_fcRRP=format_rupiah($total_fcRRP);
    $total_fcPokokPelunasan=format_rupiah($total_fcPokokPelunasan);
    $total_fcBungaPelunasan=format_rupiah($total_fcBungaPelunasan);
    $total_fcAdmPelunasan=format_rupiah($total_fcAdmPelunasan);
    $total_fcSimpanan=format_rupiah($total_fcSimpanan);
    $total_fcPbltPelunasan=format_rupiah($total_fcPbltPelunasan);
    $total_fcTotalPotongan=format_rupiah($total_fcTotalPotongan);
    $total_fcTerimaBersih=format_rupiah($total_fcTerimaBersih);

$temp2 .="</tbody>
    <tfoot><tr>
        
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>GRAND TOTAL -></th>
        <th>$total_fcPlafond</th>
        <th>$total_fcAngsuran</th>
        <th>$total_fcTabAngsuran</th>
        <th>$total_fcTotalAngsuran</th>
        <th>$total_fcAdm</th>
        <th>$total_fcProvisi</th>
        <th>$total_fcAsuransi</th>
        <th>$total_fcPPAP</th>
        <th>$total_fcMaterai</th>
        <th>$total_fcPblt</th>
        <th>$total_fcSimpanan</th>
        <th>$total_fcRRP</th>
        <th>$total_fcPokokPelunasan</th>
        <th>$total_fcBungaPelunasan</th>
        <th>$total_fcAdmPelunasan</th>
        <th>$total_fcSimpanan</th>
        <th>$total_fcPbltPelunasan</th>
        <th>$total_fcTotalPotongan</th>
        <th>$total_fcTerimaBersih</th>
   </tr>
   </tfoot>
    </table>";
       
echo $temp2;
  } else{
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



//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
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
FORMAT(IFNULL(c.fcTabAngsuran,0),0) AS fcTabPelunasan,
FORMAT(a.fcAdm + a.fcProvisi + a.fcAsuransi + a.fcRRP + a.fcPPAP + a.fcMaterai + a.fcPblt + a.fcSimpanan + 0,0) AS fcTotalPotongan,
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
        FORMAT(SUM(c.fcTabAngsuran),0) AS fcTabPelunasan,
        FORMAT(SUM(a.fcAdm + a.fcProvisi + a.fcAsuransi + a.fcRRP + a.fcPPAP + a.fcMaterai + a.fcPblt + a.fcSimpanan + 0),0) AS fcTotalPotongan,
        FORMAT(SUM(a.fcTerimaBersih),0) AS fcTerimaBersih
FROM txpinjaman_umum_hdr a
LEFT JOIN TLnasabah b ON a.ftCustomer_Code = b.ftNoRekening
LEFT JOIN txangsuran_umum_hdr c ON c.ftLoan_No = a.ftTrans_No
WHERE a.fnStatus <> 9 AND LEFT(a.ftTrans_No,3) = 'PJU' AND b.ftkantorbayar='$d' AND a.fdTrans_date between '$startDate' AND '$endDate'
                ");
    $no1 = 0;
//   echo $tampil;exit;
    while($r=mysql_fetch_array($tampil)){
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

   /* $total_nominal_pinjaman += $r['fcPlafond'];
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
   /* $total_nominal_pinjaman=format_rupiah($total_nominal_pinjaman);
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
  }     
    ?>
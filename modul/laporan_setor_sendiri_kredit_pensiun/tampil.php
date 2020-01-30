<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
$allDate = $_GET['allDate'];

$startDate = substr($allDate,0,10);
$endDate = substr($allDate,-10);


?>
 <style type="text/css">

 </style>
<center ><b>KOPERASI MARTABE JAYA<br>DAFTAR SETORAN ANGSURAN KREDIT PENSIUN<br>BULAN : <?php echo "$startDate sampai $endDate" ?><br>KANTOR BAYAR : PT.DONGSUNG  </b></center>
<table  id="table" class="table table-bordered table-striped" border=1 width=100%>
<thead>
<tr class="success">
<th rowspan="2"><center>NO<center></center></center></th>
<th rowspan="2" width="90"><center>NOREK<center></center></center></th>
<th rowspan="2" width="200"><center>TGL PL<center></center></center></th>
<th rowspan="2" width="200"><center>NAMA<center></center></center></th>
<th rowspan="2" width="50"><center>KE<center></center></center></th>
<th rowspan="2" width="50"><center>JW<center></center></center></th>
<th><center>SB<center></center></center></th>
<th rowspan="2" width="50"><center>PLAFOND<center></center></center></th>
<th colspan="5"><center>SETORAN ANGSURAN</center></th>
<th rowspan="2" width="90"><center>TOTAL<center></center></center></th>
</tr>
<tr class="success">
<th><center>%<center></center></center></th>
<th><center>POKOK<center></center></center></th>
<th><center>BUNGA<center></center></center></th>
<th><center>TAB<center></center></center></th>
<th><center>ADM<center></center></center></th>
<th><center>P.NOL<center></center></center></th>
</tr>
</thead>
	<tbody>
<?php	
//$tampil=mysql_query("SELECT * FROM txpinjaman_pensiun_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
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
		$TAB_PEL=format_rupiah($r['fcSimpanan']);
		$PNOL=format_rupiah($r['fcPbltPelunasan']);
		$POT=format_rupiah($r['fcTotalPotongan']);
		$BERSIH=format_rupiah($r['fcTerimaBersih']);
		$no1++;	
	echo"
    <tr>
        <td>$no1</td>
        <td >$r[fdTrans_date]</td>
        <td>$r[ftCustomer_Code]</td>
        <td>$r[ftNamaNasabah]</td>
        <td>$r[ftPerusahaan]</td>
        <td>$r[fnUsia]</td>
        <td>$r[fnJw]</td>
        <td>$r[fdTgl_gaji]</td>
      
        <td>$BUNGA</td>
        <td>$ADM_PEL</td>
        <td>$TAB_PEL</td>
        <td>$PNOL</td>
        <td>$POT</td>
        <td>$BERSIH</td>
    </tr>";
	}
$q_jabatan=mysql_query("SELECT * FROM  tljabatan ");
$jabatan=mysql_fetch_array($q_jabatan);
?>
</tbody>
</table>
	
<table class="table table-bordered table-striped" width=100%>
	<tr>
		<th><b><center></center></b></th>
        <th><span class="pull-left"><center>Diketahui Oleh</center></br><center>Pemimpin</center></br></br></br></br> <center><?php echo $jabatan['ftNamaDirektur'];?> </center></span></th>
        <th colspan="23">
               </th>
        <th><span class="pull-right"><center>Bekasi,<?php echo $tgl_sekarang;?></center></br><center>Dibuat Oleh</center></br><center>Adm Kredit</center></br></br></br></br><center><?php echo $jabatan['ftNamaAdmKredit'];?></center></span></th>
        <th><b><center></center></b></th>
	</tr>
</table>	
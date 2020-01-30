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
<center ><b>LAPORAN DAFTAR TAGIHAN MIKRO <?php echo "$startDate sampai $endDate" ?> </b></center>
<table  id="table" class="table table-bordered table-striped" border=1 width=100%>

	
<thead>
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
	<thead>
	<tbody>
<?php	
//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
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
        <td>$NOMINAL</td>
        <td>$ANGS</td>
        <td>$TAB</td>
        <td>$TOTAL_ANGS</td>
        <td>$ADM_POT</td>
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
	}


?>
</tbody>
	</table>
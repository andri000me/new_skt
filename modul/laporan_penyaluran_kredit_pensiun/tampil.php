<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
$allDate = $_GET['allDate'];
$tgl_sekarang = date("d-M-Y");
$startDate = substr($allDate,0,10);
$endDate = substr($allDate,-10);


?>
 <style>

</style>
<center ><b>LAPORAN PENYALURAN KREDIT <?php echo "$startDate sampai $endDate" ?> </b></center>
<table  id="table" class="table table-bordered table-striped" style="width:100%;border: 1px solid black;border-collapse: collapse;">

	
<thead>
<tr class="success">
        <th rowspan="2"  style="border: 1px solid black;"><b><center>NO</center></b></th>
        <th rowspan="2" style="border: 1px solid black;"><b><center>TGL. TRANS</center></b></th>
        <th rowspan="2" width="90" style="border: 1px solid black;"><b><center>NOREK</center></b></th>
        <th rowspan="2" width="200" style="border: 1px solid black;"><b><center>NAMA</center></b></th>
        <th rowspan="2" width="200" style="border: 1px solid black;"><b><center>PERUSAHAAN</center></b></th>
        <th rowspan="2" width="50" style="border: 1px solid black;"><b><center>USIA</center></b></th>
        <th rowspan="2" width="50" style="border: 1px solid black;"><b><center>JW</center></b></th>
        <th style="border: 1px solid black;"><b><center>TGL</center></b></th>
        <th style="border: 1px solid black;"><b><center>NOMINAL</center></b></th>
        <th style="border: 1px solid black;"><b><center>ANGS</center></b></th>
        <th style="border: 1px solid black;"><b><center>TAB</center></b></th>
        <th style="border: 1px solid black;"><b><center>TOTAL</th>
        <th colspan="7" style="border: 1px solid black;"><b><center>POTONGAN</center></center></b></th>
        <th style="border: 1px solid black;"></th>
        <th style="border: 1px solid black;" colspan="5"><b><center>PELUNASAN</center></b></th>
        <th style="border: 1px solid black;"><b><center>TOTAL</center></b></th>
        <th style="border: 1px solid black;"><b><center>TERIMA</center></b></th>
    </tr>
    <tr class="success">
        <th style="border: 1px solid black;"><b><center>GAJI</center></b></th>
        <th style="border: 1px solid black;"><b><center>PINJAMAN</center></b></th>
        <th style="border: 1px solid black;"></th>
        <th style="border: 1px solid black;"></th>
        <th style="border: 1px solid black;"><b><center>ANGS</center></b></th>
        <th style="border: 1px solid black;"><b><center>ADM</center></b></th>
        <th style="border: 1px solid black;"><b><center>PROVISI</center></b></th>
        <th style="border: 1px solid black;"><b><center>ASS</center></b></th>
        <th style="border: 1px solid black;"><b><center>PPAP</center></b></th>
        <th style="border: 1px solid black;"><b><center>MAT</center></b></th>
        <th style="border: 1px solid black;"><b><center>PBLT</center></b></th>
        <th style="border: 1px solid black;"><b><center>TAB</center></b></th>
        <th style="border: 1px solid black;"><b><center>RRP</center></b></th>
        <th style="border: 1px solid black;"><b><center>POKOK</center></b></th>
        <th style="border: 1px solid black;"><b><center>BUNGA</center></b></th>
        <th style="border: 1px solid black;"><b><center>ADM</center></b></th>
        <th style="border: 1px solid black;"><b><center>TAB</center></b></th>
        <th style="border: 1px solid black;"><b><center>PNOL</center></b></th>
        <th style="border: 1px solid black;"><b><center>POT</center></b></th>
        <th style="border: 1px solid black;"><b><center>BERSIH</center></b></th>
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
        <td style='border: 1px solid black;'>$no1</td>
        <td style='border: 1px solid black;' >$r[fdTrans_date]</td>
        <td style='border: 1px solid black;'>$r[ftCustomer_Code]</td>
        <td style='border: 1px solid black;'>$r[ftNamaNasabah]</td>
        <td style='border: 1px solid black;'>$r[ftPerusahaan]</td>
        <td style='border: 1px solid black;'>$r[fnUsia]</td>
        <td style='border: 1px solid black;'>$r[fnJw]</td>
        <td style='border: 1px solid black;'>$r[fdTgl_gaji]</td>
        <td style='border: 1px solid black;'>$NOMINAL</td>
        <td style='border: 1px solid black;'>$ANGS</td>
        <td style='border: 1px solid black;'>$TAB</td>
        <td style='border: 1px solid black;'>$TOTAL_ANGS</td>
        <td style='border: 1px solid black;'>$ADM_POT</td>
        <td style='border: 1px solid black;'>$PROVISI</td>
        <td style='border: 1px solid black;'>$ASS</td>
        <td style='border: 1px solid black;'>$PPAP</td>
        <td style='border: 1px solid black;'>$MAT</td>
        <td style='border: 1px solid black;'>$PBLT</td>
        <td style='border: 1px solid black;'>$TAB_POT</td>
        <td style='border: 1px solid black;'>$RRP</td>
        <td style='border: 1px solid black;'>$POKOK</td>
        <td style='border: 1px solid black;'>$BUNGA</td>
        <td style='border: 1px solid black;'>$ADM_PEL</td>
        <td style='border: 1px solid black;'>$TAB_PEL</td>
        <td style='border: 1px solid black;'>$PNOL</td>
        <td style='border: 1px solid black;'>$POT</td>
        <td style='border: 1px solid black;'>$BERSIH</td>
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
<?php 
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
$allDate = $_GET['allDate'];
$startDate = substr($allDate,0,10);
$kelompok = substr($allDate,18);

?>
 <style type="text/css">

 </style>
<center ><b>DAFTAR NOMINATIF </b><br>KELOMPOK  <?php echo "$kelompok" ?></center>
<table  id="table" class="table table-bordered table-striped" border=1 width=100%>

	
<thead>
<tr class="info">
    <th colspan="2"><div align="center">NOMOR</div></th>
    <th width="8%"><div align="center">TANGGAL</div></th>
    <th width="9%" rowspan="2"><div align="center">NAMA</div></th>
    <th width="8%" rowspan="2"><div align="center">JW</div></th>
    <th width="6%" rowspan="2"><div align="center">SB</div></th>
    <th width="10%" rowspan="2"><div align="center">PLAFOND</div></th>
    <th width="13%"><div align="center">SALDO</div></th>
    <th width="3%" rowspan="2"><div align="center">PENYALURAN</div></th>
    <th width="3%" rowspan="2"><div align="center">RETURN</div></th>
    <th colspan="2"><div align="center">POKOK</div></th>
    <th width="3%"><div align="center">SETOR</div></th>
    <th width="3%" rowspan="2"><div align="center">TAGIHAN</div></th>
    <th colspan="2"><div align="center">MUTASI MEMO</div></th>
    <th width="3%"><div align="center">SALDO</div></th>
  </tr>
 <tr class="info">
    <th width="10%"><div align="center">URT</div></th>
    <th width="9%"><div align="center">REKENING</div></th>
    <th><div align="center">TRANS</div></th>
    <th><div align="center">AWAL</div></th>
    <th width="3%"><div align="center">PEMBARUAN</div></th>
    <th width="3%"><div align="center">PENUTUPAN</div></th>
    <th><div align="center">SENDIRI</div></th>
    <th width="3%"><div align="center">DEBIT</div></th>
    <th width="3%"><div align="center">KREDIT</div></th>
    <th><div align="center">AKHIR</div></th>
  </tr>
  <thead>
	<tbody>
<?php	
//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
$tampil=mysql_query("SELECT a.ftNoRekening, a.ftNamaNasabah, a.ftSubCabang, a.ftNamaKelompok, c.fdTrans_date,c.fcPlafond,c.fnJW, c.ffBunga,
b.*
FROM tlnasabah a
LEFT JOIN ( 
        SELECT yy.ftCustomer_Code, SUM(yy.fcSaldoAwal) AS fcSaldoAwal, SUM(yy.fcPinjaman) AS fcPinjaman, SUM(yy.fcRetur) AS fcRetur, 
        SUM(yy.fcTagihan) AS fcTagihan,
        SUM(yy.fcPelunasan) AS fcPelunasan, SUM(yy.fcSetorSendiri) AS fcSetorSendiri ,
        SUM(yy.fcSaldoAwal)+SUM(yy.fcPinjaman)+SUM(yy.fcRetur) - (SUM(yy.fcTagihan)+SUM(yy.fcPelunasan)+SUM(yy.fcSetorSendiri)) AS fcSaldoAkhir
        FROM (
                SELECT xx.ftCustomer_Code, SUM(xx.fcSaldoAwal) AS fcSaldoAwal, 0 AS fcPinjaman, 0 AS fcRetur, 0 AS fcTagihan,
                0 AS fcPelunasan, 0 AS fcSetorSendiri
                FROM (
                        SELECT ftCustomer_Code, fcPlafond AS fcSaldoAwal
                        FROM txpinjaman_mikro_nasabah_hdr
                        WHERE fnstatus = 1 
                        AND fdTrans_date < '$startDate'
                        

                        UNION ALL

                        SELECT ftCustomer_Code, -fcPokokAngsuran
                        FROM txangsuran_mikro_hdr
                        WHERE fnstatus = 1 
                        AND fdTrans_date < '$startDate' 
                        

                        UNION ALL

                        SELECT b.ftCustomer_Code , -a.fcPokokAngsuran  
                        FROM txtagihan a
                        INNER JOIN txpinjaman_mikro_nasabah_hdr b ON a.fttrans_No = b.ftTrans_No
                        AND a.ftCustomer_Code = b.ftCustomer_Code
                        WHERE a.fnstatus = 1 
                        AND a.fdTrans_date < '$startDate'
                        

                ) xx
                GROUP BY xx.ftCustomer_Code

                UNION ALL

                SELECT xx.ftCustomer_Code, 0, SUM(xx.fcPinjaman) AS fcPinjaman, SUM(xx.fcRetur) AS fcRetur, SUM(xx.fcTagihan) AS fcTagihan,
                SUM(xx.fcPelunasan) AS fcPelunasan, SUM(xx.fcSetorSendiri) AS fcSetorSendiri
                FROM (
                        SELECT ftCustomer_Code, fcPlafond AS fcPinjaman, 0 AS fcRetur, 0 AS fcTagihan, 0 AS fcPelunasan , 0 AS fcSetorSendiri
                        FROM txpinjaman_mikro_nasabah_hdr
                        WHERE fnstatus = 1 
                        AND fdTrans_date = '$startDate' 
                        

                        UNION ALL

                        SELECT ftCustomer_Code, 0 AS fcPinjaman, 0 AS fcRetur, 0 AS fcTagihan, 0 AS fcPelunasan ,fcPokokAngsuran AS fcSetorSendiri
                        FROM txangsuran_mikro_hdr
                        WHERE fnstatus = 1 
                        AND fdTrans_date = '$startDate' 
                        

                        UNION ALL

                        SELECT b.ftCustomer_Code , 0 AS fcPinjaman, 0 AS fcRetur,a.fcPokokAngsuran  AS fcTagihan, 0 AS fcPelunasan ,0 AS fcSetorSendiri
                        FROM txtagihan a
                        INNER JOIN txpinjaman_mikro_nasabah_hdr b ON a.fttrans_No = b.ftTrans_No AND a.ftCustomer_Code = b.ftCustomer_Code              WHERE a.fnstatus = 1 
                        AND a.fdTrans_date = '$startDate' 
                        

                ) xx
                GROUP BY xx.ftCustomer_Code
        ) yy
        GROUP BY yy.ftCustomer_Code
    ) b ON a.ftNoRekening = b.ftCustomer_Code
LEFT JOIN (
        SELECT ftCustomer_Code, fdTrans_date, fnJW, ffBunga, fcPlafond
        FROM txpinjaman_mikro_nasabah_hdr WHERE fcOutstanding <> 0
        AND fnstatus <> 9

) c ON a.ftNoRekening =c.ftCustomer_Code

WHERE IFNULL(c.fcPlafond,0) <> 0 AND a.ftNamaKelompok='$kelompok' ORDER BY a.ftNoRekening ASC");
	$no1 = 0;
    $total_fcPlafond=0;
    $total_fcSaldoAwal=0;
    $total_fcTagihan=0;
    $total_fcSaldoAkhir=0;
    $total_penyaluran=0;
    $total_penutupan=0;
    $total_fcRetur=0;
    $total_fcSetorSendiri=0;
	while($r=mysql_fetch_array($tampil)){
		$fcPlafond=format_rupiah($r['fcPlafond']);
        $fcSaldoAwal=format_rupiah($r['fcSaldoAwal']);
        $fcSetorSendiri=format_rupiah($r['fcSetorSendiri']);
        $fcTagihan=format_rupiah($r['fcTagihan']);
        $fcRetur=format_rupiah($r['fcRetur']);
        $fcSaldoAkhir=format_rupiah($r['fcSaldoAkhir']);
        $penyaluran=format_rupiah($r['fcPinjaman']);
        $penutupan=format_rupiah($r['fcPelunasan']);
	 $no1++;	
echo"
    <tr>
        <td>$no1</td>
        <td>$r[ftCustomer_Code]</td>
        <td >$r[fdTrans_date]</td>
        <td>$r[ftNamaNasabah]</td>
        <td>$r[fnJW]</td>
        <td>$r[ffBunga]</td>
        <td>$fcPlafond</td>
        <td>$fcSaldoAwal</td>
        <td>$penyaluran</td>
        <td>$fcRetur</td>
        <td>$TAB</td>
        <td>$penutupan</td>
        <td>$fcSetorSendiri</td>
        <td>$fcTagihan</td>
        <td>$ASS</td>
        <td>$PPAP</td>
        <td>$fcSaldoAkhir</td>
        
    </tr>";
    $total_fcPlafond += $r['fcPlafond'];
    $total_fcSaldoAwal += $r['fcSaldoAwal'];
    $total_fcTagihan += $r['fcTagihan'];
    $total_fcSaldoAkhir += $r['fcSaldoAkhir'];
    $total_penyaluran += $r['fcPinjaman'];
    $total_penutupan += $r['fcPelunasan'];
    $total_fcRetur += $r['fcRetur'];
    $total_fcSetorSendiri += $r['fcSetorSendiri'];
	}
?>
</tbody>
<tfoot>
    <tr>
        <th>&nbsp;</th>
        <th>TOTAL KELOMPOK</th>
        <th >&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th><?php echo format_rupiah($total_fcPlafond); ?></th>
        <th><?php echo format_rupiah($total_fcSaldoAwal); ?></th>
        <th><?php echo format_rupiah($total_penyaluran); ?></th>
        <th><?php echo format_rupiah($total_fcRetur); ?></th>
        <th>&nbsp;</th>
        <th><?php echo format_rupiah($total_penutupan); ?></th>
        <th><?php echo format_rupiah($total_fcSetorSendiri); ?></th>
        <th><?php echo format_rupiah($total_fcTagihan); ?></th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th><?php echo format_rupiah($total_fcSaldoAkhir); ?></th>
        
    </tr>
</tfoot>
	</table>
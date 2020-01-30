<?php
$startDate=$_POST['kelompok_date'];
$kelompok=$_POST['ftNamaKelompok'];

session_start();
include "../config/config.php";

//include "../modul/laporan_penyaluran_kredit_pensiun/tampil.php";
//$fullname	= $_SESSION['fullname'];
$time=date("h:i:s a");
$time2=date('Y-m-d (H:i:s)');
$tanggal=date('d-F-Y');
$tanggal2=date('Y-m-d');

if(isset($_POST['kelompok_date']))
	{

header("Content-Type: application/msexcel");
header('Content-Disposition: attachment; filename="Export LAPORAN DAFTAR NOMINATIF MIKRO ' .$time2.'.xls"');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Export LAPORAN DAFTAR NOMINATIF MIKRO</title>
<style type="text/css"></style>
</head>
<body id="kelompok_date">
<span >Export LAPORAN DAFTAR NOMINATIF MIKRO</span><br>
<span >DATE  :  <?php echo $tanggal2;?> </span><br>
<span >TIME  :  <?php echo $time;?> </span><br><br>

<span ><center><b>LAPORAN DAFTAR NOMINATIF MIKRO <br>KELOMPOK <?php echo $kelompok;?></b></center></span ><br><br>


<table border="1"  width="100%" >
	<tr class="success">
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
 <tr class="success">
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
	<?php 
	include "../config/fungsi_rupiah.php";
		$tampil=mysql_query("SELECT a.ftNoRekening, a.ftNamaNasabah, a.ftSubCabang, a.ftNamaKelompok, c.fdTrans_date, c.fcPlafond, c.fnJW, c.ffBunga,
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

WHERE IFNULL(c.fcPlafond,0) <> 0 AND a.ftNamaKelompok='$kelompok' ORDER BY c.fdTrans_date ASC");
	
$no1 = 0;

while($r = mysql_fetch_array($tampil)){
		$fcPlafond=format_rupiah($r['fcPlafond']);
        $fcSaldoAwal=format_rupiah($r['fcSaldoAwal']);
        $fcSetorSendiri=format_rupiah($r['fcSetorSendiri']);
        $fcTagihan=format_rupiah($r['fcTagihan']);
        $fcRetur=format_rupiah($r['fcRetur']);
        $fcSaldoAkhir=format_rupiah($r['fcSaldoAkhir']);
		
		$no1++;	
	?>
	<tr>
		<td  ><?php echo $no1 ?></td>
        <td ><?php echo $r['ftCustomer_Code'];?></td>   
		<td ><?php echo $r['fdTrans_date'];?></td>   
		<td ><?php echo $r['ftNamaNasabah'];?></td>   
		<td ><?php echo $r['fnJW'];?></td>   
		<td ><?php echo $r['ffBunga'];?></td>   
		<td ><?php echo $fcPlafond;?></td>   
		<td ><?php echo $fcSaldoAwal;?></td>   
		<td ><?php echo $r['fdTgl_gaji'];?></td>   
		<td ><?php echo $fcRetur;?></td>   
		<td ><?php echo $TAB;?></td>   
		<td ><?php echo $TOTAL_ANGS;?></td>
        <td ><?php echo $fcSetorSendiri;?></td>
        <td ><?php echo $fcTagihan;?></td>
		<td ><?php echo $ASS;?></td>
		<td ><?php echo $PPAP;?></td>
		<td ><?php echo $fcSaldoAkhir;?></td>
       		
	</tr>
	<?php 
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
    <tr>
        <th colspan="6"><div align="center">TOTAL KELOMPOK</div></th>
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
</table>
</body>
</html>
<?php } ?> 
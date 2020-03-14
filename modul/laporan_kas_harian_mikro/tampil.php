<?php 
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_indotgl.php";
include "../../config/fungsi_rupiah.php";
include "../../config/fungsi_terbilang.php";
$allDate = $_GET['allDate'];
$tgl_sekarang=tgl_indo_true(date('Y m d'));
$Date = substr($allDate,0,10);
$wilayah = substr($allDate,18);
$thn=date('Y');
$tgl=tgl_indo_true($Date);
?>
 <style type="text/css">
 .style3 {
  font-size: 18px;
  font-weight: bold;
}
 </style>

<?php	   	
echo"
<div class='box box-info' >
      <div class='box-header'>
        <!-- tools box -->
        <div class='pull-right box-tools'>
          <button type='button' class='btn btn-info btn-sm' data-widget='remove' data-toggle='tooltip' title='Remove'>
            <i class='fa fa-times'></i></button>
        </div>
        <!-- /. tools -->
      </div>
      <div class='box-body' >
  <table width='100%' border='0'>
        <tr>
            <td colspan='5'><div align='center' class='style3'>LAPORAN KAS HARIAN MIKRO</div></td>
        </tr>
        <tr>
            <td colspan='5'><div align='center' class='style3'>KOPERASI MARTABE JAYA $wilayah</div></td>
        </tr>
        <tr>
            <td colspan='5'><div align='center' class='style3'>$tgl</div></td>
        </tr>
        <tr>
            <td colspan='5'><div align='center' class='style3'>&nbsp;</div></td>
        </tr>
        </table>
          <table width='100%' class='table table-bordered ' border=2>
            <thead>   
              <tr class='info'>
                  <td ><div align='center' class='style3'>No</div></td>
                  <td ><div align='center' class='style3'>BK</div></td>
                  <td ><div align='center' class='style3'>Uraian</div></td>
                  <td ><div align='center' class='style3'>fcDebet</div></td>
                  <td ><div align='center' class='style3'>fcKredit</div></td>
              </tr>
            </thead>
                <tbody>";
   $tampil=mysql_query("SELECT xx.*	,CASE xx.ftGroup WHEN '1' THEN 1
   WHEN '2' THEN 8
   WHEN '3' THEN 2  END jumlah	
   FROM (	
     SELECT '$wilayah' AS ftSubCabang, '' AS ftNamaKelompok, '<b>SALDO AWAL</b>' AS Description, FORMAT(100000,0) AS fcDebet, FORMAT(0,0) AS fcKredit, '1' AS ftGroup,'1' ftGroup2
       
     UNION ALL	
     
     SELECT b.`ftSubCabang`, b.`ftNamaKelompok`, 'Pokok Angsuran' AS Description, FORMAT(SUM(a.`fcPokokAngsuran`),0) AS  fcDebet, FORMAT(0,0) AS fcKredit, '2' AS ftGroup,'2' ftGroup2
     FROM txangsuran_mikro_hdr a
     INNER JOIN tlnasabah b ON a.`ftCustomer_Code` = b.`ftNoRekening`
     WHERE a.`fdTrans_date`='$Date'
     AND b.`ftSubCabang` ='$wilayah'
     GROUP BY b.`ftNamaKelompok`
     
     UNION ALL
     
     SELECT b.`ftSubCabang`, b.`ftNamaKelompok`, 'Bunga Angsuran' AS Description, FORMAT(SUM(a.`fcBunganAngsuran` ),0) AS  fcDebet , FORMAT(0,0) AS fcKredit, '2' AS ftGroup,'2' ftGroup2
     FROM txangsuran_mikro_hdr a
     INNER JOIN tlnasabah b ON a.`ftCustomer_Code` = b.`ftNoRekening`
     WHERE a.`fdTrans_date`='$Date'
     AND b.`ftSubCabang` ='$wilayah'
     GROUP BY b.`ftNamaKelompok`
     
     UNION ALL
     
     SELECT b.`ftSubCabang`, b.`ftNamaKelompok`, 'Adm Angsuran' AS Description, FORMAT(SUM(a.`fcAdmAngsuran` ),0) AS  fcDebet , FORMAT(0,0) AS fcKredit , '2' AS ftGroup,'2' ftGroup2
     FROM txangsuran_mikro_hdr a
     INNER JOIN tlnasabah b ON a.`ftCustomer_Code` = b.`ftNoRekening`
     WHERE a.`fdTrans_date`='$Date'
     AND b.`ftSubCabang` ='$wilayah'
     GROUP BY b.`ftNamaKelompok`
     
     UNION ALL
     
     SELECT b.`ftSubCabang`, b.`ftNamaKelompok`, 'Pblt Angsuran' AS Description, FORMAT(SUM(a.`fcPbltAngsuran` ),0) AS  fcDebet , FORMAT(0,0) AS fcKredit, '2' AS ftGroup,'2' ftGroup2
     FROM txangsuran_mikro_hdr a
     INNER JOIN tlnasabah b ON a.`ftCustomer_Code` = b.`ftNoRekening`
     WHERE a.`fdTrans_date`='$Date'
     AND b.`ftSubCabang` ='$wilayah'
     GROUP BY b.`ftNamaKelompok`
     
     UNION ALL
     
     SELECT b.`ftSubCabang`, b.`ftNamaKelompok`, 'Tabungan Angsuran' AS Description, FORMAT(SUM(a.`fcTabAngsuran` ),0) AS  fcDebet , FORMAT(0,0) AS fcKredit, '2' AS ftGroup,'2' ftGroup2
     FROM txangsuran_mikro_hdr a
     INNER JOIN tlnasabah b ON a.`ftCustomer_Code` = b.`ftNoRekening`
     WHERE a.`fdTrans_date`='$Date'
     AND b.`ftSubCabang` ='$wilayah'
     GROUP BY b.`ftNamaKelompok`
     
     UNION ALL
     
     SELECT b.`ftKodeWilayah`, b.`ftKodeKelompok`, 'Pencairan Pinjaman' AS Description, FORMAT(0,0) AS  fcDebet, FORMAT(SUM(b.fcPlafond),0) AS  fcKredit, '3' AS ftGroup,'2' ftGroup2
     FROM txpinjaman_mikro_hdr a
     LEFT JOIN txpinjaman_mikro_nasabah_hdr b ON a.`ftTrans_No`=b.`ftTrans_No` 
     AND a.ftKodeKelompok = b.ftKodeKelompok AND a.ftKodeWilayah = b.ftKodeWilayah
     WHERE a.fnStatus = 1 AND b.fnStatus = 1
     AND a.`fdTrans_date`='$Date'
     AND b.`ftKodeWilayah` ='$wilayah'
     GROUP BY b.`ftKodeWilayah`, b.`ftKodeKelompok`
     
     UNION ALL
     
     SELECT '' ftSubCabang, '' ftNamaKelompok, '<b>PENERIMAAN</b>' AS Description, '' fcDebet, '' fcKredit, '2' AS ftGroup,'1' ftGroup2 
     
     UNION ALL
     
     SELECT '' ftSubCabang, '' ftNamaKelompok, '<b>PENGELUARAN</b>' AS Description, '' fcDebet, '' fcKredit, '3' AS ftGroup,'1' ftGroup2
     
     UNION ALL
     
     SELECT b.`ftKodeWilayah`, b.`ftKodeKelompok`, 'Adm Pinjaman' AS Description,  FORMAT(SUM(b.fcAdm),0) AS  fcDebet, FORMAT(0,0) AS fcKredit,  '2' AS ftGroup,'2' ftGroup2
     FROM txpinjaman_mikro_hdr a
     LEFT JOIN txpinjaman_mikro_nasabah_hdr b ON a.`ftTrans_No`=b.`ftTrans_No` 
     AND a.ftKodeKelompok = b.ftKodeKelompok AND a.ftKodeWilayah = b.ftKodeWilayah
     WHERE a.fnStatus = 1 AND b.fnStatus = 1
     AND a.`fdTrans_date`='$Date'
     AND b.`ftKodeWilayah` ='$wilayah'
     GROUP BY b.`ftKodeWilayah`, b.`ftKodeKelompok`
     
     UNION ALL
     
     SELECT b.`ftKodeWilayah`, b.`ftKodeKelompok`, 'Asuransi Pinjaman' AS Description,  FORMAT(SUM(b.fcAsuransi),0) AS  fcDebet, FORMAT(0,0) AS fcKredit, '2' AS ftGroup,'2' ftGroup2
     FROM txpinjaman_mikro_hdr a
     LEFT JOIN txpinjaman_mikro_nasabah_hdr b ON a.`ftTrans_No`=b.`ftTrans_No` 
     AND a.ftKodeKelompok = b.ftKodeKelompok AND a.ftKodeWilayah = b.ftKodeWilayah
     WHERE a.fnStatus = 1 AND b.fnStatus = 1
     AND a.`fdTrans_date`='$Date'
     AND b.`ftKodeWilayah` ='$wilayah'
     GROUP BY b.`ftKodeWilayah`, b.`ftKodeKelompok`			
   ) xx	
   
   ORDER BY xx.ftGroup,xx.ftGroup2, xx.ftNamaKelompok 
      
    ");
  $no = 1;
  $jum = 1;
	while($r=mysql_fetch_array($tampil)){
    $j=$r['jumlah'];
   echo"<tr class='table-primary'>";
   if($jum <= 1) {
     echo"<td rowspan='$j' style='width: 5%; vertical-align: middle; text-align: center;'><div align='center' ><b>$no</b></div></td>";
        $jum = $r['jumlah'];       
        $no++;      
   }else{
        $jum = $jum - 1;
   }
  
    echo" <td ><div align='center' >$r[ftNamaKelompok]</div></td>
          <td ><div align='left' >$r[Description]</div></td>
          <td ><div align='center' >$r[fcDebet]</div></td>
          <td ><div align='center' >$r[fcKredit]</div></td>
        </tr>";
        $total_fcDebet += str_replace(',','',$r['fcDebet']);
        $total_fcKredit += str_replace(',','',$r['fcKredit']);
        $kas_saldo = $total_fcDebet - $total_fcKredit ;
        $totalJumlahKredit = $total_fcKredit + $kas_saldo;
        $conv_fcDebet=format_rupiah($total_fcDebet);
        $conv_fcKredit=format_rupiah($total_fcKredit);
        $conv_kas_saldo=format_rupiah($kas_saldo);
        $conv_totalJumlahKredit=format_rupiah($totalJumlahKredit);
  }

  echo"</tbody>
            <tfoot>
              <tr class='table-primary'>
                  <td rowspan='3' style='width: 5%; vertical-align: middle; text-align: center;'>
                      <div align='center' ><b>$no</b></div></td>
                  <td rowspan='3' ><div align='center' ></div></td>
                  <td ><div align='left' ><b>JUMLAH</b></div></td>
                  <td ><div align='center' ><b>$conv_fcDebet</b></div></td>
                  <td ><div align='center' ><b>$conv_fcKredit</b></div></td>
              </tr>
              <tr class='table-primary'>
                  <td ><div align='left' ><b>Kas Ditutup Dengan Saldo</b></div></td>
                  <td ><div align='center' ><b></b></div></td>
                  <td ><div align='center' ><b>( $conv_kas_saldo )</b></div></td>
              </tr>
              <tr class='table-primary'>
                  <td ><div align='left' ><b>JUMLAH</b></div></td>
                  <td ><div align='center' ><b>$conv_fcDebet</b></div></td>
                  <td ><div align='center' ><b>$conv_totalJumlahKredit</b></div></td>
              </tr>
            </tfoot>
          </table>
	  <table width='100%' border='0'>    
      <tr>
  	      <td colspan='5'>&nbsp;</td>
      </tr>
      <tr>
          <td ></td>
          <td colspan='2'><div align='center' class='style3'>Mengetahui/Menyetujui</div></td>
          
          <td colspan='2'><div align='center' class='style3'>Yang Menyusun</div></td>
      </tr>
      <tr>
          <td ></td>
          <td colspan='2'><div align='center' class='style3'>Pemimpin</div></td>
          
          <td colspan='2'><div align='center' class='style3'>Teller</div></td>
      </tr>
      <tr>
          <td colspan='5'>&nbsp;</td>
      </tr>
      <tr>
          <td colspan='5'>&nbsp;</td>
      </tr>
      <tr>
          <td colspan='5'>&nbsp;</td>
      </tr>
      <tr>
          <td colspan='5'>&nbsp;</td>
      </tr>
      <tr>
          <td ></td>
          <td colspan='2'><div align='center' class='style3'>(Derli Sihombing, S.AB)</div></td>
        
          <td colspan='2'><div align='center' class='style3'>(……………………………)</div></td>
      </tr>
    </table>
  </div>           
</div>
";
 // 	}
?>

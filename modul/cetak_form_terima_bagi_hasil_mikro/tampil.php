<?php 
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_indotgl.php";
include "../../config/fungsi_rupiah.php";
include "../../config/fungsi_terbilang.php";
$allDate = $_GET['allDate'];
$tgl_sekarang=tgl_indo_true(date('Y m d'));
$startDate = substr($allDate,0,10);
$kelompok = substr($allDate,18);
$thn=date('Y');
/*
var_dump($allDate);
var_dump($startDate);
var_dump($kelompok);exit;*/

?>
 <style type="text/css">
 .style3 {
  font-size: 18px;
  font-weight: bold;
}
 </style>

<?php	
//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
$tampil=mysql_query("SELECT b.`ftNamaKelompok`, b.`ftSubCabang` AS ftWilayah, a.`ftCustomer_Code`, b.`ftNamaNasabah` , b.`ftRegu`, 
a.`fnIndex` AS fnKe, d.fcPlafond,
a.`fcTotalAngsuran`-a.`fcTabAngsuran` AS fcBagiHasil, 
a.`fcTabAngsuran` AS fcSimpananWajib,
a.`fdTrans_date`,
CASE
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 0 THEN 'Minggu'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 1 THEN 'Senin'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 2 THEN 'Selasa'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 3 THEN 'Rabu'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 4 THEN 'Kamis'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 5 THEN 'Jumat'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 6 THEN 'Sabtu'
END AS hari, d.fnJW
FROM `txtagihan` a
LEFT JOIN tlnasabah b ON a.`ftCustomer_Code` = b.`ftNoRekening`
LEFT JOIN txpinjaman_mikro_nasabah_hdr d ON a.ftTrans_no = d.`ftTrans_No` AND a.`ftCustomer_Code` = d.`ftCustomer_Code`
WHERE b.`ftNamaKelompok` = '$kelompok'
AND a.`fdTrans_date`='$startDate'");

$tampil2=mysql_query("SELECT b.`ftNamaKelompok`, b.`ftSubCabang` AS ftWilayah, a.`ftCustomer_Code`, b.`ftNamaNasabah` , b.`ftRegu`,
a.`fnIndex` AS fnKe, d.fcPlafond,
a.`fcTotalAngsuran`-a.`fcTabAngsuran` AS fcBagiHasil, 
a.`fcTabAngsuran` AS fcSimpananWajib,
a.`fdTrans_date`,
CASE
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 0 THEN 'Minggu'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 1 THEN 'Senin'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 2 THEN 'Selasa'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 3 THEN 'Rabu'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 4 THEN 'Kamis'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 5 THEN 'Jumat'
WHEN DATE_FORMAT(a.`fdTrans_date`,'%w') = 6 THEN 'Sabtu'
END AS hari, d.fnjw
FROM `txtagihan` a
LEFT JOIN tlnasabah b ON a.`ftCustomer_Code` = b.`ftNoRekening`
LEFT JOIN txpinjaman_mikro_nasabah_hdr d ON a.ftTrans_no = d.`ftTrans_No` AND a.`ftCustomer_Code` = d.`ftCustomer_Code`
WHERE b.`ftNamaKelompok` = '$kelompok'
AND a.`fdTrans_date`='$startDate'");
 $s=mysql_fetch_array($tampil2)	;
   	
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
    <td colspan='14'><div align='center' class='style3'>FORM PENERIMAAN BAGI HASIL KELOMPOK</div></td>
  </tr>
  <tr>
    <td colspan='2'><table width='100%' border='1'>
      <tr>
        <td>Hari       </td>
        <td>: $s[hari] </td>
      </tr>
      <tr>
        <td>Tanggal</td>
        <td>: $s[fdTrans_date] </td>
      </tr>
      <tr>
        <td>Jam</td>
        <td>: 13:00 WIB </td>
      </tr>
    </table></td>
    <td width='1%'>&nbsp;</td>
    <td width='1%'>&nbsp;</td>
    <td width='13%'>&nbsp;</td>
    <td colspan='3'><table width='100%' border='0'>
      <tr>
        <td>Cabang          </td>
        <td>: $s[ftWilayah]</td>
      </tr>
      <tr>
        <td>Kelompok</td>
        <td>: $s[ftNamaKelompok] </td>
      </tr>
      <tr>
        <td>ID Kelompok </td>
        <td>: $s[fnKe]/$s[ftWilayah]/$thn </td>
      </tr>
    </table></td>
    <td width='9%'>&nbsp;</td>
    <td width='0%'>&nbsp;</td>
    <td width='12%'>&nbsp;</td>
    <td width='1%'>&nbsp;</td>
    <td width='8%'>&nbsp;</td>
    <td width='8%'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='14'><table width='100%'  border=1 >
      <thead>
      <tr>
        <th width='10%' rowspan='3'><div align='center'>No REK</div></th>
        <th width='14%' rowspan='3' valign='center'><div align='center'>Nama</div></th>
        <th width='10%' rowspan='3'><div align='center'>JW</div></th>
        <th width='4%' rowspan='3'><div align='center'>Bagi Hasil Ke-</div></th>
        <th width='9%' rowspan='3'><div align='center'>Penyertaan Ke- / Jumlah</div></th>
        <th colspan='4'><div align='center'>Absen / Jumlah Hari</div></th>
        <th width='4%' rowspan='3'><div align='center'>M&#8321;/M&#8322;</div></th>
        <th width='8%' rowspan='3'><div align='center'>Simpanan Wajib</div></th>
        <th width='8%' rowspan='3'><div align='center'>Simpanan Sukarela</div></th>
        <th width='5%' rowspan='3'><div align='center'>Bagi Hasil</div></th>
        <th width='3%' rowspan='3'><div align='center'>Ket</div></th>
      </tr>
      <tr>
        <th width='6%'><div align='center'>1</div></th>
        <th width='6%'><div align='center'>2</div></th>
        <th width='7%'><div align='center'>3</div></th>
        <th width='7%'><div align='center'>4</div></th>
        </tr>
      <tr>
        <th><div align='center'>Hadir dan Bayar</div></th>
        <th><div align='center'>Tidak Hadir Bayar</div></th>
        <th><div align='center'>Hadir di Tanggung Renteng</div></th>
        <th><div align='center'>Tidak Hadir &amp; di Tanggung Renteng</div></th>
        </tr>
      </thead>";
      while($r=mysql_fetch_array($tampil)){
      $fcPlafond=format_rupiah($r['fcPlafond']);
      $fcSimpananWajib=format_rupiah($r['fcSimpananWajib']);
      $fcBagiHasil=format_rupiah($r['fcBagiHasil']);
      $terbilang=terbilang($r['fcTotalAngsuran']);
   
      echo"<tr>
        <td>$r[ftCustomer_Code]</td>
        <td align='center'>$r[ftNamaNasabah]</td>
        <td align='center'>$r[fnJW]</td>
        <td align='center'>$r[fnKe]</td>
        <td align='center'>$r[fnKe]-/$fcPlafond</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align='right'>$fcSimpananWajib</td>
        <td>&nbsp;</td>
        <td align='right'>$fcBagiHasil</td>
        <td>&nbsp;</td>
      </tr>";
    $total_fcSimpananWajib += $r['fcSimpananWajib'];
    $total_fcBagiHasil += $r['fcBagiHasil'];
  
    }
    $total_fcSimpananWajib= format_rupiah($total_fcSimpananWajib); 
    $total_fcBagiHasil= format_rupiah($total_fcBagiHasil); 

      echo"<tr>
        <td colspan='5'><div align='center'><strong>TOTAL</strong></div></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <th>$total_fcSimpananWajib</th>
        <td>&nbsp;</td>
        <th align='right'>$total_fcBagiHasil</th>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan='2'><div align='center'><strong>Ketua Kumpulan</strong></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align='center'><strong>AO</strong></div></td>
    <td width='1%'>&nbsp;</td>
    <td width='15%'><div align='center'><strong>Admin</strong></div></td>
    <td width='15%'><div align='center'><strong>Head Mikro</strong></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan='3' rowspan='10' bordercolor='#FFFFFF'>
      <table width='100%' border='1'>
        <tr>
          <td colspan='2'><div align='center'><strong>Tanda Terima Uang</strong></div></td>
        </tr>
        <tr>
          <td width='32%'>100x </td>
          <td width='68%'>=</td>
        </tr>
        <tr>
          <td>50x </td>
          <td>=</td>
        </tr>
        <tr>
          <td>20x </td>
          <td>=</td>
        </tr>
        <tr>
          <td>10x </td>
          <td>=</td>
        </tr>
        <tr>
          <td>5x </td>
          <td>=</td>
        </tr>
        <tr>
          <td>2x</td>
          <td>=</td>
        </tr>
        <tr>
          <td>1x</td>
          <td>=</td>
        </tr>
        <tr>
          <td><strong>TOTAL</strong> </td>
          <td>=</td>
        </tr>
      </table>   </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width='1%'>&nbsp;</td>
    <td width='15%'>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='2'><div align='center'>(                                              )</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><div align='center'>(                                              )</div></td>
    <td>&nbsp;</td>
    <td><div align='center'>(                                              )</div></td>
    <td><div align='center'>(                                              )</div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

            </div>
            
          </div>
";
 // 	}
?>

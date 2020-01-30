<?php 
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_indotgl.php";
include "../../config/fungsi_rupiah.php";
include "../../config/fungsi_terbilang.php";
$allDate = $_GET['allDate'];
$tgl_sekarang=tgl_indo_true(date('Y m d'));
$startDate = substr($allDate,0,10);
$stoper = strpos($allDate,'dan');
$length = $stoper - 18;
$length2 = $stoper + 3;
$kelompok = substr($allDate,18,$length);
$n = substr($allDate,$length2);
if($n !="Pilih Nasabah"){
  $nasabah= $n;
}else{
  $nasabah= "";
}


?>
 <style type="text/css">
 .style2 {font-size: 10px}
 </style>

<?php	
//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
$tampil=mysql_query("SELECT a.`ftCustomer_Code`, b.`ftNamaNasabah` , a.`fnIndex` AS fnKe, d.`fnJW`, a.`fcTotalAngsuran`, a.`fcTabAngsuran`,
 MONTHNAME(a.fdTrans_date) AS ftbulan , a.`fdTrans_date`, b.`ftNamaKelompok`,b.`ftKantorBayar`,
 c.`ftCompany_Name`, c.`ftCompany_Address`, c.`ftCity`, c.`ftTelephone`,
 e.`ftNamaAdmKredit`
FROM `txtagihan` a
LEFT JOIN tlnasabah b ON a.`ftCustomer_Code` = b.`ftNoRekening`
INNER JOIN txpinjaman_umum_hdr d ON a.ftTrans_no = d.`ftTrans_No` AND a.`ftCustomer_Code` = d.`ftCustomer_Code`
CROSS JOIN tscompany_info c ON c.aktif = 'Y'
CROSS JOIN tljabatan e 
WHERE b.`ftKantorBayar` = '$kelompok' AND  b.`ftNamaNasabah` LIKE '%$nasabah%'
AND a.`fdTrans_date`='$startDate'");
	$no1 = 0;
   	while($r=mysql_fetch_array($tampil)){
		$fcTotalAngsuran=format_rupiah($r['fcTotalAngsuran']);
    $fcTabAngsuran=format_rupiah($r['fcTabAngsuran']);
    $terbilang=terbilang($r['fcTotalAngsuran']);
	 $no1++;	
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
              <table  id='table' class='table table-bordered table-striped' border=0 width=100%>
<tbody>
    <tr>
    <td colspan='9'><strong>$r[ftCompany_Name] </strong></td>
    <td>No Urut </td>
    <td>:</td>
    <td>$no1</td>
  </tr>
  <tr>
    <td colspan='12'>Ruko Tambun  City Blok RH No 11</td>
  </tr>
  <tr>
    <td colspan='12'>$r[ftCompany_Address] - $r[ftCity] - Telepon : $r[ftTelephone]</td>
  </tr>
  <tr>
    <td colspan='12'><div align='center'><strong>BUKTI PENERIMAAN ANGSURAN KREDIT</strong></div></td>
  </tr>
  <tr>
    <td colspan='12'><div align='center'><strong>$kelompok ( UMUM ) </strong></div></td>
  </tr>
  <tr>
    <td colspan='3'>Telah terima uang sebesar</td>
    <td><strong>Rp.  $fcTotalAngsuran,-</strong></td>
    <td colspan='8'>&nbsp;</td>
  </tr>
  <tr>
    <td>Terbilang </td>
    <td>:</td>
    <td colspan='2'>$terbilang</td>
    <td colspan='8'>&nbsp;</td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td colspan='3'>$r[ftNamaNasabah]</td>
    <td>Angsuran Ke </td>
    <td>:</td>
    <td>$r[fnKe]</td>
    <td>/</td>
    <td colspan='3'>$r[fnJW]</td>
  </tr>
  <tr>
    <td>No. Rekening</td>
    <td>:</td>
    <td colspan='3'>$r[ftCustomer_Code]</td>
    <td>Bulan</td>
    <td>:</td>
    <td colspan='5'>$r[ftbulan]</td>
  </tr>
  <tr>
    <td>Perusahaan</td>
    <td>:</td>
    <td colspan='3'>$r[ftKantorBayar]</td>
    <td>Tgl. Transaksi</td>
    <td>:</td>
    <td colspan='5'>$r[fdTrans_date]</td>
  </tr>
  <tr>
    <td colspan='6'>&nbsp;</td>
    <td colspan='6'><div align='center'>$r[ftCity], $tgl_sekarang</div></td>
  </tr>
  <tr>
    <td colspan='6'>&nbsp;</td>
    <td colspan='6'><div align='center'>Adm. Kredit</div></td>
  </tr>
  <tr>
    <td colspan='6'>&nbsp;</td>
    <td colspan='6' rowspan='2'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='6'>- <em>Angsuran Sudah termasuk tabungan Rp. $fcTabAngsuran,-</em></td>
    </tr>
  <tr>
    <td colspan='6'>- <em>Bawalah kwitansi ini setiap berhubungan dengan KSP Martabe Jaya </em></td>
    <td colspan='6'><div align='center'>$r[ftNamaAdmKredit]</div></td>
  </tr>
  </tbody>
</table>
            </div>
            
          </div>
<hr color='black'>";
  	}
?>

<?php
$startDate=$_POST['tgl'];
$kantorbayar=$_POST['ftNamaKantorBayar'];

session_start();
include "../config/config.php";

//include "../modul/laporan_penyaluran_kredit_pensiun/tampil.php";
//$fullname	= $_SESSION['fullname'];
$time=date("h:i:s a");
$time2=date('Y-m-d (H:i:s)');
$tanggal=date('d-F-Y');
$tanggal2=date('Y-m-d');

if(isset($_POST['tgl']))
	{

header("Content-Type: application/msexcel");
header('Content-Disposition: attachment; filename="EXPORT CETAK BUKTI ANGSURAN UMUM ' .$time2.'.xls"');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EXPORT CETAK BUKTI ANGSURAN UMUM</title>
<style type="text/css"></style>
</head>
<body id="tgl">
<span >EXPORT CETAK BUKTI ANGSURAN UMUM</span><br>
<span >DATE  :  <?php echo $tanggal2;?> </span><br>
<span >TIME  :  <?php echo $time;?> </span><br><br>


<?php  
include "../config/fungsi_terbilang.php"; 
//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
$tampil=mysql_query("SELECT a.`ftCustomer_Code`, b.`ftNamaNasabah` , a.`fnIndex` AS fnKe, d.`fnJW`, a.`fcTotalAngsuran`, a.`fcTabAngsuran`,
 MONTHNAME(a.fdTrans_date) AS ftbulan , a.`fdTrans_date`, b.`ftNamaKelompok`,b.`ftKantorBayar`,
 c.`ftCompany_Name`, c.`ftCompany_Address`, c.`ftCity`, c.`ftTelephone`,
 e.`ftNamaAdmKredit`
FROM `txtagihan` a
LEFT JOIN tlnasabah b ON a.`ftCustomer_Code` = b.`ftNoRekening`
LEFT JOIN txpinjaman_mikro_nasabah_hdr d ON a.ftTrans_no = d.`ftTrans_No` AND a.`ftCustomer_Code` = d.`ftCustomer_Code`
CROSS JOIN tscompany_info c
CROSS JOIN tljabatan e 
WHERE b.`ftKantorBayar` = '$kantorbayar'
AND a.`fdTrans_date`='$startDate'");
    $no1 = 0;
    while($r=mysql_fetch_array($tampil)){
        $fcTotalAngsuran=number_format($r['fcTotalAngsuran']);
        $terbilang=terbilang($r['fcTotalAngsuran']);
     $no1++;    
echo"<table  id='table' class='table table-bordered table-striped' border=0 width=100%>
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
    <td colspan='12'><div align='center'><strong>$kantorbayar ( MIKRO ) </strong></div></td>
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
    <td></td>
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
    <td colspan='5' align='left'>$r[fdTrans_date]</td>
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
    <td colspan='6'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='6'>- Angsuran Sudah termasuk tabungan Rp. 5.000,-</td>
    <td colspan='6'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='6'>- Bawalah kwitansi ini setiap berhubungan dengan KSP Martabe Jaya</td>
    <td colspan='6'><div align='center'>$r[ftNamaAdmKredit]</div></td>
  </tr>
  </tbody>
</table>
<hr color='black'>";
    }
?>
</body>
</html>
<?php } ?> 
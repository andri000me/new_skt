<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
$wilayah = $_GET['wilayah'];


/*var_dump($allDate);
var_dump($startDate);
var_dump($kelompok);exit;*/

?>
 <style type="text/css">

 </style>
<center ><b>DAFTAR NAMA KELOMPOK </b></center>
<table   class="table table-bordered table-striped" border=1 width=100%>

	
<thead>
<tr class="success">
    <td width="1%">NOMOR</td>
    <th width="8%"><div align="center">KODE KELOMPOK</div></th>
    <th width="9%"><div align="center">NAMA KELOMPOK</div></th>
    <th width="8%"><div align="center">WILAYAH</div></th>
    <th width="6%" ><div align="center">STATUS</div></th>
    
  </tr>
 
  <thead>
	<tbody>
<?php	
//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
$tampil=mysql_query("SELECT ftKodeKelompok, ftNamaKelompok, ftKodeWilayah,  
CASE WHEN fnstatus = 1 THEN 'Aktif' ELSE 'Tidak Aktif' END AS ftStatus
FROM tlkelompok WHERE ftKodeWilayah ='$wilayah' ");
	$no1 = 0;
	while($r=mysql_fetch_array($tampil)){
		
	 $no1++;	
echo"
    <tr>
        <td>$no1</td>
        <td>$r[ftKodeKelompok]</td>
        <td >$r[ftNamaKelompok]</td>
        <td>$r[ftKodeWilayah]</td>
        <td><div align='center'>$r[ftStatus]</div></td>
        
    </tr>";
	}
?>
</tbody>

	</table>
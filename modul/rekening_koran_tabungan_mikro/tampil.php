<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
$search = $_GET['search'];
//var_dump($search);exit;
$tampil=mysql_query("SELECT xx.fdTrans_date, xx.ftTrans_No, xx.ftCustomer_Code, yy.`ftNamaNasabah`, 	
					yy.`ftSubCabang`,yy.`ftNamaKelompok`, xx.fcTabMasuk, xx.fcTabKeluar	
					FROM (	
						SELECT b.fdTrans_date, a.ftTrans_No, b.ftCustomer_Code, 
						b.fcSimpanan AS fcTabMasuk, 0 AS fcTabKeluar
						FROM txpinjaman_mikro_hdr a
						LEFT JOIN txpinjaman_mikro_nasabah_hdr b ON a.`ftTrans_No`=b.`ftTrans_No` 
						AND a.ftKodeKelompok = b.ftKodeKelompok AND a.ftKodeWilayah = b.ftKodeWilayah
						WHERE a.fnStatus = 1 AND b.fnStatus = 1
						AND b.ftCustomer_Code='$search' 						
						UNION ALL						
						SELECT fdTrans_date, ftTrans_No, ftCustomer_Code, fcTabAngsuran , 0
						FROM txangsuran_mikro_hdr WHERE fnStatus = 1
						AND ftCustomer_Code='$search' 

						UNION ALL
	
						SELECT tgl_transaksi, 'Setor tunai', b.ftNoRekening, a.jumlah,0
						FROM tbl_trans_sp a
						INNER JOIN tlnasabah b ON b.`fnid`=a.anggota_id
						WHERE a.dk='D' AND b.ftNoRekening='$search' 

						UNION ALL
	
						SELECT tgl_transaksi, 'Setor tunai', b.ftNoRekening, 0, a.jumlah
						FROM tbl_trans_sp a
						INNER JOIN tlnasabah b ON b.`fnid`=a.anggota_id
						WHERE a.dk='K' AND b.ftNoRekening='$search' 

					) xx	
					INNER JOIN tlnasabah yy ON xx.ftCustomer_Code = yy.`ftNoRekening`	
					WHERE xx.ftCustomer_Code='$search' 	
					ORDER BY xx.fdTrans_date");

$tampil2=mysql_query("SELECT xx.fdTrans_date, xx.ftTrans_No, xx.ftCustomer_Code, yy.`ftNamaNasabah`, 	
					yy.`ftSubCabang`,yy.`ftNamaKelompok`, xx.fcTabMasuk, xx.fcTabKeluar	
					FROM (	
						SELECT b.fdTrans_date, a.ftTrans_No, b.ftCustomer_Code, 
						b.fcSimpanan AS fcTabMasuk, 0 AS fcTabKeluar
						FROM txpinjaman_mikro_hdr a
						LEFT JOIN txpinjaman_mikro_nasabah_hdr b ON a.`ftTrans_No`=b.`ftTrans_No` 
						AND a.ftKodeKelompok = b.ftKodeKelompok AND a.ftKodeWilayah = b.ftKodeWilayah
						WHERE a.fnStatus = 1 AND b.fnStatus = 1
						AND b.ftCustomer_Code='$search' 						
						UNION ALL						
						SELECT fdTrans_date, ftTrans_No, ftCustomer_Code, fcTabAngsuran , 0
						FROM txangsuran_mikro_hdr WHERE fnStatus = 1
						AND ftCustomer_Code='$search' 

						UNION ALL
	
						SELECT tgl_transaksi, 'Setor tunai', b.ftNoRekening, a.jumlah,0
						FROM tbl_trans_sp a
						INNER JOIN tlnasabah b ON b.`fnid`=a.anggota_id
						WHERE a.dk='D' AND b.ftNoRekening='$search' 

						UNION ALL
	
						SELECT tgl_transaksi, 'Setor tunai', b.ftNoRekening, 0, a.jumlah
						FROM tbl_trans_sp a
						INNER JOIN tlnasabah b ON b.`fnid`=a.anggota_id
						WHERE a.dk='K' AND b.ftNoRekening='$search' 

					) xx	
					INNER JOIN tlnasabah yy ON xx.ftCustomer_Code = yy.`ftNoRekening`	
					WHERE xx.ftCustomer_Code='$search' 	
					ORDER BY xx.fdTrans_date");

	
?>
 <style type="text/css">

 </style>
<center ><b>REKENING KORAN TABUNGAN MIKRO </b></center>
<table  id="table" class="table table-bordered table-striped" border=1 width=30%>
	<thead>
	<?php 
	$w=mysql_fetch_array($tampil2);
	echo"
	<tr ><th width ='40'><b>NAMA</b></th><th width ='10'>:</th><th id='namaNasabah'>$w[ftNamaNasabah]</th></tr>       
    <tr ><th><b>NO REKENING</b></th><th>:</th><th>$w[ftCustomer_Code]</th></tr> 
    <tr ><th><b>WILAYAH</b></th><th>:</th><th>$w[ftSubCabang]</th></tr> 
    <tr ><th><b>KELOMPOK</b></th><th>:</th><th>$w[ftNamaKelompok]</th></tr> 
    ";

    ?>   
	<thead>
</table>	
<table  id="table" class="table table-bordered table-striped" border=1 width=100%>	
<thead>
<tr class="success">
        <th><b><center>NO<center></b></th>      
        <th><b><center>TANGGAL<center></b></th>
        <th><b><center>KETERANGAN<center></b></th>
        <th><b><center>MASUK<center></b></th>
        <th><b><center>KELUAR<center></b></th>
        <th><b><center>SALDO</th>
    </tr>  
	<thead>
	<tbody>
<?php	
	$count=1;
	function num($rp){
		if($rp!=0){$r = number_format($rp, 0, '.', ',');}else{$r=0;}return $r;
	}
	while($r=mysql_fetch_array($tampil)){
		
	echo"
    <tr>
        <td align='center'>$count</td>
        <td align='center'>$r[fdTrans_date]</td>      
        <td align='center'>$r[ftTrans_No]</td> ";
        if($count==1){
			/* pertama kali deklarasi fcTabMasuk */
		   echo"<td>Rp. ".num($r['fcTabMasuk'])."</td>";
		   echo"<td>Rp. ".num($r['fcTabKeluar'])."</td>";
		   $fcTabMasuk=$r['fcTabMasuk'];
		   $saldo=$r['fcTabMasuk']."</td>";
		   echo"<td>RP. ".num($saldo);   
		  }else{
		   if($r['fcTabMasuk']!=0){   
			 /* Jika fcTabMasuk tidak sama dengan 0 */
			echo"<td>Rp. ".num($r['fcTabMasuk'])."</td>";
			echo"<td>Rp. ".num($r['fcTabKeluar'])."</td>";
			$fcTabMasuk=$fcTabMasuk+$r['fcTabMasuk'];
			$saldo=$saldo+$r['fcTabMasuk']."</td>";
			echo"<td>Rp. ".num($saldo);    
		   }else{
			/* Jika fcTabMasuk sama dengan 0 */
			echo"<td>Rp. ".num($r['fcTabMasuk'])."</td>";
			echo"<td>Rp. ".num($r['fcTabKeluar'])."</td>";
			$fcTabKeluar=$fcTabKeluar+$r['fcTabKeluar'];
			$saldo=$saldo-$r['fcTabKeluar']."</td>";
			echo"<td>Rp. ".num($saldo);    
		   }
		  }
		 echo"</tr>";
		// echo"<tr>";
		  $count++;    
	}
  echo"<tr>";
  echo"<th colspan='3' style='text-align: right;'>Jumlah --></th>";
  echo"<th>Rp. ".num($fcTabMasuk)."</th>";
  echo"<th>Rp. ".num($fcTabKeluar)."</th>";
  echo"<th>Rp. ".num($saldo)."</th>";
 echo"</tr>";

?>
	<tbody>
</table>
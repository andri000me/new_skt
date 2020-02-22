<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
$search = $_GET['search'];
//var_dump($search);exit;
$tampil=mysql_query("SELECT xx.fdTrans_date, xx.ftTrans_No, xx.ftCustomer_Code, yy.`ftNamaNasabah`, 	
					yy.`ftKantorBayar`, xx.fcRrpMasuk, xx.fcRrpKeluar	
					FROM (	
						SELECT fdTrans_date, ftTrans_No, ftCustomer_Code, 
						fcRrp AS fcRrpMasuk, 0 AS fcRrpKeluar
						FROM txpinjaman_umum_hdr WHERE fnStatus = 1
						AND ftCustomer_Code='$search' 
						) xx	
					INNER JOIN tlnasabah yy ON xx.ftCustomer_Code = yy.`ftNoRekening`	
					WHERE xx.ftCustomer_Code='$search' 	
					ORDER BY xx.fdTrans_date");
$tampil2=mysql_query("SELECT xx.fdTrans_date, xx.ftTrans_No, xx.ftCustomer_Code, yy.`ftNamaNasabah`, 	
					yy.`ftKantorBayar`, xx.fcRrpMasuk, xx.fcRrpKeluar	
					FROM (	
						SELECT fdTrans_date, ftTrans_No, ftCustomer_Code, 
						fcRrp AS fcRrpMasuk, 0 AS fcRrpKeluar
						FROM txpinjaman_umum_hdr WHERE fnStatus = 1
						AND ftCustomer_Code='$search' 
						) xx	
					INNER JOIN tlnasabah yy ON xx.ftCustomer_Code = yy.`ftNoRekening`	
					WHERE xx.ftCustomer_Code='$search' 	
					ORDER BY xx.fdTrans_date");
	
	
?>
 <style type="text/css">

 </style>
<center ><b>REKENING KORAN RRP DS UMUM </b></center>
<table  id="table" class="table table-bordered table-striped" border=1 width=30%>
	<thead>
	<?php 
	$w=mysql_fetch_array($tampil2);
	echo"
	<tr ><th width ='40'><b>NAMA</b></th><th width ='10'>:</th><th id='namaNasabah'>$w[ftNamaNasabah]</th></tr>       
    <tr ><th><b>NO REKENING</b></th><th>:</th><th>$w[ftCustomer_Code]</th></tr> 
    <tr ><th><b>KANTOR BAYAR</b></th><th>:</th><th>$w[ftKantorBayar]</th></tr> 
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
			/* pertama kali deklarasi fcRrpMasuk */
		   echo"<td>Rp. ".num($r['fcRrpMasuk'])."</td>";
		   echo"<td>Rp. ".num($r['fcRrpKeluar'])."</td>";
		   $fcRrpMasuk=$r['fcRrpMasuk'];
		   $saldo=$r['fcRrpMasuk']."</td>";
		   echo"<td>RP. ".num($saldo);   
		  }else{
		   if($r['fcRrpMasuk']!=0){   
			 /* Jika fcRrpMasuk tidak sama dengan 0 */
			echo"<td>Rp. ".num($r['fcRrpMasuk'])."</td>";
			echo"<td>Rp. ".num($r['fcRrpKeluar'])."</td>";
			$fcRrpMasuk=$fcRrpMasuk+$r['fcRrpMasuk'];
			$saldo=$saldo+$r['fcRrpMasuk']."</td>";
			echo"<td>Rp. ".num($saldo);    
		   }else{
			/* Jika fcRrpMasuk sama dengan 0 */
			echo"<td>Rp. ".num($r['fcRrpMasuk'])."</td>";
			echo"<td>Rp. ".num($r['fcRrpKeluar'])."</td>";
			$fcRrpKeluar=$fcRrpKeluar+$r['fcRrpKeluar'];
			$saldo=$saldo-$r['fcRrpKeluar']."</td>";
			echo"<td>Rp. ".num($saldo);    
		   }
		  }
		 echo"</tr>";
		// echo"<tr>";
		  $count++;    
	}
  echo"<tr>";
  echo"<th colspan='3' style='text-align: right;'>Jumlah --></th>";
  echo"<th>Rp. ".num($fcRrpMasuk)."</th>";
  echo"<th>Rp. ".num($fcRrpKeluar)."</th>";
  echo"<th>Rp. ".num($saldo)."</th>";
 echo"</tr>";

?>
	<tbody>
</table>
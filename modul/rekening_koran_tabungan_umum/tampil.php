<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
$search = $_GET['search'];
//var_dump($search);exit;
$tampil=mysql_query("SELECT xx.fdTrans_date, xx.ftTrans_No, xx.ftCustomer_Code, yy.`ftNamaNasabah`, 	
					yy.`ftKantorBayar`, xx.fcTabMasuk, xx.fcTabKeluar	
					FROM (	
						SELECT fdTrans_date, ftTrans_No, ftCustomer_Code, 
						fcSimpanan AS fcTabMasuk, 0 AS fcTabKeluar
						FROM txpinjaman_umum_hdr WHERE fnStatus = 1
						AND ftCustomer_Code='$search' 						
						UNION ALL						
						SELECT fdTrans_date, ftTrans_No, ftCustomer_Code, fcTabAngsuran , 0
						FROM txangsuran_umum_hdr WHERE fnStatus = 1
						AND ftCustomer_Code='$search' 
					) xx	
					INNER JOIN tlnasabah yy ON xx.ftCustomer_Code = yy.`ftNoRekening`	
					WHERE xx.ftCustomer_Code='$search' 	
					ORDER BY xx.fdTrans_date");
$tampil2=mysql_query("SELECT xx.fdTrans_date, xx.ftTrans_No, xx.ftCustomer_Code, yy.`ftNamaNasabah`, 	
						yy.`ftKantorBayar`, xx.fcTabMasuk, xx.fcTabKeluar	
						FROM (	
							SELECT fdTrans_date, ftTrans_No, ftCustomer_Code, 
							fcSimpanan AS fcTabMasuk, 0 AS fcTabKeluar
							FROM txpinjaman_umum_hdr WHERE fnStatus = 1
							AND ftCustomer_Code='$search' 							
							UNION ALL							
							SELECT fdTrans_date, ftTrans_No, ftCustomer_Code, fcTabAngsuran , 0
							FROM txangsuran_umum_hdr WHERE fnStatus = 1
							AND ftCustomer_Code='$search' 
						) xx	
						INNER JOIN tlnasabah yy ON xx.ftCustomer_Code = yy.`ftNoRekening`	
						WHERE xx.ftCustomer_Code='$search' 	
						ORDER BY xx.fdTrans_date");
	$no1 = 0;
	
?>
 <style type="text/css">

 </style>
<center ><b>REKENING KORAN TABUNGAN UMUM </b></center>
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


	while($r=mysql_fetch_array($tampil)){
		$fcTabMasuk=format_rupiah($r['fcTabMasuk']);
		$fcTabKeluar=format_rupiah($r['fcTabKeluar']);
		$Saldo=format_rupiah($r['Saldo']);				
		$no1++;	
				
				echo"
    <tr>
        <td align='center'>$no1</td>
        <td align='center'>$r[fdTrans_date]</td>      
        <td align='center'>$r[ftTrans_No]</td> 
        <td align='right'>$fcTabMasuk</td>
        <td align='right'>$fcTabKeluar</td>
        <td align='right'>$Saldo</td>
      
    </tr>";
	}


?>
</tbody>
	</table>
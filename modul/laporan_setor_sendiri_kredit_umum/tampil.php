<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
include "../../config/fungsi_indotgl.php";
$allDate = $_GET['allDate'];
$kelompok = $_GET['kel'];
$startDate = substr($allDate,0,10);
$endDate = substr($allDate,-10);
/*var_dump($allDate);
var_dump($kelompok);
var_dump($startDate);
var_dump($endDate);exit;*/
$header=mysql_query("SELECT  a.fdTrans_date, b.ftNamaKelompok AS ftkelompok,b.ftKantorBayar	FROM txangsuran_umum_hdr a
					LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening WHERE a.fdTrans_date between '$startDate' AND '$endDate' GROUP BY b.ftKantorBayar ");
//while($w=mysql_fetch_array($header)){
$ketemu=mysql_num_rows($header);
while($w=mysql_fetch_array($header)){
$d=$w[ftKantorBayar];
$e=$w[fdTrans_date];

/*$header=mysql_query("SELECT b.ftKantorBayar AS ftKantorBayar,a.fdTrans_date FROM txangsuran_umum_hdr a LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening WHERE a.fnStatus <> 9 AND a.fdTrans_date between '$startDate' AND '$endDate' GROUP BY ftKantorBayar ");
//while($w=mysql_fetch_array($header)){
$ketemu=mysql_num_rows($header);
while($w=mysql_fetch_array($header)){
$d=$w[ftKantorBayar];
$e=$w[fdTrans_date];   */         
      
 
    
 $temp ="<center><b>LAPORAN SETOR SENDIRI KREDIT KREDIT UMUM<br>TANGGAL : $e<br>Kantor Bayar :$d";
   
  $temp .="</b></center>
            <table  id='table' class='table table-bordered table-striped' border=1 width=100%>
            <thead>
             <tr class='info'>
			    <th rowspan='2'><div align='center'>NO</div></th>
			    <th rowspan='2'><div align='center'>NOREK</div></th>
			    <th rowspan='2'><div align='center'>TGL PL </div></th>
			    <th rowspan='2'><div align='center'>NAMA</div></th>
			    <th rowspan='2'><div align='center'>KE</div></th>
			    <th rowspan='2'><div align='center'>JW</div></th>
			    <th><div align='center'>SB</div></th>
			    <th rowspan='2'><div align='center'>PLAFOND</div></th>
			    <th colspan='5'><div align='center'>SETORAN ANGSURAN </div></th>
			    <th rowspan='2'><div align='center'>TOTAL</div> </th>
			  </tr>
			  <tr class='info'>
			    <th><div align='center'>%</div></th>
			    <th><div align='center'>POKOK</div></th>
			    <th><div align='center'>BUNGA</div></th>
			    <th><div align='center'>TAB</div></th>
			    <th><div align='center'>ADM</div></th>
			    <th><div align='center'>P.NOL</div></th>
			  </tr>
                </thead>
                <tbody>";



//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
    $tampil=mysql_query("SELECT a.ftCustomer_Code , a.fdTrans_date, b.ftNamaNasabah, b.ftSubCabang AS ftwilayah,  b.ftkantorbayar,
						0 AS fnKE, a.fnJW, a.ffBunga, FORMAT(a.fcPlafond,0) AS fcPlafond,
						FORMAT(a.fcPokokAngsuran,0) AS fcPokokAngsuran, 
						FORMAT(a.fcBunganAngsuran,0) AS fcBunganAngsuran, 
						FORMAT(a.fcTabAngsuran,0) AS fcTabAngsuran, 
						FORMAT(a.fcAdmAngsuran,0) AS fcAdmAngsuran, 
						FORMAT(a.fcPbltAngsuran,0) AS fcPbltAngsuran, 
						FORMAT(a.fcTotalAngsuran,0) AS fcTotalAngsuran
						FROM txangsuran_umum_hdr a
						LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening
						WHERE  b.ftkantorbayar='$d' AND a.fdTrans_date between '$startDate' AND '$endDate'
						UNION ALL
						SELECT  '' ,
						        '' ,
						        '' ,
						        '' ,
						        '' ,
						        '' ,
						        '' ,
							'<b>GRAND TOTAL -></b>' AS fnJW,
						        FORMAT(SUM(a.fcPlafond),0) AS fcPlafond,
						        FORMAT(SUM(a.fcPokokAngsuran),0) AS fcPokokAngsuran,
						        FORMAT(SUM(a.fcBunganAngsuran),0) AS fcBunganAngsuran,
						        FORMAT(SUM(a.fcTabAngsuran),0) AS fcTabAngsuran,
						        FORMAT(SUM(a.fcAdmAngsuran),0) AS fcAdmAngsuran,
						        FORMAT(SUM(a.fcPbltAngsuran),0) AS fcPbltAngsuran,
						        FORMAT(SUM(a.fcTotalAngsuran),0) AS fcTotalAngsuran
						FROM txangsuran_umum_hdr a
						LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening
						WHERE  b.ftkantorbayar='$d' AND a.fdTrans_date between '$startDate' AND '$endDate'
    ");
	$no1 = 0;
	while($r=mysql_fetch_array($tampil)){
		
				 $no1++;	
				
				
 $temp .="   <tr>
        <td>$no1</td>
        <td>$r[ftCustomer_Code]</td>
        <td>$r[fdTrans_date]</td>
        <td>$r[ftNamaNasabah]</td>
        <td>$r[fnKE]</td>
        <td>$r[fnJW]</td>
        <td>$r[ffBunga]</td>
        <td>$r[fcPlafond]</td>
        <td>$r[fcPokokAngsuran]</td>
        <td>$r[fcBunganAngsuran]</td>
        <td>$r[fcTabAngsuran]</td>
        <td>$r[fcAdmAngsuran]</td>
        <td>$r[fcPbltAngsuran]</td>
        <td>$r[fcTotalAngsuran]</td>
        
        
   </tr>";

  
	}
   

$temp .="</tbody>
    	</table>";

echo $temp; 
}
$query=mysql_fetch_array(mysql_query("SELECT ftNamaDirektur,ftNamaAdmKredit FROM tljabatan"));
$tgl=tgl_indo_true(date('Y m d'));
echo"<br><br><table  id='table' class='table table-bordered table-striped' border=0 width=100%>
            <tfoot>
             <tr>
			    <th><div align='center'></div></th>
			    <th colspan='3'><div align='center'></div> </th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div> </th>
			 	<th colspan='3'><div align='center'>Bekasi, $tgl </div></th>
			 	<th><div align='center'></div></th>
			  </tr>
			  <tr>
			    <th><div align='center'></div></th>
			    <th colspan='3'><div align='center'>Diketahui Oleh<br>Pimpinan</div> </th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div> </th>
			 	<th colspan='3'><div align='center'>Dibuat Oleh<br>Adm Kredit</div></th>
			 	<th><div align='center'></div></th>
			  </tr>
			  <tr>
			    <th><div align='center'></div></th>
			    <th colspan='3'><div align='center'></div> </th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div> </th>
			 	<th colspan='3'><div align='center'></div></th>
			 	<th><div align='center'></div></th>
			  </tr>
			  <tr>
			    <th><div align='center'></div></th>
			    <th colspan='3'><div align='center'></div> </th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div> </th>
			 	<th colspan='3'><div align='center'></div></th>
			 	<th><div align='center'></div></th>
			  </tr>
			  <tr>
			    <th><div align='center'></div></th>
			    <th colspan='3'><div align='center'></div> </th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div> </th>
			 	<th colspan='3'><div align='center'></div></th>
			 	<th><div align='center'></div></th>
			  </tr>
			  <tr>
			    <th><div align='center'></div></th>
			    <th colspan='3'><div align='center'>$query[ftNamaDirektur]</div> </th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div></th>
			    <th><div align='center'></div> </th>
			 	<th colspan='3'><div align='center'>$query[ftNamaAdmKredit] </div></th>
			 	<th><div align='center'></div></th>
			  </tr>
                </tfoot>
               </table>
";

    ?>
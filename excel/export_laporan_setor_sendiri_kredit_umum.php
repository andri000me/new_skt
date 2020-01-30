<?php
$emprut=$_POST['export'];
$startDate = substr($emprut,0,10);
$endDate = substr($emprut,-10);

session_start();
include "../config/config.php";
/*include "../config/fungsi_rupiah.php";*/
include "../config/fungsi_indotgl.php";
//include "../modul/laporan_penyaluran_kredit_pensiun/tampil.php";
//$fullname	= $_SESSION['fullname'];
$time=date("h:i:s a");
$time2=date('Y-m-d (H:i:s)');
$tanggal=date('d-F-Y');
$tanggal2=date('Y-m-d');

if(isset($_POST['export']))
	{

header("Content-Type: application/msexcel");
header('Content-Disposition: attachment; filename="EXPORT LAPORAN SETOR SENDIRI KREDIT UMUM ' .$time2.'.xls"');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EXPORT LAPORAN SETOR SENDIRI KREDIT UMUM</title>
<style type="text/css"></style>
</head>
<body id="export">
<span >EXPORT LAPORAN SETOR SENDIRI KREDIT UMUM</span><br>
<span >DATE  :  <?php echo $tanggal2;?> </span><br>
<span >TIME  :  <?php echo $time;?> </span><br><br>
<?php
 $header=mysql_query("SELECT  a.fdTrans_date, b.ftNamaKelompok AS ftkelompok,b.ftKantorBayar AS ftKantorBayar	FROM txangsuran_umum_hdr a
		LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening WHERE a.fdTrans_date between '$startDate' AND '$endDate' GROUP BY ftKantorBayar ");
              //while($w=mysql_fetch_array($header)){
                $ketemu=mysql_num_rows($header);
               while($w=mysql_fetch_array($header)){
            $d=$w[ftKantorBayar];
            $e=$w[fdTrans_date];
      
 
    
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
    $tampil=mysql_query("SELECT a.ftCustomer_Code , a.fdTrans_date, b.ftNamaNasabah, b.ftSubCabang AS ftwilayah, b.ftKantorBayar AS ftKantorBayar,
						0 AS fnKE, a.fnJW, a.ffBunga, FORMAT(a.fcPlafond,0) AS fcPlafond,
						FORMAT(a.fcPokokAngsuran,0) AS fcPokokAngsuran, 
						FORMAT(a.fcBunganAngsuran,0) AS fcBunganAngsuran, 
						FORMAT(a.fcTabAngsuran,0) AS fcTabAngsuran, 
						FORMAT(a.fcAdmAngsuran,0) AS fcAdmAngsuran, 
						FORMAT(a.fcPbltAngsuran,0) AS fcPbltAngsuran, 
						FORMAT(a.fcTotalAngsuran,0) AS fcTotalAngsuran
						FROM txangsuran_umum_hdr a
						LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening
						WHERE b.ftKantorBayar='$d' AND a.fdTrans_date between '$startDate' AND '$endDate'
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
						WHERE b.ftKantorBayar='$d' AND a.fdTrans_date between '$startDate' AND '$endDate'
    ");
$no1 = 0;

while($r = mysql_fetch_array($tampil)){
			
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
    	</table><br><br>";

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
} ?>
<?php
error_reporting(0);
include "../../config/config.php";
$act = $_GET['act'];
//var_dump($_GET['act']);
//if($printable){
?>
<!--  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
 
 

<div class="box box-primary" id='printr' >
<pre class="prettyprint" id="printr" >   
<center ><b>NASABAH </b></center>
<table  id="table" class="table table-bordered table-striped" border=1 width=100%>

	
<thead>
<tr class="success">
        <th width="50" height="50"><b>No</b></th>
        <th width="100"><b>TIPE NASABAH</b></th>    
        <th width="100"><b>NO REKENING</b></th> 
        <th width="100"><b>NAMA NASABAH</b></th>
        <th width="100"><b>NO HP</b></th>
        <th width="100"><b>PEKERJAAN</b></th>    
        <th width="100"><b>TEMPAT TANGGAL LAHIR</b></th> 
        <th width="100"><b>STATUS RUMAH</b></th>
        <th width="100"><b>TIM SURVEY</b></th>
        <th width="100"><b>NAMA KELOMPOK</b></th>    
        <th width="100"><b>SUB CABANG</b></th> 
        <th width="100"><b>STATUS</b></th>
    </tr>
	<thead>
	<tbody>
<?php	
//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
$tampil=mysql_query("SELECT 
                                fnId,
                                fnTipeNasabah,
                                ftNoRekening,
                                ftNamaNasabah,
                                ftNohp,
                                ftPekerjaan,
                                ftTempatTglLahir,
                                ftStatusRumah,
                                ftTimSurvey,
                                ftNamaKelompok,
                                ftSubCabang,
                                CASE 
                                WHEN fnStatus = 1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' 
                                END AS ftStatus 
                                FROM tlnasabah WHERE fnTipeNasabah='$act'");
	$no1 = 0;
	while($row=mysql_fetch_array($tampil)){
						 $no1++;	
				
				echo"
    <tr>
        <td  > $no1 </td>
        <td >$row[fnTipeNasabah]</td>   
        <td >$row[ftNoRekening]</td>   
        <td >$row[ftNamaNasabah]</td>   
        <td >$row[ftNohp]</td>   
        <td >$row[ftPekerjaan]</td>   
        <td >$row[ftTempatTglLahir]</td>   
        <td >$row[ftStatusRumah]</td>   
        <td >$row[ftTimSurvey]</td>   
        <td >$row[ftNamaKelompok]</td>   
        <td >$row[ftSubCabang]</td>   
        <td >$row[ftStatus]</td>
    </tr>";
	}


?>
</tbody>
	</table>
    </pre>
</div>
  <script>
        window.print('_blank');
    </script>

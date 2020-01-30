<?php
error_reporting(0);
include "../../config/config.php";
$printable = $_GET['printable'];
//echo $printable;
//if($printable){
?>
<!--  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
 
 

<div class="box box-primary" id='printr' >
<pre class="prettyprint" id="printr" >   
<center ><b>JABATAN</b></center>
<table  id="table" class="table table-bordered table-striped" border=1 width=100%>

	
<thead>
<tr class="success">
        <td width="50" height="50"><b>No</b></td>
            <td width="200"><b>NAMA</b></td>
            <td width="200"><b>JABATAN</b></td>
            <td width="200"><b>NIK</b></td>
    </tr>
	<thead>
	<tbody>
<?php	
//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
$tampil=mysql_query("SELECT ftNamaDirektur, ftJabatanDIrektur, ftNIKDirektur
                            FROM tljabatan
                            UNION ALL
                            SELECT ftNamaKabidOps, ftJabatanKabidOps, ftNIKKabidOps
                            FROM tljabatan
                            UNION ALL
                            SELECT ftNamaAdmKredit, ftJabatanAdmKredit, ftNIKAdmKredit
                            FROM tljabatan
                            UNION ALL
                            SELECT ftNamaSimpanan, ftNIKSimpanan, ftJabatanSimpanan
                            FROM tljabatan  
                            UNION ALL
                            SELECT ftNamaKasir,ftJabatanKasir ,ftNIKKasir
                            FROM tljabatan  
                            UNION ALL
                            SELECT ftNamaAkuntansi,ftJabatanAkuntansi ,ftNIKAkuntansi
                            FROM tljabatan");
	$no1 = 0;
	while($row=mysql_fetch_array($tampil)){
						 $no1++;	
				
				echo"
    <tr>
        <td  > $no1 </td>
        <td >$row[ftNamaDirektur]</td>   
        <td >$row[ftJabatanDIrektur]</td>   
        <td >$row[ftNIKDirektur]</td>   
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

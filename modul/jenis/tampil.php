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
<center ><b>JENIS </b></center>
<table  id="table" class="table table-bordered table-striped" border=1 width=100%>

	
<thead>
    <tr class="success">
            <th width="50" height="50"><b>No</b></th>
            <th width="100"><b>KODE JENIS</b></th>
            <th width="200"><b>NAMA JENIS</b></th>
            <th width="100"><b>STATUS</b></th>
    </tr>
	<thead>
	<tbody>
<?php	
//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
$tampil=mysql_query("SELECT ftKodeJenis, ftNamaJenis,
                            CASE 
                            WHEN fnStatus = 1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' 
                            END AS ftStatus
                             FROM tljenispensiun  ORDER BY ftKodeJenis");
	$no1 = 0;
	while($row=mysql_fetch_array($tampil)){
						 $no1++;	
				
				echo"
    <tr>
        <td  > $no1 </td>
        <td >$row[ftKodeJenis]</td>   
        <td >$row[ftNamaJenis]</td>   
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

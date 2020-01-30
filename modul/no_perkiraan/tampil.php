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
<center ><b>NO PERKIRAAN </b></center>
<table  id="table" class="table table-bordered table-striped" border=1 width=100%>

	
<thead>
<tr class="success">
        <th width="50" height="50"><b>No</b></th>
            <th width="100"><b>KODE PERKIRAAN</b></th>
            <th width="200"><b>NAMA PERKIRAAN</b></th>
            <th width="200"><b>KODE KATEGORI</b></th>
            <th width="100"><b>STATUS</b></th>
    </tr>
	<thead>
	<tbody>
<?php	
//$tampil=mysql_query("SELECT * FROM txpinjaman_mikro_hdr WHERE fdTrans_date between '$startDate' AND '$endDate'");
$tampil=mysql_query("SELECT ftKodePerkiraan, ftNamaPerkiraan, ftKodeKategori,
                            CASE 
                            WHEN fnStatus = 1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' 
                            END AS ftStatus 
                            FROM tlnoperkiraan  ORDER BY ftKodePerkiraan");
	$no1 = 0;
	while($row=mysql_fetch_array($tampil)){
						 $no1++;	
				
				echo"
    <tr>
        <td  > $no1 </td>
        <td >$row[ftKodePerkiraan]</td>   
        <td >$row[ftNamaPerkiraan]</td>   
        <td >$row[ftKodeKategori]</td>   
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

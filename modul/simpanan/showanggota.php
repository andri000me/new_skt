<?php
error_reporting(0);
include "../../config/config.php";
$kel=$_GET['kel'];
//var_dump($kel);
$tampil=mysql_query("SELECT fnId,ftNamaKelompok,ftNamaNasabah FROM tlnasabah WHERE ftNamaKelompok='$kel' AND fnStatus=1 ORDER BY ftNamaNasabah");
$jml=mysql_num_rows($tampil);
$i=0;
$results   = array(); 
//if($jml > 0){
   
     while($r=mysql_fetch_array($tampil)){
		 $results[] = array(
		   'fnId' => $r['fnId'],
           'nama' => $r['ftNamaNasabah']
		);
	 }
echo json_encode($results);
?>

      
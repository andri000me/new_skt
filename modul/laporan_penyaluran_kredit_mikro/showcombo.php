<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
$allDate = $_GET['allDate'];
 
$startDate = substr($allDate,0,10);
$endDate = substr($allDate,-10);
/*var_dump($allDate);
var_dump($startDate);
var_dump($endDate);exit;*/

switch($_GET['act']){
  // Tampil Hubungi Kami
  default:
 echo "";
                                
                             $tampil=mysql_query("SELECT b.ftNamaKelompok AS ftkelompok
                                FROM txpinjaman_mikro_nasabah_hdr a
                                LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening
                                WHERE a.fnStatus <> 9 AND a.fdTrans_date between '$startDate' AND '$endDate'  GROUP BY b.ftNamaKelompok ORDER BY b.ftNamaKelompok ASC ");
                             echo "<option value='all' selected>-- ALL --</option>";
                               while($r=mysql_fetch_array($tampil)){
                               echo "<option value='$r[ftkelompok]'>$r[ftkelompok]</option>"; }
                               
     echo" ";

  
break;

}   
?>
<?php
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_rupiah.php";
$allDate = $_GET['allDate'];
$startDate = substr($allDate,0,10);
$endDate = substr($allDate,-10);


switch($_GET['act']){
  // Tampil Hubungi Kami
  default:
 echo "";
                                
       $tampil=mysql_query("SELECT  a.fdTrans_date, b.ftNamaKelompok AS ftkelompok FROM txangsuran_mikro_hdr a
        LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening WHERE a.fdTrans_date between '$startDate' AND '$endDate' GROUP BY b.ftNamaKelompok ORDER BY b.ftNamaKelompok ASC ");
           echo "<option value='all' selected>-- ALL --</option>";
             while($r=mysql_fetch_array($tampil)){
             echo "<option value='$r[ftkelompok]'>$r[ftkelompok]</option>"; }
                               
     echo"";

  
break;

}   
?>
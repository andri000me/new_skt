<?php
error_reporting(0);
include "../../config/config.php";
$allDate = $_GET['allDate'];
$startDate = substr($allDate,0,10);
$endDate = substr($allDate,-10);
switch($_GET['act']){
default:
/*$tampil=mysql_query("SELECT b.ftKantorBayar AS ftKantorBayar
            FROM txpinjaman_umum_hdr a
            LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening
            WHERE a.fnStatus <> 9 AND a.fdTrans_date between '$startDate' AND '$endDate'  GROUP BY b.ftKantorBayar ORDER BY b.ftKantorBayar ASC ");
         echo "<option value='all' selected>-- ALL --</option>";
           while($r=mysql_fetch_array($tampil)){
           echo "<option value='$r[ftKantorBayar]'>$r[ftKantorBayar]</option>"; }*/

$tampil=mysql_query("SELECT  a.fdTrans_date, b.ftNamaKelompok AS ftkelompok,b.ftKantorBayar AS ftKantorBayar FROM txangsuran_umum_hdr a
        LEFT JOIN tlnasabah b ON a.ftCustomer_Code = b.ftNoRekening WHERE a.fdTrans_date between '$startDate' AND '$endDate' GROUP BY b.ftKantorBayar ORDER BY b.ftKantorBayar ASC ");
           echo "<option value='all' selected>-- ALL --</option>";
             while($r=mysql_fetch_array($tampil)){
             echo "<option value='$r[ftKantorBayar]'>$r[ftKantorBayar]</option>"; }           
break;

}   
?>
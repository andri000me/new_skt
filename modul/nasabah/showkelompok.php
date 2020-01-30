<?php
error_reporting(0);
include "../../config/config.php";
/*mysql_connect("localhost","root","");
mysql_select_db("db_skt");*/
$tampil=mysql_query("SELECT ftKodeWilayah,ftNamaKelompok,ftKodeKelompok FROM tlkelompok WHERE ftKodeWilayah='$_GET[wilayah]' AND fnStatus=1 ORDER BY ftNamaKelompok");
$jml=mysql_num_rows($tampil);
if($jml > 0){
    echo"<select name='ftNamaKelompok'>
     <option value='' selected>- Pilih -</option>";
     while($r=mysql_fetch_array($tampil)){
         echo "<option value='$r[ftKodeKelompok]''>$r[ftNamaKelompok]</option>";
     }
     echo "</select>";
}else{
    echo "<select name='ftNamaKelompok'>
     <option value='' selected>-- Belum Ada Kelompok --</option
     </select>";
}
  	 
?>

      
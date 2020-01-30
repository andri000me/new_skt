 <?php

include "config/config.php";
$existing = $_GET['progress_aktivasi'];
$tampil=mysql_query("SELECT * FROM vw_rev_cust WHERE pelanggan='$_GET[perusahaan]' ");
/*
$jml=mysql_num_rows($tampil);
if($jml > 0){
    echo"<select name='revenue'>";
     while($r=mysql_fetch_array($tampil)){
	 $rev = format_rupiah($r[rev]);
         echo "<option value=$r[rev]>$rev</option>";
     }
     echo "</select>";
}else{
    echo "<select name='revenue'>
     <option value=0 selected>- EMPTY -</option
     </select>";
}
*/
   		
				 $tampil=mysql_query("SELECT * FROM tbl_progress_aktivasi WHERE aktif='Y' ORDER BY nama_progress_aktivasi");
				 echo "<option value='' selected>-- Pilih --</option>";
				   while($r=mysql_fetch_array($tampil)){
				   echo "<option value='$r[nama_progress_aktivasi]'>$r[nama_progress_aktivasi]</option>"; }
				   
?>

                                      
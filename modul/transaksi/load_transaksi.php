<?php
error_reporting(0);
include "../../config/config.php";

$ftNoRekening = $_GET['ftNoRekening'];
$ftNamaNasabah = $_GET['ftNamaNasabah'];
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
$kota = mysql_query("SELECT ftNoRekening,ftNamaNasabah,ftAlamat FROM tlnasabah WHERE ftNoRekening='$ftNoRekening' ");
//echo "<option>-- Pilih Kabupaten/Kota --</option>";
$k = mysql_fetch_array($kota);
//echo "<option value=\"".$k['ftNoRekening']."\">".$k['ftNoRekening']."</option>\n";
echo "	
		<label>Nama</label>
		<input type='text' name='ftNamaNasabah' id='ftNamaNasabah2' value='$k[ftNamaNasabah]' class='form-control' placeholder='Input ...'>
		</br>
		<label>Alamat</label>
		<textarea class='form-control' name='ftAlamat'  rows='10' placeholder='Enter ...'>$k[ftAlamat]</textarea>
		";
		
break;

}	
?>
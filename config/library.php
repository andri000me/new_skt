<?php
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
$query=mysql_fetch_array(mysql_query("SELECT fnid,fnStatus,fdDateFrom,fdDateEnd FROM txtutup_hari ORDER BY fnid DESC LIMIT 0, 1"));
$startdate=$query['fdDateFrom'];
$datestart = new DateTime($startdate);
$datestart->modify("+". (0) . "day");
$datestartt=$datestart->format('w');
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$datestartt];

$tgl_sekarang = date("Ymd");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");
?>

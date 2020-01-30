<?php
session_start();
error_reporting(0);
include "../../config/config.php";
$tgl_sekarang = date("Y-m-d H:i:s");

 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/config.php";

$module=$_GET[module];
$act=$_GET[act];
$jam = date("H:i:s");
// Update Log User
if ($module=='log_user' AND $act=='kill'){
  $query1=mysql_query("UPDATE users SET isLogin=0 WHERE username='$_GET[username]'");

  mysql_query("UPDATE tbl_log SET jamout ='$jam',
                              	  status ='offline'
  WHERE username = '$_SESSION[namalengkap]' AND jamout='logged' AND status='online'");
  header('location:log-user.html');
}
}
?>

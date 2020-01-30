<?php
  session_start();
  error_reporting(0);
  include "config/config.php";
  $jam = date("H:i:s");
   session_destroy();                     
  mysql_query("UPDATE tbl_log SET jamout='$jam',
                              status='offline'
  WHERE username = '$_SESSION[namalengkap]' AND jamout='logged' AND status='online'");
  mysql_query("UPDATE users SET isLogin= 0  WHERE id_session='$_SESSION[sessid]'");
  
  echo "<script>alert('Anda telah keluar dari halaman'); window.location = 'index.html'</script>";
?>
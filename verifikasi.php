<?php
error_reporting(0);
include "config/func_connection.php";
require('config/userInfo.php');
setConnection();
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}
//------------------------------------------------------------------------------
Function getHashEncrypt($str){
  return ($str != "") ? HASH('sha256',($str)) : "";
}
//$username = anti_injection($_POST['username']);
//$pass     = anti_injection(md5($_POST['password']));
$username     = anti_injection(getHashEncrypt($_POST['username']));
$pass     = anti_injection(getHashEncrypt($_POST['password']));
//var_dump($pass);exit();
// pastikan username dan password adalah berupa huruf atau angka.
/*if (!ctype_alnum($username) OR !ctype_alnum($pass)){
  echo "Sekarang loginnya tidak bisa di injeksi lho.";
}
else{
	*/
$login=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$pass' AND blokir='N'");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
// Apabila user masih login
//if($r[isLogin]==0){
// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
    


  $_SESSION[username]     = $r[username];
  $_SESSION[namalengkap]  = $r[nama_lengkap];
  $_SESSION[passuser]     = $r[password];
  $_SESSION[sessid]       = $r[id_session];
  $_SESSION[leveluser]    = $r[level];
  $_SESSION[sebagai]      = $r[role];
  $_SESSION[region]       = $r[region];
  $_SESSION[timeout]     = time();

   // session timeout
 // $_SESSION[login] = 1;
 // timer();
  
  $jam = date("H:i:s");
  $tgl = date("Y-m-d");
  $ip=UserInfo::get_ip();
  $os=UserInfo::get_os();
  $device=UserInfo::get_device();
  $browser=UserInfo::get_browser();
  //var_dump($ip);exit;
  mysql_query("UPDATE users SET  isLogin = 1 ,
                                  ip = '$ip',
                                  os = '$os',
                                  device = '$device',
                                  browser =  '$browser'      WHERE id_session='$_SESSION[sessid]' ");
  mysql_query("INSERT INTO tbl_log(username,
                                 tanggal,
                                 jamin,
                                 jamout,
                                 status)
                           VALUES('$_SESSION[namalengkap]',
                                '$tgl',
                                '$jam',
                                'logged',
                                'online')");


  header('location:home.html');
}else{
	

   echo "
  <link href='css/betron.css' rel='stylesheet' type='text/css'>";

  echo "
  </head>
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  
  <img src='images/lock.png'>
  <h1>LOGIN GAGAL</h1>
  
  <p><span class style=\"font-size:14px; color:#ccc;\">Username atau Password anda tidak sesuai.<br>
  Atau akun anda sedang diblokir.</p></span><br/>
  
  </section>
  
  <section id='error-text'>
  <p><a class='button' href='index.php'>&nbsp;&nbsp; <b>ULANGI LAGI</b> &nbsp;&nbsp;</a></p>
  </section>
  </div>";

}
/*}else{
  

   echo "
  <link href='css/betron.css' rel='stylesheet' type='text/css'>";

  echo "
  </head>
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  
  <img src='images/lock.png'>
  <h1>LOGIN GAGAL</h1>
  
  <p><span class style=\"font-size:14px; color:#ccc;\">User Anda Sedang Digunakan di Perangkat Lain.<br>
  Silahkan Logout Terlebih Dahulu, Atau Hubungi Admin SKT .</p></span><br/>
  
  </section>
  
  <section id='error-text'>
  <p><a class='button' href='index.php'>&nbsp;&nbsp; <b>ULANGI LAGI</b> &nbsp;&nbsp;</a></p>
  </section>
  </div>";

}*/
?>

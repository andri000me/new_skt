<?php
session_start();
error_reporting(0);
include "../../config/config.php";
$tgl_sekarang = date("Y-m-d H:i:s");
$tgl = date("d");
$bln = date("m");
$thn = date("Y");

Function getHashEncrypt($str){
  return ($str != "") ? HASH('sha256',($str)) : "";
}
// cari id transaksi terakhir yang berawalan tanggal hari ini

$jam_sekarang = date("H:i:s");
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../config/config.php";
include "../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus users
if ($module=='users' AND $act=='hapus'){
  mysql_query("DELETE FROM users WHERE username='$_GET[username]'");
  header('location:../../users.html');
}

// Input users
elseif ($module=='users' AND $act=='input'){

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
 //$pass=MD5($_POST[password]);
 $username=getHashEncrypt($_POST['username']);
 $pass=getHashEncrypt($_POST['password']);

 $find=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$pass' ");
 $ketemu=mysql_num_rows($find);
// var_dump($ketemu);exit;
 if ($ketemu == 0){
 if (!empty($lokasi_file)){
    UploadUser($nama_file_unik); 
	// $region = isset($_POST['region']) ? implode(',', $_POST['region']) : '';	
    mysql_query("INSERT INTO users(		username,
										password,
										nama_lengkap,
										email,
										no_telp,
										
										level,
										foto,
										id_session
									)
                            VALUES('$username',
                                   '$pass',
								   '$_POST[nama_lengkap]',
								   '$_POST[email]',
								   '$_POST[no_telp]',
								   
								   '$_POST[level]',
                                   '$nama_file_unik',
								   '$pass'
								  )");
  header('location:users.html');
 }else{
	 
	 // $region = isset($_POST['region']) ? implode(',', $_POST['region']) : '';	
	  mysql_query("INSERT INTO users(	username,
										password,
										nama_lengkap,
										email,
										no_telp,
										
										level,
										id_session
									)
                            VALUES('$username',
                                   '$pass',
								   '$_POST[nama_lengkap]',
								   '$_POST[email]',
								   '$_POST[no_telp]',
								   
								   '$_POST[level]',
                                   '$pass'
								  )");
  header('location:users.html'); 
 }
 }
else{
	

   echo "
  <link href='css/betron.css' rel='stylesheet' type='text/css'>";
  echo "
  </head>
  <body class='special-page'>
  <div id='container'>
  <section id='error-number'>
  <img src='images/lock.png'>
  <h1>Username Sudah Ada</h1>
  </section>
  <br><br>
  <section id='error-text'>
  <p><a class='button' href='tambahdata-users.html'>&nbsp;&nbsp; <b>ULANGI LAGI</b> &nbsp;&nbsp;</a></p>
  </section>
  </div> ";
	/*echo "<script language=\"JavaScript\">";
	echo "location.href=\"tambahdata-users-error.html\";";
	echo "</script>";*/

}
}

// Update users
elseif ($module=='users' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
   // Apabila foto tidak diganti

if (empty($lokasi_file)){
//    $region = isset($_POST['region']) ? implode(',', $_POST['region']) : '';	
    mysql_query("UPDATE users SET 
                                   nama_lengkap 			= '$_POST[nama_lengkap]',
                                   email 		 			= '$_POST[email]',
								   no_telp	 				= '$_POST[no_telp]',
								   level  					= '$_POST[level]',
								   -- region  					= '$region',
								   blokir 					= '$_POST[blokir]'
								   
                             WHERE username   				= '$_POST[username]'");


  header('location:users.html');
	}else{
	$data_foto = mysql_query("SELECT foto FROM users WHERE username='$_POST[username]'");
	$r    	= mysql_fetch_array($data_foto);
	@unlink('../../images/user/'.$r['foto']);
	@unlink('../../images/user/'.'small_'.$r['foto']);
    UploadUser($nama_file_unik ,'../images/user/');	
	// $region = isset($_POST['region']) ? implode(',', $_POST['region']) : '';	
	 mysql_query("UPDATE users SET 
                                   nama_lengkap 			= '$_POST[nama_lengkap]',
                                   email 		 			= '$_POST[email]',
								   no_telp	 				= '$_POST[no_telp]',
								   level  					= '$_POST[level]',
								   -- region  					= '$region',
								   foto        				= '$nama_file_unik', 
								   blokir 					= '$_POST[blokir]'
								   
                             WHERE username   				= '$_POST[username]'");
  header('location:users.html');
	}
}elseif ($module=='users' AND $act=='update_pass'){
//	$pass=MD5($_POST[password]);
	$pass=getHashEncrypt($_POST['password']);
	mysql_query("UPDATE users SET 
                                   password 			= '$pass',
								   id_session			= '$pass'
                             WHERE username   				= '$_POST[username]'");
  header('location:users.html');
}
}
?>

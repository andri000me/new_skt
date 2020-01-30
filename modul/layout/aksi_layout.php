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

// Hapus layout
if ($module=='layout' AND $act=='hapus'){
  mysql_query("DELETE FROM layout WHERE username='$_GET[username]'");
  header('location:../../layout.html');
}

// Input layout
elseif ($module=='layout' AND $act=='input'){

  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
 //$pass=MD5($_POST[password]);
 $username=getHashEncrypt($_POST['username']);
 $pass=getHashEncrypt($_POST['password']);

/* $find=mysql_query("SELECT * FROM tbl_icon_layout WHERE username='$username' AND password='$pass' ");
 $ketemu=mysql_num_rows($find);*/
// var_dump($ketemu);exit;
 //if ($ketemu == 0){
 if (!empty($lokasi_file)){
    UploadLayout($nama_file_unik); 
	// $region = isset($_POST['region']) ? implode(',', $_POST['region']) : '';	
    mysql_query("INSERT INTO tbl_icon_layout(nama,
										url,
										level,
										warna,
										gambar,
										
										urut
									)
                            VALUES('$_POST[nama]',
                                   '$_POST[url]',
								   '$_POST[level]',
								   '$_POST[warna]',
								   '$nama_file_unik',
								   
								   '$_POST[urut]'
								  )");
  header('location:layout.html');
 }else{
	 
	 // $region = isset($_POST['region']) ? implode(',', $_POST['region']) : '';	
	  mysql_query("INSERT INTO tbl_icon_layout(	nama,
	  											url,
												level,
												warna,
												urut
									)
                            VALUES(				'$_POST[nama]',
			                                    '$_POST[url]',
											    '$_POST[level]',
											    '$_POST[warna]',
											    '$_POST[urut]'
								  )");
  header('location:layout.html'); 
 }
// }

}

// Update layout
elseif ($module=='layout' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
   // Apabila foto tidak diganti
if (empty($lokasi_file)){
//    $region = isset($_POST['region']) ? implode(',', $_POST['region']) : '';	
    mysql_query("UPDATE tbl_icon_layout SET 
                                   nama 			= '$_POST[nama]',
                                   url 		 		= '$_POST[url]',
								   level	 		= '$_POST[level]',
								   warna	 		= '$_POST[warna]',
								   tampil  			= '$_POST[tampil]',
								   urut 			= '$_POST[urut]'
								   
                             WHERE id   				= '$_POST[id]'");
  header('location:layout.html');
	}else{
	$data_foto = mysql_query("SELECT gambar FROM tbl_icon_layout WHERE id='$_POST[id]'");
	$r    	= mysql_fetch_array($data_foto);
	@unlink('../../img/'.$r['gambar']);
//	@unlink('../../img/'.'small_'.$r['foto']);
     UploadLayout($nama_file_unik ,'../img/');	
	 mysql_query("UPDATE tbl_icon_layout SET 
                                   nama 			= '$_POST[nama]',
                                   url 		 		= '$_POST[url]',
								   level	 		= '$_POST[level]',
								   warna	 		= '$_POST[warna]',
								   tampil  			= '$_POST[tampil]',
								   urut 			= '$_POST[urut]',
								   gambar        	= '$nama_file_unik'
								  
								   
                             WHERE id   				= '$_POST[id]'");
  header('location:layout.html');
	}
}elseif ($module=='layout' AND $act=='aktif'){
  $query1=mysql_query("UPDATE tbl_icon_layout SET tampil='Y' WHERE id='$_GET[id]'");
  header('location:layout.html');
}elseif ($module=='layout' AND $act=='nonaktif'){
  $query1=mysql_query("UPDATE tbl_icon_layout SET tampil='N' WHERE id='$_GET[id]'");
  header('location:layout.html');
}
}
?>

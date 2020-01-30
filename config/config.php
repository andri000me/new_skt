<?php
//date_default_timezone_set("Asia/Bangkok");
date_default_timezone_set('Asia/Jakarta');
/*session_start();
require_once("config/encrypt_decrypt.php");
require_once("config/func_connection.php");
*/

/*$APP_NAME       = "skt";
$dbname="db_skt";
$dbhost="localhost";
$dbroot="eQfZh9120a8880QXR2G7T80S8880o9280uoSO";
$dbpassword="";*/


/*$EnDecryptText  = new EnDecryptText();
$UserId         = $EnDecryptText->Decrypt_Text($dbroot);
$UserPass       = $EnDecryptText->Decrypt_Text($dbpassword);
$con=mysql_connect($dbhost,$UserId,$UserPass);
$db=mysql_select_db($dbname);*/


/*$server =  "simtels.co.id";
$username = "simtelsc";
$password = "simbika.1234567890";
$database = "simtelsc_mms";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");*/

$dbname="db_skt";
$dbhost="localhost";
$dbroot="root";
$dbpassword="";
$con=mysql_connect($dbhost,$dbroot,$dbpassword) or die("Koneksi gagal");
$db=mysql_select_db($dbname) or die("Database tidak bisa dibuka");
?>

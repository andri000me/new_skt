<?PHP
require("config/config.php");
require("config/encrypt_decrypt.php");
date_default_timezone_set("Asia/Bangkok");
$APP_NAME       = "skt";
$dbname="db_skt";
$dbhost="localhost";
$dbroot="eQfZh9120a8880QXR2G7T80S8880o9280uoSO";
$dbpassword="";
global $APP_NAME;


function setConnection(){
  global $dbhost, $dbroot, $dbpassword, $dbname;
  error_reporting(E_ERROR | E_PARSE);
  $EnDecryptText  = new EnDecryptText();
  $UserId         = $EnDecryptText->Decrypt_Text($dbroot);
  $UserPass       = $EnDecryptText->Decrypt_Text($dbpassword);
  $con=mysql_connect($dbhost,$UserId,$UserPass);
  $db=mysql_select_db($dbname);
}
?>
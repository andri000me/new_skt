<?php
session_start();
error_reporting(0);
 include "config/config.php";
  
/*function timer(){
	$time=1000;
	$_SESSION[timeout]=time()+$time;
}
function cek_login(){
	$timeout=$_SESSION[timeout];
	if(time()<$timeout){
		timer();
		return true;
	}else{
		unset($_SESSION[timeout]);
		return false;
	}
}
*/
//fungsi timeout

	function auto_kill_session()
	{
		$inactive = 100000;

		$session_life = time() - $_SESSION['timeout']; 
		if($session_life > $inactive) 
		{
		$jam = date("H:i:s");
		  mysql_query("UPDATE tbl_log SET jamout='$jam',
                              status='offline'
			  WHERE username = '$_SESSION[namalengkap]' AND jamout='logged' AND status='online'");
			  session_destroy();
			  echo "<script>alert('Anda telah keluar dari halaman administrator'); window.location = 'index.html'</script>";
		}
		else
		{
			$_SESSION['timeout']=time();
		}
	}
	
	auto_kill_session();
?>

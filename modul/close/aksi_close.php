<?php 
session_start();
error_reporting(0);
include "../../config/config.php";
$startdate=$_POST['startdate'];
$enddate=$_POST['enddate'];
$jam = date("H:i:s");
$tgl_sekarang = date("Y-m-d H:i:s");
$mulai = date("Y-m-d H:i:s");
$akhir = date("Y-m-d H:i:s");


$startdate2 = date("Y-m-d", strtotime($startdate));
$datestart = new DateTime($startdate2);
$datestart->modify("+". (1) . "day");
$datestartt=$datestart->format('Y-m-d');

$enddate2 = date("Y-m-d", strtotime($enddate));
$dateend = new DateTime($enddate2);
$dateend->modify("+". (1) . "day");
$dateendd=$dateend->format('Y-m-d');
//var_dump($dateendd);exit;

$query=mysql_fetch_array(mysql_query("SELECT fnid,fnStatus FROM txtutup_hari ORDER BY fnid DESC LIMIT 0, 1"));
$status=$query['fnStatus'];

$login=mysql_query("SELECT fnid FROM txtutup_hari ");
$s=mysql_num_rows($login);
// var_dump($ketemu);exit;
if(isset($_POST['startdate']))
	{
		if($s==0){
			 mysql_query("INSERT INTO txtutup_hari(					fdDateFrom,
																	fdDateEnd,
																	fnStatus,
																	ftCreated_User,
																	fdCreated_Date
																		)
															VALUES('$mulai',
																   '$akhir',
																   '1',
																   '$_SESSION[namalengkap]',
																   '$tgl_sekarang'
                                  
								  )");
		}else{
			 mysql_query("UPDATE txtutup_hari SET   fnStatus		= '1',
			 										ftCreated_User	= '$_SESSION[namalengkap]',
													fdCreated_Date	= '$tgl_sekarang'
											WHERE fnid = '$_POST[id]'
											");

			 mysql_query("INSERT INTO txtutup_hari(					fdDateFrom,
																	fdDateEnd,
																	fnStatus,
																	ftCreated_User,
																	fdCreated_Date
																		)
															VALUES('$dateendd $jam',
																   '$dateendd $jam',
																   '0',
																   '$_SESSION[namalengkap]',
																   '$tgl_sekarang'
                                  
								  )");
		 }
  header('location:../../home.html'); 
}
?>

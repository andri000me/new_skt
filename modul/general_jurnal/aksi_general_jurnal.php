<?php 
session_start();
error_reporting(0);
include "../../config/config.php";
$tgl_sekarang = date("Y-m-d H:i:s");
$tgl = date("d");
$bln = date("m");
$thn = date("Y");
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
$idf=$_POST[idf];

// Hapus nasabah
if ($module=='general_jurnal' AND $act=='delete'){
  $sql="SELECT ftNoJurnal FROM txjurnalumum WHERE fnid='$_GET[fnid]'";
  $result=mysql_query($sql);
  $r=mysql_fetch_array($result);
  $ftNoJurnal=$r['ftNoJurnal'];	
  mysql_query("DELETE FROM txjurnalumumdetail WHERE ftNoJurnal = '$ftNoJurnal'");	
  mysql_query("DELETE FROM txjurnalumum WHERE fnid='$_GET[fnid]'");
  echo json_encode(array('ok' => true, 'msg' => '<div class="text-green"><i class="fa fa-check"></i> Data berhasil di delete </div>'));
//  header('location:general-jurnal.html');
}

// Input nasabah
elseif ($module=='general_jurnal' AND $act=='input'){
	  $debit=$_POST['ftDebit'];
	  $kredit=$_POST['ftKredit'];
 	  $debit_sum=(array_sum($debit)); 
 	  $kredit_sum=(array_sum($kredit)); 
	//  $print_r($debit_sum);
	//  $print_r($kredit_sum);
 	//  var_dump($debit_sum);var_dump($kredit_sum); exit;
	  mysql_query("INSERT INTO txjurnalumum(	ftNoJurnal,
												fdTglJurnal,
												ftNobukti,
												ftNotes,
												fcDebit,
												fcKredit,
												ftCreated_User,
												fdCreated_date
									)
										VALUES('$_POST[ftNoJurnal]',
											   '$_POST[fdTglJurnal]',
											   '$_POST[ftNobukti]',
											   '$_POST[ftNotes]',
											   '$debit_sum',
											   '$kredit_sum',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
                                  
								  )");
	
	//    print_r($_POST);
	     $no1 = 0;
		foreach($_POST['ftKodePerkiraan'] as $row =>$ftKodePerkiraan)
		{ $ftNoJurnal 			   = $_POST['ftNoJurnal'];	
		  $ftKodePerkiraan         = $_POST['ftKodePerkiraan'][$row];
	      $ftNamaPerkiraan         = $_POST['ftNamaPerkiraan'][$row];
	      $ftDebit         		   = $_POST['ftDebit'][$row];
	      $ftKredit         	   = $_POST['ftKredit'][$row];
	      $no1++;
		$query_row[] = "('$ftNoJurnal','$ftKodePerkiraan','$ftNamaPerkiraan','$ftDebit', '$ftKredit','$no1')";

		}
		/*$q= "INSERT INTO txjurnalumumdetail(ftKodePerkiraan, ftNamaPerkiraan, ftDebit, ftKredit) VALUES " . implode(',',$query_row); 
		mysql_query($q);*/
		mysql_query("INSERT INTO txjurnalumumdetail(ftNoJurnal,ftKodePerkiraan, ftNamaPerkiraan, ftDebit, ftKredit,fnIndex) VALUES " . implode(',',$query_row));
		
  header('location:general-jurnal.html'); 

}
// Input Rincian Ketika Edit
elseif ($module=='general_jurnal' AND $act=='createrincian'){
	if(str_replace(',', '', $_POST[ftDebit]) <= 0) {
			$res=false;
			$msg='<div class="text-red"><i class="fa fa-ban"></i> Gagal menyimpan data, pastikan nilai debet lebih dari <strong>0 (NOL)</strong>. </div>';
	}elseif(str_replace(',', '', $_POST[ftKredit]) <= 0) {
			$res=false;
			$msg='<div class="text-red"><i class="fa fa-ban"></i> Gagal menyimpan data, pastikan nilai kredit lebih dari <strong>0 (NOL)</strong>. </div>';
	}else{
 	  mysql_query("INSERT INTO txjurnalumumdetail(ftNoJurnal,
												ftKodePerkiraan,
												ftNamaPerkiraan,
												ftDebit,
												ftKredit									)
										VALUES('$_GET[ftNoJurnal]',
											   '$_POST[ftKodePerkiraan]',
											   '$_POST[ftNamaPerkiraan]',
											   '$_POST[ftDebit]',
											   '$_POST[ftKredit]'
								  )");
		$sql="SELECT SUM(ftdebit) AS sumdebit,SUM(ftkredit) AS sumkredit FROM txjurnalumumdetail WHERE ftNoJurnal='$_GET[ftNoJurnal]'";
		$result=mysql_query($sql);
		$r=mysql_fetch_array($result);
		$sumdebit=$r['sumdebit'];$sumkredit=$r['sumkredit'];	
		mysql_query("UPDATE txjurnalumum SET fcDebit ='$sumdebit',fcKredit ='$sumkredit' WHERE ftNoJurnal = '$_GET[ftNoJurnal]'");	
		$res=true;	
		$msg='<div class="text-green"><i class="fa fa-check"></i> Data berhasil disimpan </div>';
	}						  
  echo json_encode(array('ok' => $res, 'msg' => $msg));

}
// Update rincian ketika edit
elseif ($module=='general_jurnal' AND $act=='updaterincian'){
	$ftDebit=str_replace(',', '', $_POST[ftDebit]);
	$ftKredit=str_replace(',', '', $_POST[ftKredit]);
	
	if(str_replace(',', '', $_POST[ftDebit]) <= 0) {
			$res=false;
			$msg='<div class="text-red"><i class="fa fa-ban"></i> Gagal menyimpan data, pastikan nilai debet lebih dari <strong>0 (NOL)</strong>. </div>';
	}elseif(str_replace(',', '', $_POST[ftKredit]) <= 0) {
			$res=false;
			$msg='<div class="text-red"><i class="fa fa-ban"></i> Gagal menyimpan data, pastikan nilai kredit lebih dari <strong>0 (NOL)</strong>. </div>';
	}else{
  	    mysql_query("UPDATE txjurnalumumdetail SET 
                                   ftKodePerkiraan 	= '$_POST[ftKodePerkiraan]',
                                   ftNamaPerkiraan 	= '$_POST[ftNamaPerkiraan]',
								   ftDebit 		 	= '$ftDebit',
								   ftKredit  		= '$ftKredit'
								   WHERE fnid   	= '$_GET[fnid]'");
		$sql="SELECT SUM(ftdebit) AS sumdebit,SUM(ftkredit) AS sumkredit FROM txjurnalumumdetail WHERE ftNoJurnal='$_GET[ftNoJurnal]'";
		$result=mysql_query($sql);
		$r=mysql_fetch_array($result);
		$sumdebit=$r['sumdebit'];$sumkredit=$r['sumkredit'];	
		mysql_query("UPDATE txjurnalumum SET fcDebit ='$sumdebit', fcKredit	='$sumkredit' WHERE ftNoJurnal = '$_GET[ftNoJurnal]'");			   
		$res=true;	
		$msg='<div class="text-green"><i class="fa fa-check"></i> Data berhasil disimpan </div>';
	}						  
  echo json_encode(array('ok' => $res, 'msg' => $msg));
	
}
// Delete rincian ketika edit
if ($module=='general_jurnal' AND $act=='deleterincian'){
  mysql_query("DELETE FROM txjurnalumumdetail WHERE fnid='$_GET[fnid]'");
  $sql="SELECT SUM(ftdebit) AS sumdebit,SUM(ftkredit) AS sumkredit FROM txjurnalumumdetail WHERE ftNoJurnal='$_GET[ftNoJurnal]'";
		$result=mysql_query($sql);
		$r=mysql_fetch_array($result);
		$sumdebit=$r['sumdebit'];$sumkredit=$r['sumkredit'];	
		mysql_query("UPDATE txjurnalumum SET fcDebit ='$sumdebit',fcKredit	='$sumkredit' WHERE ftNoJurnal = '$_GET[ftNoJurnal]'");	
  echo json_encode(array('ok' => true, 'msg' => '<div class="text-green"><i class="fa fa-check"></i> Data berhasil disimpan </div>'));
}
// Update jurnal
elseif ($module=='general_jurnal' AND $act=='update'){
	$sql="SELECT SUM(ftdebit) AS sumdebit,SUM(ftkredit) AS sumkredit FROM txjurnalumumdetail WHERE ftNoJurnal='$_POST[ftNoJurnal]'";
    $result=mysql_query($sql);
	$r=mysql_fetch_array($result);
	$sumdebit=$r['sumdebit'];
	$sumkredit=$r['sumkredit'];
	//print_r($sumkredit);
	 mysql_query("UPDATE txjurnalumum SET 
                                   fdTglJurnal 			= '$_POST[fdTglJurnal]',
								   ftNobukti 			= '$_POST[ftNobukti]',
                                   fcDebit				='$sumdebit',
								   fcKredit				='$sumkredit',
								   ftNotes	 		    = '$_POST[ftNotes]',
								   fnStatus	 			= '1',
								   ftModified_User  	= '$_SESSION[namalengkap]',
								   fdModified_Date  	= '$tgl_sekarang'
	                               WHERE fnid   		= '$_POST[fnid]'");
  header('location:general-jurnal.html');
	
}// Get data jurnal
elseif ($module=='general_jurnal' AND $act=='getdatajurnal'){
$getId =$_GET[id];

 $getField = isset($_POST['getField']) ? $_POST['getField'] : '';
 $search_jurnal = isset($_POST['search_jurnal']) ? $_POST['search_jurnal'] : '';
 $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
 $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
 $sort  = isset($_POST['sort']) ? $_POST['sort'] : 'tgl_transaksi';
 $order  = isset($_POST['order']) ? $_POST['order'] : 'desc'; 
 $offset = ($offset-1)*$limit;
 $sql="select * from txjurnalumum where 1=1 ";
 if($search_jurnal != '') {
				$sql .=" AND ($getField LIKE '%".$search_jurnal."%') ";
			}
 //var_dump($sql);			
  $result=mysql_query($sql);
  $sql .=" ORDER BY $sort $order ";
  $sql .=" LIMIT {$offset},{$limit} ";	
  $count=mysql_num_rows($result);	
  $i	= 0;
  $rows   = array(); 
  $result2=mysql_query($sql);
	  while($r=mysql_fetch_array($result2)){
		$jml_ftDebit += $r[ftDebit];  
		$jml_ftKredit += $r[ftKredit]; 
		$rows[$i]['fnid'] = $r[fnid];
		$rows[$i]['ftNoJurnal'] = $r[ftNoJurnal];
		$rows[$i]['fdTglJurnal'] = $r[fdTglJurnal];	
		$rows[$i]['ftNobukti'] = $r[ftNobukti];
		$rows[$i]['ftNotes'] = $r[ftNotes];
		$rows[$i]['fcDebit'] = number_format($r[fcDebit]);
		$rows[$i]['fcKredit'] = number_format($r[fcKredit]);
		$i++;
	  }
	   $row   = array('fnid'=>0,'ftNoJurnal'=>0,'ftKodePerkiraan'=>0,'ftNamaPerkiraan'=>0,'ftDebit'=>$jml_ftDebit,'ftKredit'=>$jml_ftKredit,);
	 
  $result = array('total'=>$count,'rows'=>$rows,'footer'=>$row);
  echo json_encode($result);
}//get data jurnal detail
elseif ($module=='general_jurnal' AND $act=='getdata'){
$getId =$_GET[id];
//print_r($getId); 	
 $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
 $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
 $sort  = isset($_POST['sort']) ? $_POST['sort'] : 'tgl_transaksi';
 $order  = isset($_POST['order']) ? $_POST['order'] : 'desc'; 
 $offset = ($offset-1)*$limit;
 $sql="select a.* from txjurnalumumdetail a where a.ftNoJurnal='$getId' ";
 // print_r($sql);
  $result=mysql_query($sql);
  $sql .=" ORDER BY $sort $order ";
  $sql .=" LIMIT {$offset},{$limit} ";	
  $count=mysql_num_rows($result);	
  $i	= 0;
  $rows   = array(); 
  $result2=mysql_query($sql);
	  while($r=mysql_fetch_array($result2)){
		$jml_ftDebit += $r[ftDebit];  
		$jml_ftKredit += $r[ftKredit]; 
		$rows[$i]['fnid'] = $r[fnid];
		$rows[$i]['ftNoJurnal'] = $r[ftNoJurnal];
		$rows[$i]['ftKodePerkiraan'] = $r[ftKodePerkiraan];	
		$rows[$i]['ftNamaPerkiraan'] = $r[ftNamaPerkiraan];
		$rows[$i]['ftDebit'] = number_format($r[ftDebit]);
		$rows[$i]['ftKredit'] = number_format($r[ftKredit]);
		$i++;
	  }
	   $row   = array('fnid'=>0,'ftNoJurnal'=>0,'ftKodePerkiraan'=>0,'ftNamaPerkiraan'=>0,'ftDebit'=>$jml_ftDebit,'ftKredit'=>$jml_ftKredit,);
	 
  $result = array('total'=>$count,'rows'=>$rows,'footer'=>$row);
  echo json_encode($result);
}
// Get Data Nama Perkiraan
elseif ($module=='general_jurnal' AND $act=='getDataPerkiraan'){
  $ftKodePerkiraan=$_POST['ftKodePerkiraan'];	
  $sql="select * FROM tlnoperkiraan WHERE ftKodePerkiraan='".$ftKodePerkiraan."' and fnStatus=1";
  $result=mysql_fetch_array(mysql_query($sql));
  $NamaPerkiraan=$result['ftNamaPerkiraan'];
  echo $NamaPerkiraan;
}
}
?>

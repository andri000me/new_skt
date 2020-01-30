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
//include "../../config/config.php";
include "../../config/fungsi_thumb.php";

$module=$_GET[module];
$act=$_GET[act];
$id=$_GET[id];

// Hapus tipe
if ($module=='transaksi_kas' AND $act=='delete'){
  mysql_query("DELETE FROM tbl_trans_kas WHERE id='$id'");
  echo json_encode(array('ok' => true, 'msg' => '<div class="text-green"><i class="fa fa-check"></i> Data berhasil disimpan </div>'));
}
// Get data transaksi kas
elseif ($module=='transaksi_kas' AND $act=='getdata'){
 $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
 $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
 $sort  = isset($_POST['sort']) ? $_POST['sort'] : 'tgl_transaksi';
 $order  = isset($_POST['order']) ? $_POST['order'] : 'desc'; 
 $kode_transaksi = isset($_POST['kode_transaksi']) ? $_POST['kode_transaksi'] : '';
 $tgl_dari = isset($_POST['tgl_dari']) ? $_POST['tgl_dari'] : '';
 $tgl_sampai = isset($_POST['tgl_sampai']) ? $_POST['tgl_sampai'] : '';
 $tgl_dari2   =   date("Y-m-d", strtotime($tgl_dari));
 $tgl_sampai2   =   date("Y-m-d", strtotime($tgl_sampai));
 $q = array('kode_transaksi' => $kode_transaksi,'tgl_dari' => $tgl_dari2,'tgl_sampai' => $tgl_sampai2);
 $offset = ($offset-1)*$limit;
 $sql="select a.*,b.ftKodePerkiraan,b.ftNamaPerkiraan, 
					   CASE a.untuk_kas_id 
						WHEN 1 THEN 'Kas Tunai'
						WHEN 2 THEN 'Kas Besar'
						WHEN 3 THEN 'Kas BNI'
					   END 	untuk_kas	
					   from tbl_trans_kas a
					   left join tlnoperkiraan b on a.ftKodePerkiraan=b.ftKodePerkiraan where a.akun='Pemasukan' ";
  if(is_array($q)) {
			if($q['kode_transaksi'] != '') {
				$q['kode_transaksi'] = str_replace('TKD', '', $q['kode_transaksi']);
				$q['kode_transaksi'] = $q['kode_transaksi'] * 1;
				$sql .=" AND a.id LIKE '".$q['kode_transaksi']."'";
			} else {
				if($q['tgl_dari'] != '1970-01-01' && $q['tgl_sampai'] != '1970-01-01') {
					$sql .=" AND DATE(a.tgl_catat) >= '".$q['tgl_dari']."' ";
					$sql .=" AND DATE(a.tgl_catat) <= '".$q['tgl_sampai']."' ";
				}
			}
		}
  $result=mysql_query($sql);
  $sql .=" ORDER BY $sort $order ";
  $sql .=" LIMIT {$offset},{$limit} ";	
  $count=mysql_num_rows($result);	
  $i	= 0;
  $rows   = array(); 
  $result2=mysql_query($sql);
	  while($r=mysql_fetch_array($result2)){
		$rows[$i]['id'] = $r[id];
		$rows[$i]['id_txt'] ='TKD' . sprintf('%05d', $r[id]) . '';
		$rows[$i]['tgl_transaksi'] = $r[tgl_catat];
		$rows[$i]['tgl_transaksi_txt'] = $r[tgl_catat];	
		$rows[$i]['ket'] = $r[keterangan];
		$rows[$i]['jumlah'] = number_format($r[jumlah]);
		$rows[$i]['user'] = $r[user_name];
		$rows[$i]['kas_id'] = $r[untuk_kas_id];
		$rows[$i]['kas_id_txt'] = $r[untuk_kas];
		$rows[$i]['akun_id'] = $r[ftKodePerkiraan];
		$rows[$i]['akun_id_txt'] = $r[ftNamaPerkiraan];
		
		$i++;
	  }
  echo $id;
  $result = array('total'=>$count,'rows'=>$rows);
  echo json_encode($result);
}

// Input Transaksi Kas
elseif ($module=='transaksi_kas' AND $act=='create'){
 if(str_replace(',', '', $_POST[jumlah]) <= 0) {
			$res=false;
			$msg='<div class="text-red"><i class="fa fa-ban"></i> Gagal menyimpan data, pastikan nilai lebih dari <strong>0 (NOL)</strong>. </div>';
	}else{
	  mysql_query("INSERT INTO tbl_trans_kas(	tgl_catat,
												jumlah,
												keterangan,
												dk,
												akun,
												untuk_kas_id,
												ftKodePerkiraan,
												user_name,
												update_data
									)
										VALUES('$_POST[tgl_transaksi]',
											   '$_POST[jumlah]',
											   '$_POST[ket]',
											   'D',
											   'Pemasukan',
											   '$_POST[kas_id]',
											   '$_POST[akun_id]',
											   '$_SESSION[namalengkap]',
											   '$tgl_sekarang'
								  )");
		$res=true;	
		$msg='<div class="text-green"><i class="fa fa-check"></i> Data berhasil disimpan </div>';
	}						  
  echo json_encode(array('ok' => $res, 'msg' => $msg));

}

// Update Transaksi Kas
elseif ($module=='transaksi_kas' AND $act=='update'){
	if(str_replace(',', '', $_POST[jumlah]) <= 0) {
			$res=false;
			$msg='<div class="text-red"><i class="fa fa-ban"></i> Gagal menyimpan data, pastikan nilai lebih dari <strong>0 (NOL)</strong>. </div>';
	}else{
	 mysql_query("UPDATE tbl_trans_kas SET 
                                   tgl_catat 			= '$_POST[tgl_transaksi]',
                                   jumlah 		 		= '$_POST[jumlah]',
								   keterangan	 		= '$_POST[ket]',
								   untuk_kas_id	 		= '$_POST[kas_id]',
								   ftKodePerkiraan  	= '$_POST[akun_id]',
								   user_name  			= '$_SESSION[namalengkap]',
								   update_data  		= '$tgl_sekarang'
								   WHERE id   			= '$id'");
		$res=true;	
		$msg='<div class="text-green"><i class="fa fa-check"></i> Data berhasil disimpan </div>';
	}						  
  echo json_encode(array('ok' => $res, 'msg' => $msg));
	
}elseif ($module=='transaksi_kas' AND $act=='cetak'){
	    include "../../pdf/pdf.php";
		include "../../config/fungsi_indotgl.php";
	    $tgl_dari =  date("Y-m-d", strtotime($_REQUEST['tgl_dari'])); 
		$tgl_sampai = date("Y-m-d", strtotime($_REQUEST['tgl_sampai'])); 
		if ($tgl_dari != '1970-01-01'){
			$header="<span> Periode ".tgl_indo_true($tgl_dari)." - ".tgl_indo_true($tgl_sampai)."</span>";
		}else{
			$header="<span>All Periode</span>";
		}
		//var_dump($tgl_dari);exit;
		$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->set_nsi_header(TRUE);
		$pdf->AddPage('L');
		$html = '';
		$html .= '
		<style>
			.h_tengah {text-align: center;}
			.h_kiri {text-align: left;}
			.h_kanan {text-align: right;}
			.txt_judul {font-size: 12pt; font-weight: bold; padding-bottom: 12px;}
			.header_kolom {background-color: #cccccc; text-align: center; font-weight: bold;}
			.txt_content {font-size: 10pt; font-style: arial;}
		</style>
			'.$pdf->nsi_box($text = '<span class="txt_judul">Laporan Data Pemasukan Kas<br> </span>
			'.$header
			, $width = '100%', $spacing = '0', $padding = '1', $border = '0', $align = 'center').'

		<table width="100%" cellspacing="0" cellpadding="3" border="1" border-collapse= "collapse">
		<tr class="header_kolom">
			<th class="h_tengah" style="width:5%;" > No. </th>
			<th class="h_tengah" style="width:10%;"> No Transaksi</th>
			<th class="h_tengah" style="width:15%;"> Tanggal </th>
			<th class="h_tengah" style="width:40%;"> Uraian  </th>
			<th class="h_tengah" style="width:20%;"> Jumlah  </th>
			<th class="h_tengah" style="width:10%;"> User </th>
		</tr>';

		$no =1;
		$jml_tot = 0;
		$sql="select a.* from tbl_trans_kas a where a.akun='pemasukan' ";
		if($tgl_dari != '1970-01-01'){
			$sql .=" AND DATE(a.tgl_catat) >= '".$tgl_dari."' ";
			$sql .=" AND DATE(a.tgl_catat) <= '".$tgl_sampai."' ";
		}			   
		$result= mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			
			$tgl_bayar = explode(' ', $row[tgl_catat]);
			$txt_tanggal = date("d-M-Y", strtotime($row[tgl_catat]));
			$txt_tanggal2 =tgl_indo_true($txt_tanggal);
			$jml_tot += $row[jumlah];
			$html .= '
			<tr>
				<td class="h_tengah" >'.$no++.'</td>
				<td class="h_tengah"> '.'TKD'.sprintf('%05d', $row[id]).'</td>
				<td class="h_tengah"> '.$txt_tanggal.'</td>
				<td class="h_kiri"> '.$row[keterangan].'</td>
				<td class="h_kanan"> '.number_format($row[jumlah]).'</td>
				<td> '.$row[user_name].'</td>
			</tr>';
		}
		$html .= '
			<tr>
				<td colspan="4" class="h_tengah"><strong> Jumlah Total </strong></td>
				<td class="h_kanan"> <strong>'.number_format($jml_tot).'</strong></td>

			</tr>
		</table>';
		$pdf->nsi_html($html);
		$pdf->Output('trans_d'.date('Ymd_His') . '.pdf', 'I');
}
}
?>

<?php
session_start();
error_reporting(0);
include "../../config/config.php";
include "../../config/fungsi_indotgl.php";

$tgl_sekarang = date("Y-m-d H:i:s");
$tanggal_u = date('Y-m-d H:i');
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
if ($module=='setoran_tunai' AND $act=='delete'){
  mysql_query("DELETE FROM tbl_trans_sp WHERE id='$id'");
  echo json_encode(array('ok' => true, 'msg' => '<div class="text-green"><i class="fa fa-check"></i> Data berhasil disimpan </div>'));
}
// Get Data Jenis Simpanan
elseif ($module=='setoran_tunai' AND $act=='getDataJenis'){
  $jenis_id=$_POST['jenis_id'];	
  $sql="select * FROM jns_simpan WHERE id='".$jenis_id."' and tampil='Y'";
  $result=mysql_fetch_array(mysql_query($sql));
  $jum=$result['jumlah'];
  echo $jum;
}
// Get Data Anggota
elseif ($module=='setoran_tunai' AND $act=='getDataAnggota'){
  $q=$_POST['q'];
  $kel=$_GET['kel'];  
 // var_dump($kel);exit;
  $sql="select fnId,ftNamaNasabah,ftAlamat,ftJabatan,ftNamaKelompok FROM tlnasabah WHERE ftNamaNasabah like '%".$q."%' and ftNamaKelompok='$kel'";
  $i	= 0;
  $rows   = array(); 
  $result2=mysql_query($sql);
 while($r=mysql_fetch_array($result2)){
		$rows[$i]['id'] = $r[fnId];
		$rows[$i]['kode_anggota'] = 'AG'.sprintf('%04d', $r[fnId]) . '<br>' . $r[ftJabatan];
		$rows[$i]['nama'] = $r[ftNamaNasabah];
		//$rows[$i]['kota'] = $r[ftAlamat];	
		$i++;
	  }
  $result = array('rows'=>$rows);
  echo json_encode($result);
}

elseif ($module=='setoran_tunai' AND $act=='getDataAnggota_id'){
  $q=$_POST['q'];
  $anggota=$_GET['anggota'];  
 // var_dump($anggota);exit;
  $sql="select fnId,ftNamaNasabah,ftAlamat,ftJabatan,ftNamaKelompok FROM tlnasabah WHERE fnId='$anggota'";
  $i	= 0;
  $rows   = array(); 
  $result2=mysql_query($sql);
 while($r=mysql_fetch_array($result2)){
		$rows[$i]['id'] = $r[fnId];
		$rows[$i]['kode_anggota'] = 'AG'.sprintf('%04d', $r[fnId]) . '<br>' . $r[ftJabatan];
		$rows[$i]['nama'] = $r[ftNamaNasabah];
		//$rows[$i]['kota'] = $r[ftAlamat];	
		$i++;
	  }
  $result = array('rows'=>$rows);
  echo json_encode($result);
}
// Get data Setoran Tunai
elseif ($module=='setoran_tunai' AND $act=='getdata'){
 $offset = isset($_POST['page']) ? intval($_POST['page']) : 1;
 $limit  = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
 $sort  = isset($_POST['sort']) ? $_POST['sort'] : 'tgl_transaksi';
 $order  = isset($_POST['order']) ? $_POST['order'] : 'desc'; 
 $kode_transaksi = isset($_POST['kode_transaksi']) ? $_POST['kode_transaksi'] : '';
 $cari_simpanan = isset($_REQUEST['cari_simpanan']) ? $_REQUEST['cari_simpanan'] : '';
 $tgl_dari = isset($_POST['tgl_dari']) ? $_POST['tgl_dari'] : '';
 $tgl_sampai = isset($_POST['tgl_sampai']) ? $_POST['tgl_sampai'] : '';
 $tgl_dari2   =   date("Y-m-d", strtotime($tgl_dari));
 $tgl_sampai2   =   date("Y-m-d", strtotime($tgl_sampai));
 $q = array('kode_transaksi' => $kode_transaksi,'cari_simpanan' => $cari_simpanan,'tgl_dari' => $tgl_dari2,'tgl_sampai' => $tgl_sampai2);
 $offset = ($offset-1)*$limit;
 $sql="SELECT a.*,b.jns_simpan,c.nama,d.ftNamaNasabah,d.ftJabatan FROM tbl_trans_sp a 
	   left join jns_simpan b on a.jenis_id=b.id
	   left join nama_kas_tbl c on a.kas_id=c.id 
	   left join tlnasabah d on a.anggota_id=d.fnId
	   WHERE a.dk='D' ";
  if(is_array($q)) {
			if($q['kode_transaksi'] != '') {
				$q['kode_transaksi'] = str_replace('TRD', '', $q['kode_transaksi']);
				$q['kode_transaksi'] = str_replace('AG', '', $q['kode_transaksi']);
				$q['kode_transaksi'] = $q['kode_transaksi'] * 1;
				$sql .=" AND (a.id LIKE '".$q['kode_transaksi']."' OR anggota_id LIKE '".$q['kode_transaksi']."') ";
			} else {
				if($q['cari_simpanan'] != '') {
					$sql .=" AND jenis_id = '".$q['cari_simpanan']."%' ";
				}
				if($q['tgl_dari'] != '1970-01-01' && $q['tgl_sampai'] != '1970-01-01') {
					$sql .=" AND DATE(a.tgl_transaksi) >= '".$q['tgl_dari']."' ";
					$sql .=" AND DATE(a.tgl_transaksi) <= '".$q['tgl_sampai']."' ";
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
		$tgl_bayar = explode(' ', $r[tgl_transaksi]);
		$txt_tanggal = tgl_indo_true($tgl_bayar[0]);
		$txt_tanggal .= ' - ' . substr($tgl_bayar[1], 0, 5);	  
		$rows[$i]['id'] = $r[id];
		$rows[$i]['id_txt'] ='TRK' . sprintf('%05d', $r[id]) . '';
		$rows[$i]['tgl_transaksi'] = $r[tgl_transaksi];
		$rows[$i]['tgl_transaksi_txt'] = $txt_tanggal;
		$rows[$i]['anggota_id'] = $r[anggota_id];
		$rows[$i]['anggota_id_txt'] = $r[ftNamaNasabah];
		$rows[$i]['nama'] = $r[ftNamaNasabah];
		$rows[$i]['kas_id'] = $r[kas_id];
		$rows[$i]['kas_id_txt'] = $r[nama];
		$rows[$i]['jenis_id'] = $r[jenis_id];
		$rows[$i]['jenis_id_txt'] =$r[jns_simpan];
		$rows[$i]['jumlah'] = number_format($r[jumlah]);
		$rows[$i]['ket'] = $r[keterangan];
		$rows[$i]['user'] = $r[user_name];
		$rows[$i]['kas_id'] = $r[kas_id];
		$rows[$i]['nama_penyetor'] = $r[nama_penyetor];
		$rows[$i]['no_identitas'] = $r[no_identitas];
		$rows[$i]['alamat'] = $r[alamat];
		$rows[$i]['wilayah'] = $r[wilayah];
		$rows[$i]['ftKodeKelompok'] = $r[ftKodeKelompok];
		$rows[$i]['nota'] = '<p></p><p>
		<a href="'.'modul/simpanan/aksi_setoran_tunai.php?module=setoran_tunai&act=cetak_simpanan&id_simpan='.$r[id].'" title="Cetak Bukti Transaksi" target="_blank"> <i class="glyphicon glyphicon-print"></i> Nota </a></p>';
		
		$i++;
	  }
  echo $id;
  $result = array('total'=>$count,'rows'=>$rows);
  echo json_encode($result);
}

// Input Setoran Tunai
elseif ($module=='setoran_tunai' AND $act=='create'){
	if(str_replace(',', '', $_POST[jumlah]) <= 0) {
			$res=false;
			$msg='<div class="text-red"><i class="fa fa-ban"></i> Gagal menyimpan data, pastikan nilai lebih dari <strong>0 (NOL)</strong>. </div>';
	}else{
 	  mysql_query("INSERT INTO tbl_trans_sp(	tgl_transaksi,
												anggota_id,
												jenis_id,
												jumlah,
												keterangan,
												akun,
												dk,
												kas_id,
												user_name,
												nama_penyetor,
												no_identitas,
												alamat,
												wilayah,
												ftKodeKelompok
									)
										VALUES('$_POST[tgl_transaksi]',
											   '$_POST[anggota_id]',
											   '$_POST[jenis_id]',
											   '$_POST[jumlah]',
											   '$_POST[ket]',
											   'Setoran',
											   'D',
											   '$_POST[kas_id]',
											   '$_SESSION[namalengkap]',
											   '$_POST[nama_penyetor]',
											   '$_POST[no_identitas]',
											   '$_POST[alamat]',
											   '$_POST[wilayah]',
											   '$_POST[ftKodeKelompok]'
								  )");
		$res=true;	
		$msg='<div class="text-green"><i class="fa fa-check"></i> Data berhasil disimpan </div>';
	}						  
  echo json_encode(array('ok' => $res, 'msg' => $msg));

}

// Update Setoran Tunai
elseif ($module=='setoran_tunai' AND $act=='update'){
	$jum=str_replace(',', '', $_POST[jumlah]);
	if(str_replace(',', '', $_POST[jumlah]) <= 0) {
			$res=false;
			$msg='<div class="text-red"><i class="fa fa-ban"></i> Gagal menyimpan data, pastikan nilai lebih dari <strong>0 (NOL)</strong>. </div>';
	}else{
  	 mysql_query("UPDATE tbl_trans_sp SET 
                                   tgl_transaksi 	= '$_POST[tgl_transaksi]',
                                   jenis_id 		= '$_POST[jenis_id]',
								   jumlah 		 	= '$jum',
								   keterangan	 	= '$_POST[ket]',
								   no_identitas	 	= '$_POST[no_identitas]',
								   kas_id	 		= '$_POST[kas_id]',
								   update_data  	= '$tanggal_u',
								   user_name  		= '$_SESSION[namalengkap]',
								   nama_penyetor  	= '$_POST[nama_penyetor]',
								   alamat  			= '$_POST[alamat]'
								   WHERE id   		= '$id'");
		$res=true;	
		$msg='<div class="text-green"><i class="fa fa-check"></i> Data berhasil disimpan </div>';
	}						  
  echo json_encode(array('ok' => $res, 'msg' => $msg));
	
}elseif ($module=='setoran_tunai' AND $act=='cetak'){
	    include "../../pdf/pdf.php";
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
			<th class="h_tengah" style="width:8%;"> No Transaksi</th>
			<th class="h_tengah" style="width:11%;"> Tanggal </th>
			<th class="h_tengah" style="width:35%;"> Nama Anggota </th>
			<th class="h_tengah" style="width:18%;"> Jenis Simpanan </th>
			<th class="h_tengah" style="width:13%;"> Jumlah  </th>
			<th class="h_tengah" style="width:10%;"> User </th>
		</tr>';

		$no =1;
		$jml_tot = 0;
		$sql="SELECT a.*,b.jns_simpan,b.jumlah,c.nama,d.ftNamaNasabah,d.ftJabatan FROM tbl_trans_sp a 
			   left join jns_simpan b on a.jenis_id=b.id
			   left join nama_kas_tbl c on a.kas_id=c.id 
			   left join tlnasabah d on a.anggota_id=d.fnId
			   WHERE a.dk='D'";
		if($tgl_dari != '1970-01-01'){
			$sql .=" AND DATE(a.tgl_transaksi) >= '".$tgl_dari."' ";
			$sql .=" AND DATE(a.tgl_transaksi) <= '".$tgl_sampai."' ";
		}			 
	
		$result= mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			
			$tgl_bayar = explode(' ', $row[tgl_transaksi]);
			$txt_tanggal = date("d-M-Y", strtotime($row[tgl_transaksi]));
			$txt_tanggal2 =tgl_indo_true($txt_tanggal);
			$jml_tot += $row[jumlah];
			$html .= '
			<tr>
			<td class="h_tengah" >'.$no++.'</td>
				<td class="h_tengah"> '.'TRD'.sprintf('%05d', $row[id]).'</td>
				<td class="h_tengah"> '.$txt_tanggal.'</td>
				<td class="h_kiri"> '.$row[ftNamaNasabah].'</td>
				<td> '.$row[jns_simpan].'</td>
				<td class="h_kanan"> '.number_format($row[jumlah]).'</td>
				<td> '.$row[user_name].'</td>
			</tr>';
		}
		$html .= '
			<tr>
				<td colspan="6" class="h_tengah"><strong> Jumlah Total </strong></td>
				<td class="h_kanan"> <strong>'.number_format($jml_tot).'</strong></td>

			</tr>
		</table>';
		$pdf->nsi_html($html);
		$pdf->Output('trans_sp'.date('Ymd_His') . '.pdf', 'I');
}elseif ($module=='setoran_tunai' AND $act=='cetak_simpanan'){
	    include "../../pdf/struk.php";
		include "../../config/Terbilang.php";
		$id_simpan =$_GET["id_simpan"];
		$terb= new Terbilang();
		$pdf = new Struk('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->set_nsi_header(false);
		$resolution = array(210, 95);
		$pdf->AddPage('L', $resolution);
		$html = '';
		$html .= '
		<style>
			.h_tengah {text-align: center;}
			.h_kiri {text-align: left;}
			.h_kanan {text-align: right;}
			.txt_judul {font-size: 12pt; font-weight: bold; padding-bottom: 12px;}
			.header_kolom {background-color: #cccccc; text-align: center; font-weight: bold;}
			.txt_content {font-size: 7pt; text-align: center;}
		</style>';
		$company_info= mysql_query("select * from tscompany_info where aktif='Y'");
		$out=mysql_fetch_array($company_info);
		$html .= ''.$pdf->nsi_box($text =' <table width="100%">
			<tr>
				<td colspan="2" class="h_kanan"><strong>'.$out['ftCompany_Name'].'</strong></td>
			</tr>
			<tr>
				<td width="20%"><strong>BUKTI SETORAN TUNAI</strong>
					<hr width="100%">
				</td>
				<td class="h_kanan" width="80%">'.$out['ftCompany_Address'].' - '.$out['ftCity'].'</td>
			</tr>
		</table>', $width = '100%', $spacing = '0', $padding = '1', $border = '0', $align = 'left').'';

		$sql="SELECT a.*,b.jns_simpan,c.nama,d.ftNamaNasabah,d.ftJabatan FROM tbl_trans_sp a 
			   left join jns_simpan b on a.jenis_id=b.id
			   left join nama_kas_tbl c on a.kas_id=c.id 
			   left join tlnasabah d on a.anggota_id=d.fnId
			   WHERE a.id='$id_simpan'";
		$result= mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			
			$tgl_bayar = explode(' ', $row[tgl_transaksi]);
			$txt_tanggal = date("d-M-Y", strtotime($row[tgl_transaksi]));
			$txt_tanggal2 =tgl_indo_true($txt_tanggal);
			$txt_tanggal .= ' / ' . substr($tgl_bayar[1], 0, 5);
			$html .= '
			<table width="100%" >
			<tr>
				<td width="20%"> Tanggal Transaksi </td>
				<td width="2%">:</td>
				<td width="35%" class="h_kiri">'.$txt_tanggal.'</td>

				<td> Tanggal Cetak </td>
				<td width="2%">:</td>
				<td width="25%" class="h_kiri">'.date('d-M-Y').' / '.date('H:i').'</td>
			</tr>
			<tr>
				<td> Nomor Transaksi </td>
				<td>:</td>
				<td>'.'TRD'.sprintf('%05d', $row[id]).'</td>

				<td> User Akun </td>
				<td width="2%">:</td>
				<td class="h_kiri">'.$row[user_name].'</td>
			</tr>
			<tr>
				<td> Nama Anggota </td>
				<td>:</td>
				<td>'.strtoupper($row[ftNamaNasabah]).'</td>
			
				<td> Status </td>
				<td width="2%">:</td>
				<td class="h_kiri">SUKSES</td>
			</tr>
			<tr>
				<td> Nama Penyetor </td>
				<td>:</td>
				<td>'.$row[nama_penyetor].'</td>

				<td></td>
				<td width="2%"></td>
				<td class="h_kiri">Paraf, </td>
			</tr>
			<tr>
				<td> Alamat </td>
				<td>:</td>
				<td>'.$row[alamat].'</td>
			</tr>
			<tr>
				<td> Jenis Akun </td>
				<td>:</td>
				<td>'.$row[jns_simpan].'</td>
			</tr>
			<tr>
				<td> Jumlah Setoran </td>
				<td>:</td>
				<td>Rp. '.number_format($row[jumlah]).'</td>

				<td></td>
				<td width="2%"></td>
				<td class="h_kiri">____________ </td>
			</tr>
			<tr>
				<td> Terbilang </td> 
				<td>:</td>
				<td colspan="3">'.$terb->eja($row[jumlah]).' RUPIAH </td>
			</tr>';
		}
		$html .= '</table> 
			<p class="txt_content"></p>
			<p class="txt_content">Ref. '.date('Ymd_His').'<br> 
			Informasi Hubungi Call Center : '.$out['ftTelephone'].'<br>
			** Tanda terima ini sah jika telah dibubuhi cap dan tanda tangan oleh Admin ** 
		</p>';
		$pdf->nsi_html($html);
		$pdf->Output(date('Ymd_His') . '.pdf', 'I');
}
}
?>

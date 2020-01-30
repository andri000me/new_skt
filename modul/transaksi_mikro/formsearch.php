<?php
session_start();  
error_reporting(0);
include("../../config/config.php");
$namakelompok=$_GET['x'];
//var_dump($namakelompok);exit;
//$d=$_GET[id];

/*
if(!isset($_SESSION['full_name'])){
echo"Anda Belum Login atau koneksi telah timeout Silakan  ";
echo"<A HREF='../index.php?mod=logout&semua=olo'>Login</A>";
exit;
}
*/

?>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
		<title>Tabel Nasabah</title>
		<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    	 <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
   		 <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
		
		<script>
		/*$(document).ready(function()
		{ 
			   $(document).bind("contextmenu",function(e){
					  return false;
			   }); 
		});*/
		function pick(a, b,c,d,e,f,g,h,i,j) {
		if (window.opener && !window.opener.closed){
			window.opener.document.myFormMikro.ftCustomer_Code.value = a;
			window.opener.document.myFormMikro.ftNamaNasabah.value = b;
			window.opener.document.myFormMikro.ftAlamat.value = c;
			window.opener.document.myFormMikro.fcTotalPelunasanPokok.value = d;
			window.opener.document.myFormMikro.fcTotalPelunasanBunga.value = e;
			window.opener.document.myFormMikro.fcTotalPelunasanAdm.value = f;
			window.opener.document.myFormMikro.fcTotalPelunasanPblt.value = g;
			window.opener.document.myFormMikro.ftTrans_No_old.value = h;
			window.opener.document.myFormMikro.fcTotalPelunasan.value = i;
			window.opener.document.myFormMikro.fcPelunasan.value = j;
			window.opener.document.myFormMikro.fcPlafond.disabled = false;
		  }
		  window.close();
		}
		</script>
		<style type="text/css">
tfoot {
    display: table-header-group;
}
</style> 
		<style>
			a:hover, a:visited, a:link, a:active
			{
				text-decoration: none;
			}
			td
			{
			font-family:Tahoma;
			font-size:8pt;
			}
		</style>
	</head>
	<body>
	<section class="content">
      <div class="row">
        <div class="col-xs-12">
        <div class="box box-primary">
		 <div class="box-header">
			 <button type="button" class="close" data-dismiss="modal">&times;</button>
			 <h4 class="modal-title">Tabel Nasabah</h4>
		  </div>
		<div class="box-body">
			<div class="table-responsive">
<table id="formsearch" class="table table-striped " onmouseover="this.style.cursor='pointer'">
            
	  <thead>
		<tr>
		 <th align="center" >No</th><th align="center">Nomor Rekening</th><th align="center">Nama</th><th align="center">Alamat</th><th align="center">Tipe Nasabah</th><th align="center">Kelompok</th>
		 </tr>
		</thead>
		
		<tbody>
				<?php 
				//include("../../config/config.php");
				$tampil=mysql_query("SELECT a.ftNamaNasabah,a.fnTipeNasabah, a.ftNoRekening,a.ftAlamat,a.ftNamaKelompok,b.ftCustomer_Code,
b.fcTotalPelunasanPokok,b.fcTotalPelunasanBunga,b.fcTotalPelunasanAdm,b.fcTotalPelunasanPblt ,b.ftTrans_No,b.fcTotalPelunasan 
FROM tlnasabah a 
LEFT JOIN (SELECT
  `txpinjaman_mikro_nasabah_hdr`.`ftTrans_No`       AS `ftTrans_No`,
  `txpinjaman_mikro_nasabah_hdr`.`ftCustomer_Code`  AS `ftCustomer_Code`,
  `txpinjaman_mikro_nasabah_hdr`.`fcPlafond`        AS `fcPlafond`,
  `txpinjaman_mikro_nasabah_hdr`.`fnJW`             AS `fnJW`,
  `txpinjaman_mikro_nasabah_hdr`.`ffBunga`          AS `ffBunga`,
  `txpinjaman_mikro_nasabah_hdr`.`fnStatus`         AS `fnstatus`,
  `txpinjaman_mikro_nasabah_hdr`.`fcPokokAngsuran`  AS `fcPokokAngsuran`,
  `txpinjaman_mikro_nasabah_hdr`.`fcBunganAngsuran` AS `fcBunganAngsuran`,
  `txpinjaman_mikro_nasabah_hdr`.`fcAdm`            AS `fcAdm`,
  `txpinjaman_mikro_nasabah_hdr`.`fcPbltAngsuran`   AS `fcPbltAngsuran`,
  (`txpinjaman_mikro_nasabah_hdr`.`fcPokokAngsuran` * (`txpinjaman_mikro_nasabah_hdr`.`fnJW` - IFNULL(b.jmlBayar,0))) AS `fcTotalPelunasanPokok`,
  (`txpinjaman_mikro_nasabah_hdr`.`fcBunganAngsuran` * (`txpinjaman_mikro_nasabah_hdr`.`fnJW` - IFNULL(b.jmlBayar,0))) AS `fcTotalPelunasanBunga`,
  (`txpinjaman_mikro_nasabah_hdr`.`fcAdmAngsuran` * (`txpinjaman_mikro_nasabah_hdr`.`fnJW` - IFNULL(b.jmlBayar,0))) AS `fcTotalPelunasanAdm`,
  (`txpinjaman_mikro_nasabah_hdr`.`fcPbltAngsuran` * (`txpinjaman_mikro_nasabah_hdr`.`fnJW` - IFNULL(b.jmlBayar,0))) AS `fcTotalPelunasanPblt`,
  ((((`txpinjaman_mikro_nasabah_hdr`.`fcPokokAngsuran` * (`txpinjaman_mikro_nasabah_hdr`.`fnJW` - IFNULL(b.jmlBayar,0))) + (`txpinjaman_mikro_nasabah_hdr`.`fcBunganAngsuran` * (`txpinjaman_mikro_nasabah_hdr`.`fnJW` - IFNULL(b.jmlBayar,0)))) + (`txpinjaman_mikro_nasabah_hdr`.`fcAdmAngsuran` * (`txpinjaman_mikro_nasabah_hdr`.`fnJW` - IFNULL(b.jmlBayar,0)))) + (`txpinjaman_mikro_nasabah_hdr`.`fcPbltAngsuran` * (`txpinjaman_mikro_nasabah_hdr`.`fnJW` - IFNULL(b.jmlBayar,0)))) AS `fcTotalPelunasan`
FROM `txpinjaman_mikro_nasabah_hdr`
LEFT JOIN (
		SELECT ftCustomer_Code, ftLoan_No, COUNT(fcPokokAngsuran) AS jmlBayar
		FROM txangsuran_mikro_hdr WHERE fnstatus = 1
		GROUP BY ftCustomer_Code, ftLoan_No
	) b ON txpinjaman_mikro_nasabah_hdr.ftCustomer_Code = b.ftCustomer_Code
		AND `txpinjaman_mikro_nasabah_hdr`.`ftTrans_No`  = b.ftLoan_No) b ON a.ftNoRekening=b.ftCustomer_Code 
WHERE  a.fnTipeNasabah='MIKRO' AND a.ftNamaKelompok ='$namakelompok' GROUP BY a.ftNoRekening ORDER BY a.ftNamaNasabah ASC ");
				
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				$no2=htmlentities($r['ftNoRekening']);
				$no3=htmlentities($r['ftNamaNasabah']);
				$no4=htmlentities($r['ftAlamat']);
				$no4ex=str_replace("\r\n","",$no4);
				$no5=htmlentities(number_format($r['fcTotalPelunasanPokok'], 0 , ',' , ',' ));
				$no6=htmlentities(number_format($r['fcTotalPelunasanBunga'], 0 , ',' , ',' ));
				$no7=htmlentities(number_format($r['fcTotalPelunasanAdm'], 0 , ',' , ',' ));
				$no8=htmlentities(number_format($r['fcTotalPelunasanPblt'], 0 , ',' , ',' ));
				$no9=htmlentities($r['ftTrans_No']);
				$no10=htmlentities(number_format($r['fcTotalPelunasan'], 0 , ',' , ',' ));
				$no11=htmlentities(number_format($r['fcTotalPelunasan'], 0 , ',' , ',' ));
				
				$no1++;	
				
				echo"
                <tr bgcolor='#d5e8e4' onmouseover=\"bgColor='#FFFF9E'\" onmouseout=\"bgColor='#d5e8e4'\" onclick=\"pick('$no2','$no3','$no4ex','$no5','$no6','$no7','$no8','$no9','$no10','$no11')\">
				  <td width='40px'>$no1</td>
				  <td>$r[ftNoRekening]</td>   
				  <td>$r[ftNamaNasabah]</td> 
				  <td width='500px'>$r[ftAlamat]</td>
				  <td width='60px'>$r[fnTipeNasabah]</td>
				  <td width='60px'>$r[ftNamaKelompok]</td>
                </tr>";
              
				}
			
			   ?>
               
               
                </tbody>
		</table>
			</div>
			</div>
			</div>
		  </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>	
	</body>
</html>
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $("#formsearch").DataTable();
           
        });
  </script>
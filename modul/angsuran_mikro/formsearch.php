<?php
session_start();
error_reporting(0);
//include("config/config.php");
require("../../config/config.php");
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
		<title>Tabel Transaksi Mikro</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    	 <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
   		 <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<script>
		/*$(document).ready(function()
		{
			   $(document).bind("contextmenu",function(e){
					  return false;
			   });
		});*/
		function pick(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p) {
		  if (window.opener && !window.opener.closed){
			window.opener.document.myForm.ftLoan_No.value = a;
			window.opener.document.myForm.fcPlafond.value = b;
			window.opener.document.myForm.ftCustomer_Code.value = c;
			window.opener.document.myForm.ftNamaNasabah.value = d;
			window.opener.document.myForm.ftAlamat.value = e;
			window.opener.document.myForm.ffBunga.value = f;
			window.opener.document.myForm.fnJW.value = g;
			window.opener.document.myForm.fcOutstanding.value = h;
			window.opener.document.myForm.fcPokokAngsuran.value = i;
			window.opener.document.myForm.fcBunganAngsuran.value = j;
			window.opener.document.myForm.fcAdmAngsuran.value = k;
			window.opener.document.myForm.fcPbltAngsuran.value = l;
			window.opener.document.myForm.fcTabAngsuran.value = m;
			window.opener.document.myForm.fcTotalAngsuran.value = n;
			window.opener.document.myForm.fcPayment.value = o;
			window.opener.document.myForm.ftNamaKelompok.value = p;
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
			font-size:10pt;
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
		 <th align="center">No</th>
				  <th>No Transaksi</th>
				  <th>Tgl Pinjam</th>
				  <th>No Rekening</th>
				  <th>Nama</th>
				  <th>Plafond Pinjaman</th>
				  <th>Nama Kelompok</th>
		 </tr>
		</thead>

		<tbody>
				<?php

				$tampil=mysql_query("SELECT a.*, b.fcPokokAngsuran, b.fcBunganAngsuran, b.fcAdmAngsuran, b.fcPbltAngsuran, b.fcTabAngsuran,b.fcPokokAngsuran + b.fcBunganAngsuran + b.fcAdmAngsuran + b.fcPbltAngsuran + b.fcTabAngsuran AS fcTotalAngsuran,
					b.fcplafond, b.ffbunga, fnJW, c.ftAlamat, c.ftNamaKelompok,c.ftNamaNasabah,c.ftNoRekening, b.fdTrans_date
					FROM (
							SELECT xx.ftCustomer_Code, xx.ftTrans_No, SUM(xx.fcPlafond) AS fcOutstanding
							FROM (
								SELECT ftCustomer_Code, ftTrans_No, fcPlafond
								FROM txpinjaman_mikro_nasabah_hdr
								WHERE fnstatus = 1

								UNION ALL

								SELECT IFNULL(a.ftCustomer_Code,'') AS ftCustomer_Code, IFNULL(a.ftTrans_No,'') AS ftTrans_No,
								-IFNULL(b.fcPokokAngsuran,0)
								FROM txpinjaman_mikro_nasabah_hdr a
								LEFT JOIN txangsuran_mikro_hdr b ON a.ftCustomer_Code = b.ftCustomer_Code AND a.ftTrans_No = b.ftloan_No
								AND b.fnStatus = 1
								WHERE a.fnstatus = 1

								UNION ALL

								SELECT IFNULL(a.ftCustomer_Code,'') AS ftCustomer_Code, IFNULL(a.ftTrans_No,'') AS ftTrans_No,
								-IFNULL(b.fcPokokAngsuran,0)
								FROM txpinjaman_mikro_nasabah_hdr a
								LEFT JOIN txpelunasan_mikro_hdr b ON a.ftCustomer_Code = b.ftCustomer_Code AND a.ftTrans_No = b.ftloan_No
								AND b.fnStatus = 1
								WHERE a.fnstatus = 1

							) xx
							GROUP BY xx.ftCustomer_Code, xx.ftTrans_No
					    ) a
					LEFT JOIN txpinjaman_mikro_nasabah_hdr b ON a.ftCustomer_Code = b.ftCustomer_Code AND a.ftTrans_No = b.ftTrans_No
					LEFT JOIN tlnasabah c ON c.ftNoRekening = a.ftCustomer_Code");

				$no1 = 0;
				while($r=mysql_fetch_array($tampil)){
				$no2=htmlentities($r['ftTrans_No']);
				$no3=htmlentities(number_format($r['fcplafond'], 0 , ',' , ',' ));
				$no4=htmlentities($r['ftNoRekening']);
				$no5=htmlentities($r['ftNamaNasabah']);
				$no6=htmlentities($r['ftAlamat']);
				$no6ex=str_replace("\r\n","",$no6);
				$no7=htmlentities($r['ffbunga']);
				$no8=htmlentities($r['fnJW']);
				$no9=htmlentities(number_format($r['fcOutstanding'], 0 , ',' , ',' ));
				$no10=htmlentities(number_format($r['fcPokokAngsuran'], 0 , ',' , ',' ));
				$no11=htmlentities(number_format($r['fcBunganAngsuran'], 0 , ',' , ',' ));
				$no12=htmlentities(number_format($r['fcAdmAngsuran'], 0 , ',' , ',' ));
				$no13=htmlentities(number_format($r['fcPbltAngsuran'], 0 , ',' , ',' ));
				$no14=htmlentities(number_format($r['fcTabAngsuran'], 0 , ',' , ',' ));
				$no15=htmlentities(number_format($r['fcTotalAngsuran'], 0 , ',' , ',' ));
				$no16=htmlentities(number_format($r['fcTotalAngsuran'], 0 , ',' , ',' ));
				$no17=htmlentities($r['ftNamaKelompok']);
				$fcplafond=htmlentities(number_format($r['fcplafond'], 0 , ',' , ',' ));
				$no1++;

				echo"
                <tr bgcolor='#d5e8e4' onmouseover=\"bgColor='#FFFF9E'\" onmouseout=\"bgColor='#d5e8e4'\" onclick=\"pick('$no2','$no3','$no4','$no5','$no6ex','$no7','$no8','$no9','$no10','$no11','$no12','$no13','$no14','$no15','$no16','$no17')\">
				  <td>$no1</td>
				  <td>$r[ftTrans_No]</td>
				  <td>$r[fdTrans_date]</td>
				  <td>$r[ftNoRekening]</td>
				  <td>$r[ftNamaNasabah]</td>
				  <td>$fcplafond</td>
				  <td>$r[ftNamaKelompok]</td>
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
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $("#formsearch").DataTable();

        });
  </script>

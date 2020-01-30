<?php
session_start(); 
error_reporting(0);
include("../../config/config.php");
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
		function pick(a, b,c,d,e,f,g,h,i,j,k) {
		  if (window.opener && !window.opener.closed){
			window.opener.document.myForm.ftCustomer_Code.value = a;
			window.opener.document.myForm.ftNamaNasabah.value = b;
			window.opener.document.myForm.ftAlamat.value = c;
			window.opener.document.myForm.fcTotalPelunasanPokok.value = d;
			window.opener.document.myForm.fcTotalPelunasanBunga.value = e;
			window.opener.document.myForm.fcTotalPelunasanAdm.value = f;
			window.opener.document.myForm.fcTotalPelunasanPblt.value = g;
			window.opener.document.myForm.ftTrans_No_old.value = h;
			window.opener.document.myForm.fcTotalPelunasan.value = i;
			window.opener.document.myForm.fcPelunasan.value = j;
			window.opener.document.myForm.fcTotalPelunasanTab.value = k;
			window.opener.document.myForm.fcPlafond.disabled = false;
		  }
		  window.close();
		}
		</script>
		<style type="text/css">
			tfoot {	display: table-header-group;}
			a:hover, a:visited, a:link, a:active{text-decoration: none;}
			td{white-space: nowrap;max-width: 100%;font-family:Tahoma;font-size:10pt;}
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
		 <th align="center">No</th><th align="center">Nomor Rekening</th><th align="center">Nama</th><th align="center">Alamat</th><th align="center">Tipe Nasabah</th><th align="center">Kantor Bayar</th>
		 </tr>
		</thead>
		
		<tbody>
				<?php /*
				$tampil=mysql_query("SELECT a.ftNamaNasabah,a.fnTipeNasabah,a.ftKantorBayar,a.ftNoRekening,a.ftAlamat,b.ftCustomer_Code,b.fcTotalPelunasanPokok,b.fcTotalPelunasanBunga,b.fcTotalPelunasanAdm,b.fcTotalPelunasanPblt ,b.ftTrans_No,b.fcTotalPelunasan FROM tlnasabah a LEFT JOIN vLoadpelunasanumum b ON a.ftNoRekening=b.ftCustomer_Code WHERE a.fnTipeNasabah='UMUM' GROUP BY a.ftNoRekening ORDER BY a.ftNamaNasabah ASC ");
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
				  <td>$no1</td>
				  <td>$r[ftNoRekening]</td>   
				  <td>$r[ftNamaNasabah]</td> 
				  <td width='500px'>$r[ftAlamat]</td>
				  <td width='60px'>$r[fnTipeNasabah]</td>
				  <td width='60px'>$r[ftKantorBayar]</td>
                </tr>";
              
				}
			*/
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
			var table =  $("#formsearch").DataTable({
				ordering: false,
				processing: true,
				serverSide: true,
				paginationType: "full_numbers",
    			lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
				ajax: {
				url: "<?php echo ('aksi_serverside.php') ?>", 
				type:'POST',
				}
			});

		$('#formsearch tbody').on('click', 'tr', function () {
		var data = table.row( this ).data();
		pick(data[1],data[2],data[3],data[7],data[8],data[9],data[10],data[11],data[12],data[13],data[14])
	   } ); 

	    
     });
  </script>
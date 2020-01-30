<?php
session_start();

include("modul/dashboard/form_so.php");
include("modul/dashboard/form_boq.php");
include("modul/dashboard/form_baps.php");
include("modul/dashboard/form_invoice.php");
include("modul/dashboard/form_terbayar.php");
include("modul/dashboard/form_onprogress.php");
include("modul/dashboard/form_selesai.php");
include("modul/dashboard/form_cancel.php");
include("modul/dashboard/form_submitreport.php");
include("modul/dashboard/form_total.php");
include("modul/dashboard/form_ujiterima.php");
?>	

 <!-- Bootstrap 3.3.6 -->
 <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" /> -->
  <style type="text/css">
.modal-open{overflow:hidden}.modal{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1050;display:none;overflow:hidden;-webkit-overflow-scrolling:touch;outline:0}.modal.fade .modal-dialog{-webkit-transition:-webkit-transform .3s ease-out;-o-transition:-o-transform .3s ease-out;transition:transform .3s ease-out;-webkit-transform:translate(0,-25%);-ms-transform:translate(0,-25%);-o-transform:translate(0,-25%);transform:translate(0,-25%)}.modal.in .modal-dialog{-webkit-transform:translate(0,0);-ms-transform:translate(0,0);-o-transform:translate(0,0);transform:translate(0,0)}.modal-open .modal{overflow-x:hidden;overflow-y:auto}.modal-dialog{position:relative;width:auto;margin:10px}.modal-content{position:relative;background-color:#fff;-webkit-background-clip:padding-box;background-clip:padding-box;border:1px solid #999;border:1px solid rgba(0,0,0,.2);border-radius:6px;outline:0;-webkit-box-shadow:0 3px 9px rgba(0,0,0,.5);box-shadow:0 3px 9px rgba(0,0,0,.5)}.modal-backdrop{position:fixed;top:0;right:0;bottom:0;left:0;z-index:1040;background-color:#000}.modal-backdrop.fade{filter:alpha(opacity=0);opacity:0}.modal-backdrop.in{filter:alpha(opacity=50);opacity:.5}.modal-header{padding:15px;border-bottom:1px solid #e5e5e5}.modal-header .close{margin-top:-2px}.modal-title{margin:0;line-height:1.42857143}.modal-body{position:relative;padding:15px}.modal-footer{padding:15px;text-align:right;border-top:1px solid #e5e5e5}.modal-footer .btn+.btn{margin-bottom:0;margin-left:5px}.modal-footer .btn-group .btn+.btn{margin-left:-1px}.modal-footer .btn-block+.btn-block{margin-left:0}.modal-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}@media (min-width:768px){.modal-dialog{width:1200px;margin:30px auto}.modal-content{-webkit-box-shadow:0 5px 15px rgba(0,0,0,.5);box-shadow:0 5px 15px rgba(0,0,0,.5)}.modal-sm{width:300px}}@media (min-width:992px){.modal-lg{width:900px}}


.badge {
  padding: 1px 9px 2px;
  font-size: 24.025px;
  font-weight: bold;
  white-space: nowrap;
  color: #ffffff;
  background-color: #999999;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
}
.badge:hover {
  color: #ffffff;
  text-decoration: none;
  cursor: pointer;
}
.badge-error {
  background-color: #b94a48;
}
.badge-error:hover {
  background-color: #953b39;
}
.badge-warning {
  background-color: #c67605;
    color:white;
}
.badge-warning:hover {
  background-color: #d3aa06;
}
.badge-success {
  background-color: green;
   color:white;
}
.badge-success:hover {
  background-color: #468847;
}
.badge-info {
  background-color: #3a87ad;
}
.badge-info:hover {
  background-color: #2d6987;
}
.badge-inverse {
  background-color: #9b0499;
  color:white;
}
.badge-inverse:hover {
  background-color: #c107bf;
}
.badge-pink {
  background-color: #ef239a;
  color:white;
}
.badge-pink:hover {
  background-color: #ed38a2;
}
.badge-red {
  background-color: #cc0428;
  color:white;
}
.badge-red:hover {
  background-color: #f93b4b;
}
.badge-brown {
  background-color: #96610d;
}
.badge-brown:hover {
  background-color: #1a1a1a;
 }
 .badge-abu {
  background-color: #636b62;
   color:white;
}
.badge-abu:hover {
  background-color: #727a71;
</style>

<script src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript"> 
  $(document).ready(function() {
  // view so	  
    $(".so").focusin(function() {
    $("#viewso").modal('show'); // ini fungsi untuk menampilkan modal
    $('#formso').DataTable(); // fungsi ini untuk memanggil datatable 
  });
  
  // view boq	  
    $(".boq").focusin(function() {
    $("#viewboq").modal('show'); // ini fungsi untuk menampilkan modal
    $('#formboq').DataTable(); // fungsi ini untuk memanggil datatable 
  });
  
  // view baps	  
    $(".baps").focusin(function() {
    $("#viewbaps").modal('show'); // ini fungsi untuk menampilkan modal
	$('#example2').DataTable(); // fungsi ini untuk memanggil datatable 
  });
  
 // view invoice	  
    $(".invoice2").focusin(function() {
    $("#viewinvoice").modal('show'); // ini fungsi untuk menampilkan modal
    $('#forminvoice').DataTable(); // fungsi ini untuk memanggil datatable 
  });
  
  // view terbayar	  
    $(".terbayar").focusin(function() {
    $("#viewterbayar").modal('show'); // ini fungsi untuk menampilkan modal
    $('#formterbayar').DataTable(); // fungsi ini untuk memanggil datatable 
  });
  
   // view on progress	  
    $(".onprogress").focusin(function() {
    $("#viewonprogress").modal('show'); // ini fungsi untuk menampilkan modal
	$('#formonprogress').DataTable(); // fungsi ini untuk memanggil datatable 
  });
 
   // view Uji Terima	  
    $(".ujiterima").focusin(function() {
    $("#viewujiterima").modal('show'); // ini fungsi untuk menampilkan modal
	$('#formujiterima').DataTable(); // fungsi ini untuk memanggil datatable 
  });
 
   // view submit report  
    $(".submitreport").focusin(function() {
    $("#viewsubmitreport").modal('show'); // ini fungsi untuk menampilkan modal
	$('#formsubmitreport').DataTable(); // fungsi ini untuk memanggil datatable 
  });
 
   // view selesai	  
    $(".selesai").focusin(function() {
    $("#viewselesai").modal('show'); // ini fungsi untuk menampilkan modal
	$('#formselesai').DataTable(); // fungsi ini untuk memanggil datatable 
  });
 
   // view cancel	  
    $(".cancel").focusin(function() {
    $("#viewcancel").modal('show'); // ini fungsi untuk menampilkan modal
	$('#formcancel').DataTable(); // fungsi ini untuk memanggil datatable 
  });
 
   // view total	  
    $(".total").focusin(function() {
    $("#viewtotal").modal('show'); // ini fungsi untuk menampilkan modal
	$('#formtotal').DataTable(); // fungsi ini untuk memanggil datatable 
  });
 
 
 });

</script>


<section class="content-header">
<?php
$tahun=mysql_query("SELECT * FROM tbl_tahun WHERE aktif='Y' ORDER BY id_tahun");
?>

      <h1>
        Dashboard
       <b> <?php echo "$_GET[act]";    ?> </b>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard so"></i> Home</a></li>
        <li class="active"><?php echo"$hari_ini,"; ?>
							<?php echo tgl_indo(date('Y m d'));  ?>
							<?php echo "|";  ?>
							<span id="clock"><?php print date('H:i:s'); ?></span></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <!-- Small boxes (Stat box) -->
      <div class="row">
	  
	 
	  <div class="box-header">
			<h3 class="box-title">
			<?php 
			while($w=mysql_fetch_array($tahun)){
				$thn=$w[tahun];
			?>
			<span class="badge badge-abu"  <?php echo" onclick=\"location.href='dashboard-$thn.html';\"  >$thn</span>"; ?>
			<?php } ?></h3>
             
            </div>
          
	  
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
			<?php
			$v=mysql_query("SELECT SUM(nominal) AS jml_pkb FROM view_tbl_teknik WHERE aktif='Y'  AND tahun='$_GET[act]'");
			$so=mysql_fetch_array($v);	
			$nominalpkb = number_format ($so[jml_pkb], 0, ',', '.');
			echo"
              <h3>$nominalpkb</h3>";
			?>	
              <p>SO</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer so" target="blank">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php
			$x=mysql_query("SELECT SUM(nominal_pkt) AS jml_pkt FROM view_tbl_teknik WHERE aktif='Y'  AND tahun='$_GET[act]'");
			$pkt=mysql_fetch_array($x);	
			$nominalpkt = number_format ($pkt[jml_pkt], 0, ',', '.');
			echo"
              <h3>$nominalpkt</h3>";
			?>	

              <p>BOQ FINAL</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
              <a href="#" class="small-box-footer boq" target="blank">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <?php
			$c=mysql_query("SELECT SUM(nominal_pkt) AS jml_pkt FROM view_tbl_teknik WHERE aktif='Y'  AND tahun='$_GET[act]'");
			$ba=mysql_fetch_array($c);	
			$nominalpkt2 = number_format ($ba[jml_pkt], 0, ',', '.');
			echo"
              <h3>$nominalpkt2</h3>";
			?>	

              <p>BAPS</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer baps">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
			$d=mysql_query("SELECT SUM(nominal_invoice) AS jml_invoice FROM view_tbl_keuangan WHERE aktif='Y'  AND tahun='$_GET[act]'");
			$invoice=mysql_fetch_array($d);	
			$nominalinvoice = number_format ($invoice[jml_invoice], 0, ',', '.');
			echo"
              <h3>$nominalinvoice</h3>";
			?>	

              <p>INVOICE</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer invoice2 ">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
		 <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <?php
			$d=mysql_query("SELECT SUM(nominal_pembayaran) AS jml_bayar FROM view_tbl_keuangan WHERE aktif='Y'  AND tahun='$_GET[act]'");
			$bayar=mysql_fetch_array($d);	
			$nominalbayar = number_format ($bayar[jml_bayar], 0, ',', '.');
			echo"
              <h3>$nominalbayar</h3>";
			?>	

              <p>TERBAYAR</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer terbayar ">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
		
      </div>
		 
      <!-- /.row -->
      </section>
	 <section class="content-header">
      <h1>
        Summary <small>Pencapaian</small>
      </h1>
     </section>
	 <section class="content">
	
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box badge-red ">
            <div class="inner">
			<?php
			$v=mysql_query("SELECT COUNT(progress_aktivasi) AS jml_progress FROM view_tbl_teknik WHERE aktif='Y'  AND progress_aktivasi IN('Instalasi','Survey')  AND tahun='$_GET[act]'");
			$so1=mysql_fetch_array($v);	
			echo"
              <h3>$so1[jml_progress]</h3>";
			?>	
              <p>ON PROGRESS</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer onprogress">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box badge-warning">
            <div class="inner">
            <?php
			$v=mysql_query("SELECT COUNT(progress_aktivasi) AS jml_progress FROM view_tbl_teknik WHERE aktif='Y'  AND progress_aktivasi IN('Test Commisioning')  AND tahun='$_GET[act]'");
			$so2=mysql_fetch_array($v);	
			echo"
              <h3>$so2[jml_progress]</h3>";
			?>	

              <p>UJI TERIMA</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer ujiterima">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box badge-inverse">
            <div class="inner">
            <?php
			$v=mysql_query("SELECT COUNT(progress_aktivasi) AS jml_progress FROM view_tbl_teknik WHERE aktif='Y'  AND progress_aktivasi IN('Laporan Pekerjaan')  AND tahun='$_GET[act]'");
			$so3=mysql_fetch_array($v);	
			echo"
              <h3>$so3[jml_progress]</h3>";
			?>	

              <p>SUBMIT REPORT</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer submitreport">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box badge-success">
            <div class="inner">
             <?php
			$v=mysql_query("SELECT COUNT(progress_aktivasi) AS jml_progress FROM view_tbl_teknik WHERE aktif='Y'  AND progress_aktivasi IN('BAPS')  AND tahun='$_GET[act]'");
			$so4=mysql_fetch_array($v);	
			echo"
              <h3>$so4[jml_progress]</h3>";
			?>	

              <p>SELESAI</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer selesai">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
		 <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box badge-abu">
            <div class="inner">
             <?php
			$v=mysql_query("SELECT COUNT(progress_aktivasi) AS jml_progress FROM view_tbl_teknik WHERE aktif='Y'  AND progress_aktivasi IN('Cancel')  AND tahun='$_GET[act]'");
			$so5=mysql_fetch_array($v);	
			echo"
              <h3>$so5[jml_progress]</h3>";
			?>	

              <p>CANCEL</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer cancel">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
		 <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <?php
			$x=mysql_query("SELECT COUNT(progress_aktivasi) AS jml_progress FROM view_tbl_teknik WHERE aktif='Y'  AND progress_aktivasi IN('Laporan Pekerjaan','Test Commisioning','Instalasi','Survey','BAPS','Cancel')  AND tahun='$_GET[act]'");
			$sox=mysql_fetch_array($x);	
			$total=$so1[jml_progress]+$so2[jml_progress]+$so3[jml_progress]+$so4[jml_progress]+$so5[jml_progress];
			echo"
              <h3>$sox[jml_progress]</h3>";
			?>	

              <p>TOTAL</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer total">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
		
      </div>
      <!-- /.row -->
      </section>

     
	 
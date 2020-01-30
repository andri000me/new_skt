<?php
error_reporting(0);
//include("modul/laporan_daftar_pelunasan_umum/tampil.php");
include("modul/laporan_daftar_pelunasan_umum/form_tgl.php");
?>
<!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<script src="dist/sweetalert.min.js"></script>
<script type="text/javascript" src="js/pemisah_angka.js"></script>
<script src="js/jquery-1.8.3.min.js"></script>
<style>
 .btnprint{
	 background-color:#4CAF50;
	 border:none;
	 color:white;
	 padding:8px 22px;
	 text-align:center;
	 text-decoration:none;
	 display:inline-block;
	 font-size:16px;
	 font-weight:bold;
	 border-radius: 5px;
 }
 .btnexport{
	 background-color:#4CAF50;
	 border:none;
	 color:white;
	 padding:8px 22px;
	 text-align:center;
	 text-decoration:none;
	 display:inline-block;
	 font-size:16px;
	 font-weight:bold;
	 border-radius: 5px;
 }
</style>
<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}
</script>

<script type="text/javascript">
function validasi(form){
  if (form.ftKodeJenis.value == ""){
   sweetAlert("Oops...", "Kode Jenis harus di isi!", "error");
   form.ftKodeJenis.focus();
    return (false);
  }else if (form.ftNamaJenis.value == ""){
   sweetAlert("Oops...", "Nama Jenis harus di isi!", "error");
   form.ftNamaJenis.focus();
    return (false);
  }else if (form.fnStatus.value == ""){
   sweetAlert("Oops...", "Status harus di isi!", "error");
   form.fnStatus.focus();
    return (false);
  }else if (form.ftCabang.value == ""){
   sweetAlert("Oops...", "Cabang harus di isi!", "error");
   form.ftCabang.focus();
    return (false);
  }     
   
 }
 
 
</script>

<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<!-- <script src="../../plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- bootstrap datepicker -->
<!-- <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script> -->
<script >
$(function () {
 var startDate;
    var endDate;
    $('#daterange-btn').daterangepicker(
        {
		/*  startDate: moment().subtract(29, 'days'),
          endDate: moment(),
		  minDate: '01/01/2012',
          maxDate: '12/31/2099',
          dateLimit: { days: 60 },
          showDropdowns: true,
          showWeekNumbers: true,
          timePicker: false,
          timePickerIncrement: 1,
          timePicker12Hour: true,*/
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
		  startDate: moment().subtract(29, 'days'),
          endDate: moment()
          
        },
    //    function (start, end) {
     //     $('#daterange-btn span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
     //   }
		function(start,end,startDate,endDate) {
			$('#daterange-btn span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        startDate = start;
    //    endDate = end;  
			var startDate = $('#daterange-btn').data('daterangepicker').startDate.format('YYYY-MM-DD');
			var endDate   = $('#daterange-btn').data('daterangepicker').endDate.format('YYYY-MM-DD');
			
		//	var startend=[startDate,endDate];
			var startend=startDate+' sampai '+endDate;
			var awal=startDate;
			var akhir=endDate;
			console.log(akhir);
	//		console.log(endDate);			
			$.ajax({
			type: 'GET',
			url: 'modul/laporan_daftar_pelunasan_umum/tampil.php ',
			data: 'allDate='+ startDate +' sampai '+ endDate, 
		    dataType: 'html',
		    success: function(response) {
				$('#tes').html(response);
			}
		}),
		
		$.ajax({
		    type: 'GET',
			url: 'excel/export_laporan_daftar_pelunasan_umum.php?first='+awal+'&last='+akhir,
			data: { "allDate2": startend },
		    dataType: 'html',
		    success: function(response) {
				$('#export').html(response);
			}
		});
		},
    )
});
</script>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
<script type="text/javascript"> 
  $(document).ready(function() {
  // view so	  
    $(".export").focusin(function() {
    $("#viewso").modal('show'); // ini fungsi untuk menampilkan modal
    $('#formso').DataTable(); // fungsi ini untuk memanggil datatable 
  });
 });

</script>

<?php

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//if($cek==1 OR $_SESSION[leveluser]=='1' || $_SESSION[leveluser]=='2'  || $_SESSION[leveluser]=='3' || $_SESSION[leveluser]=='4' || $_SESSION[leveluser]=='5'  || $_SESSION[leveluser]=='6' || $_SESSION[leveluser]=='7'){
if(!empty($_SESSION['leveluser'])){  
$base_url = $_SERVER['HTTP_HOST'];
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

$aksi="modul/users/aksi_users.php";
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
  

   ?>
   
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       LAPORAN DAFTAR PELUNASAN UMUM
        
      </h1>
      <ol class="breadcrumb">
         <li><a href="home.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?php echo"$hari_ini,"; ?>
							<?php echo tgl_indo(date('Y m d'));  ?>
							<?php echo "|";  ?>
							<span id="clock"><?php print date('H:i:s'); ?></span></li>
      </ol>
    </section>

	<!-- Header	-->
	 <div class="box box-solid">
    <div class="box-body layout-top-nav">
      
      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container-fluid">
              <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <ul class="nav navbar-nav">
                
				<li><h3 class="box-title"><button type="button" class="btn bg-purple dropdown-toggle" id="daterange-btn" >
                    <span>
                      <i class="fa fa-calendar"></i> Date range picker
                    </span>
                    <i class="fa fa-caret-down"></i>
                  </button>
				 
                    </h3></li>
			<!--		<li><h3 class="box-title">
                    &nbsp;&nbsp;&nbsp;<span onclick=printContent("printr") class="label bg-purple">Print</span>
                    </h3></li> -->
					<li><h3 class="box-title">&nbsp;&nbsp;&nbsp;
					<button class="btnprint bg-purple"><span>Print</span></button>
					</h3></li>
					<li><h3 class="box-title">
                    &nbsp;&nbsp;&nbsp;<button class="btnexport bg-purple export" onclick="location.href='<?php 
					
					echo "excel/export_laporan_daftar_pelunasan_umum.php";?>';" >
					<span>Export</span></button>
                    </h3></li>
					
                </ul>
              </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
    </div>
  </div>
	<!-- end header -->
	<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box box-primary" id='printr'>
	<pre class="prettyprint" id="tes">

</pre>			 </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
	<div id="tes"></div>
    <!-- /.content -->
  <!-- ===================================================================== -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	
	
 

   
	<?php  		  
    
  
   }
   }
  ?>

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    }

}, );
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
	;

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

   

    //Timepicker
    /*$(".timepicker").timepicker({
      showInputs: false
    });*/
  });
  
  $('.btnprint').click(function(){
	var printme = document.getElementById('printr');
	var wme = window.open("","","width=900,height=700");
	wme.document.write(printme.outerHTML);
	wme.document.close();
	wme.focus();
	wme.print();
	wme.close();
});
</script>

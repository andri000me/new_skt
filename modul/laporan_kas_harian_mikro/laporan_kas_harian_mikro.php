<?php
$tgl = date("d");
$bln = date("m");
$thn = date("Y");
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
<style>
 @media (min-width: 768px) {
  .form-search .combobox-container,
  .form-inline .combobox-container {
    display: inline-block;
    margin-bottom: 0;
    vertical-align: top;
  }
  .form-search .combobox-container .input-group-addon,
  .form-inline .combobox-container .input-group-addon {
    width: auto;
  }
}

.combobox-selected .caret {
  display: none;
}


/* :not doesn't work in IE8 */

.combobox-container:not(.combobox-selected) .glyphicon-remove {
  display: none;
}

.typeahead-long {
  max-height: 300px;
  overflow-y: auto;
}

.control-group.error .combobox-container .add-on {
  color: #B94A48;
  border-color: #B94A48;
}

.control-group.error .combobox-container .caret {
  border-top-color: #B94A48;
}

.control-group.warning .combobox-container .add-on {
  color: #C09853;
  border-color: #C09853;
}

.control-group.warning .combobox-container .caret {
  border-top-color: #C09853;
}

.control-group.success .combobox-container .add-on {
  color: #468847;
  border-color: #468847;
}

.control-group.success .combobox-container .caret {
  border-top-color: #468847;
}
</style>

<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}

function showKelompok(menu) {
  sList = window.open('modul/cetak_form_terima_bagi_hasil_mikro/kelompok.php', 'Print', 'width=920,height=420,scrollbars=yes');
  }
</script>
<?php
//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);

if(!empty($_SESSION['leveluser'])){  
$base_url = $_SERVER['HTTP_HOST'];
switch($_GET[act]){
default:
?>
   
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       LAPORAN KAS HARIAN MIKRO
        
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
              <form id="myForm" autocomplete="off" name="myForm" method="POST" enctype="multipart/form-data" >
                  <ul class="nav navbar-nav">         
                    <li>
                      <h3 class="box-title">    
                        <select class="form-control" style="width:100%;" id="wilayah">
                          <option value="">Pilih Wilayah</option>
                        <?php 
                        $tampil=mysql_query("SELECT ftKodeWilayah,ftNamaWilayah FROM tlwilayah WHERE fnStatus ='1'");
                        while($r=mysql_fetch_array($tampil)){
                          echo "<option value='$r[ftKodeWilayah]'>$r[ftNamaWilayah]</option>"; } ?> 
                        </select>          
                      </h3>
                    </li> 
                    <li>
                      <h3 class="box-title">
                          &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" class="btn bg-purple dropdown-toggle" value=<?php echo "$thn-$bln-$tgl"; ?>  name="fdTrans_date" id="fdTrans_date" value="Pilih Tanggal" readonly=true onchange="act_tgl()">
                      </h3>
                    </li>
          <!--		  <li>
                      <h3 class="box-title">
                          &nbsp;&nbsp;&nbsp;<span onclick=printContent("printr") class="label bg-purple">Print</span>
                      </h3>
                    </li> -->
                    <li>
                      <h3 class="box-title">&nbsp;&nbsp;&nbsp;
                          <button class="btnprint bg-purple"><span>Print</span></button>
                      </h3>
                    </li>					   
                </ul>
            </form>
              </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
    </div>
  </div>
	<!-- end header -->

<section class="content">
    <div class="row" id='printr'>       
        <section class="col-xs-12 connectedSortable" id="tes">   
        </section>
    </div>
</section>
	<?php  		  
     }
   }
 ?>

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
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

function act_tgl(){
  var kel=$('#wilayah').val();
  var tgl=$('#fdTrans_date').val();
   
    if (kel==""){
        swal({title: "Oops...",text: "Pilih Wilayah Dahulu!",type:"error",closeOnConfirm: false},
        function(){swal.close();$('#wilayah').focus();});
        return (false);
    }else{
        $.ajax({
        type: 'GET',
        url: 'modul/laporan_kas_harian_mikro/tampil.php ',
        data: 'allDate='+ tgl +' sampai '+ kel, 
          dataType: 'html',
          success: function(response) {
          $('#tes').html(response);
        }   
      })
    }
}  
</script>

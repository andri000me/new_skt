<?php
error_reporting(0);
include("modul/rekening_koran_rrp_ds_umum/form_tgl.php");
?>
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
 .btnsearch{
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

function getSearch(){	
	let txtSearch = document.getElementById("isSearch").value;
	var x = document.getElementById("tampil");
	if (txtSearch != ""){
	$.ajax({
			type: 'GET',
			url: 'modul/rekening_koran_tabungan_umum/tampil.php ',
			data: 'search='+ txtSearch , 
		    dataType: 'html',
		    success: function(response) {
				$('#tampil').html(response);
				result = $("#namaNasabah", response).text();
				if(result ==""){
					alert("Nomor Rekening Tidak Ditemukan");				
					x.style.display = "none";
				}else{
					x.style.display = "";
				}
			}
		});
	}else{
		alert("Input No Rekening");
	}
}

function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
<?php

//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
if(!empty($_SESSION['leveluser'])){  
	$base_url = $_SERVER['HTTP_HOST'];
	$iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
	$aksi="modul/users/aksi_users.php";
switch($_GET[act]){
default:
?>  
     <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       REKENING KORAN TABUNGAN UMUM        
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
                
				<li><h3 class="box-title">				
				  <input class="form-control" type="text" id="isSearch" placeholder="Search No Rekening" aria-label="Search">
				</h3></li>
				<li><h3 class="box-title">	 
				  <button class="btnsearch bg-purple" id="searchBtn" onclick="getSearch()">Search</button>				
                </h3></li>
			
					<li><h3 class="box-title">&nbsp;&nbsp;&nbsp;
					<button class="btnprint bg-purple"><span>Print</span></button>
					</h3></li>
				<!--	<li><h3 class="box-title">
                    &nbsp;&nbsp;&nbsp;<button class="btnexport bg-purple export" onclick="location.href='<?php 
					
					echo "excel/export_laporan_daftar_tagihan_umum.php";?>';" >
					<span>Export</span></button>
                    </h3></li>-->
					
                </ul>
              </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>		
      </header>
    </div>
  </div>
	
	<section class="content">
      <div class="row">
        <div class="col-xs-12">         
          <div class="box box-primary" id='printr'>
				<pre class="prettyprint" id="tampil">
				 </pre>			 
		  </div>         
        </div>        
      </div>     
    </section>	
    <section class="content">
      <div class="row">
        <div class="col-xs-12">       
        </div>       
      </div>     
    </section>
   
	 
	<?php  		  
   }
   }
  ?>

<script>
 var isSearch = document.getElementById("isSearch");
		isSearch.addEventListener("keyup", function(event) {
		  if (event.keyCode === 13) {
		   event.preventDefault();
		   document.getElementById("searchBtn").click();
		  }
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

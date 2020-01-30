<!DOCTYPE html>
<?php

include "../../config/config.php";
//include "controlprogress2.php";
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MMS | Manajemen Monitoring Sistem</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="modul/dashboard/style.css">
    <script src="js/jquery-1.8.3.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue fixed" data-spy="scroll" data-target="#scrollspy">
    <div class="wrapper">

       <header class="main-header">
        <!-- Logo -->
        <!-- Logo -->
        <a href="../index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">Monitoring Sistem</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
         <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li><a href="#">SIMBIKA</a></li>
              <li><a href="#">SIMTELS</a></li>
            </ul>
          </div>
          
        </nav>
      </header>
       <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <div class="sidebar" id="scrollspy">
			<center><img src="images/logo simbika.png" width="170px" ></center></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="nav sidebar-menu">
            <li class="header"><img src="images/Logo_Simtels.png" width="199x"> </li>
           </ul>
        </div>
        <!-- /.sidebar -->
      </aside>
     

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <h1>
            VIEW DATA KEUANGAN
            <small>MMS</small>
          </h1>
         
        </div>

        <!-- Main content -->
        <div class="content body">




         
            
            <!-- /.box-header -->
            <div class="box-body">
   <?php 		  

   $edit = mysql_query("SELECT * FROM tbl_keuangan a LEFT JOIN tbl_teknik b ON b.id_teknik=a.id_teknik  WHERE a.aktif='Y' AND a.id_keuangan='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
	if($r[nominal_gr]==''){
	$nominalgr=$r[nominal_gr];	
	}else{
	$nominalgr = number_format ($r[nominal_gr], 0, ',', '.');	
	}
	
	if($r[nominal_gr]==''){
	$nominalinvoice=$r[nominal_invoice];	
	}else{
	$nominalinvoice = number_format ($r[nominal_invoice], 0, ',', '.');
	}
	
	if($r[nominal_gr]==''){
	$nominalpembayaran=$r[nominal_pembayaran];	
	}else{
	$nominalpembayaran = number_format ($r[nominal_pembayaran], 0, ',', '.');
	}
	
	
	
?>	
<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Data Keuangan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		<?php
		echo"
		<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-editdata-keuangan.html' onSubmit='return validasi(this)'>
        <!-- /.box-header -->
		 
        <div class='box-body'>
		<input type='hidden' name=id value=$r[id_keuangan]>
          <div class='row'>
            <div class='col-md-6'>
			
			<div class='form-group'>
                <label>*</label>
				 <span class='form-control' disabled>$r[divisi]</span>
               
              </div>";?>
			<div class="form-group" id="no_in_user">
                  <label>No Internal User</label>
				  <span class='form-control' disabled><?php echo $r[no_in_user]; ?></span>
                  
                </div>
				<?php
			echo"
			 <div class='form-group'>
                  <label>No. GR</label>
				  <span class='form-control'>$r[no_gr]</span>
                 
                </div>
			 <div class='form-group'>
                <label>Tgl. GR</label>
                <div class='input-group date'>
                  <div class='input-group-addon'>
                    <i class='fa fa-calendar'></i>
                  </div>
				  <span class='form-control pull-right' >";if($r[tgl_gr]!='0000-00-00'){echo $r[tgl_gr]; }else{}  echo" </span>
                   </div>
                <!-- /.input group -->
              </div>"; 
			   $namafile = mysql_query("SELECT * FROM tbl_doc_gr a LEFT JOIN tbl_keuangan b ON b.id_keuangan=a.id_keuangan  WHERE b.id_keuangan='$_GET[id]'");
				$s  = mysql_fetch_array($namafile);
			  if($s[namafile]!=''){ 
			  ?>
			 <div class="form-group has-success" id="gr">
                  <label>Dokumen GR</label>
             
                <span  class="form-control">
				<?php if($s[namafile]!=''){ ?>
				
				<a href="file/file_gr/<?php echo $s[namafile] ?>" target="blank" title="View Dokumen GR" ><span style="color:green;font-weight:bold;">View</span></a>
				<?php	
				}else{
					echo"<span style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";
				}
				?>
			     </span>
               
             
            </div>
			<?php 
			  }else{
			?>
			 <div class="form-group has-error" id="gr">
                   <label>Dokumen GR</label>
             
                <span  class="form-control">
				<?php if($s[namafile]!=''){ ?>
				
				<a href="file/file_gr/<?php echo $s[namafile] ?>" target="blank" title="View Dokumen GR" ><span style="color:green;font-weight:bold;">View</span></a>
				<?php	
				}else{
					echo"<span style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";
				}
				?>
			     </span>
               
            </div>
			<?php 
			  }
			echo"
			
			
			<div class='form-group'>
                  <label>Nominal GR</label>
				  <span class='form-control'>";
				
				   echo" $nominalgr </span>
				  </div>
			<div class='form-group'>
                  <label>Status GR</label>
				   <span class='form-control'>$r[status_gr]</span>
                  
                </div>  
			
			 	
			<div class='form-group'>
                  <label>Catatan</label>
                  <textarea class='form-control' rows='5' name='catatan' placeholder='Input ...' disabled>$r[catatan]</textarea>
                </div>  
           
             
              <!-- /.form-group -->
            </div>
			
			
            <!-- /.col -->
            <div class='col-md-6'>
			
			<div class='form-group'>
                  <label>No SO</label>
				  <span class='form-control' disabled>$r[no_so]</span>
                  
                </div>
			<div class='form-group'>
                  <label>Judul Pekerjaan</label>
				  <textarea class='form-control' rows='3' name='judul_pekerjaan' placeholder='Input ...' disabled>$r[judul_pekerjaan]</textarea>
                  
                </div>  
			<div class='form-group'>
                  <label>No. Invoice</label>
				   <span class='form-control' >$r[no_invoice]</span>
                 
                </div>
			 <div class='form-group'>
                <label>Tgl. Invoice</label>
                <div class='input-group date'>
                  <div class='input-group-addon'>
                    <i class='fa fa-calendar'></i>
                  </div>
				   <span class='form-control pull-right' >";if($r[tgl_invoice]!='0000-00-00'){echo $r[tgl_invoice]; }else{}  echo" </span>
                 
                </div>
                <!-- /.input group -->
              </div>"; 
			   $namafile = mysql_query("SELECT * FROM tbl_doc_invoice a LEFT JOIN tbl_keuangan b ON b.id_keuangan=a.id_keuangan  WHERE b.id_keuangan='$_GET[id]'");
				$s  = mysql_fetch_array($namafile);
			  if($s[namafile]!=''){ 
			  ?>
			 <div class="form-group has-success" id="Invoice">
                  <label>Dokumen Invoice</label>
             
                <span  class="form-control">
				<?php if($s[namafile]!=''){ ?>
				
				<a href="file/file_invoice/<?php echo $s[namafile] ?>" target="blank" title="View Dokumen Invoice" ><span style="color:green;font-weight:bold;">View</span></a>
				<?php	
				}else{
					echo"<span style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";
				}
				?>
			     </span>
               
             
            </div>
			<?php 
			  }else{
			?>
			 <div class="form-group has-error" id="Invoice">
                   <label>Dokumen Invoice</label>
             
                <span  class="form-control">
				<?php if($s[namafile]!=''){ ?>
				
				<a href="file/file_invoice/<?php echo $s[namafile] ?>" target="blank" title="View Dokumen Invoice" ><span style="color:green;font-weight:bold;">View</span></a>
				<?php	
				}else{
					echo"<span style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";
				}
				?>
			     </span>
               
            </div>
			<?php 
			  }
			?>
			  
		<?php	echo"<div class='form-group'>
                  <label>Nominal Invoice</label>
				  <span class='form-control' >$nominalinvoice</span>
                 
                </div>
			<div class='form-group'>
                <label>Status Pembayaran</label>
				 <span class='form-control' >$r[status_pembayaran]</span>
                
              </div>
			 <div class='form-group'>
                <label>Tgl. Pembayaran</label>
                <div class='input-group date'>
                  <div class='input-group-addon'>
                    <i class='fa fa-calendar'></i>
                  </div>
				   <span class='form-control pull-right' >";if($r[tgl_pembayaran]!='0000-00-00'){echo $r[tgl_pembayaran]; }else{}  echo" </span>
                
                </div>
                <!-- /.input group -->
              </div>
			<div class='form-group'>
                  <label>Nominal Pembayaran</label>
				   <span class='form-control' >$nominalpembayaran</span>
                 
                </div>	  	
			<!-- /.form-group -->
            </div>
			
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class='box-footer'>
               
               
              </div>
		</form>
		";
		?>
		
      </div>
	<!-- END VIEW -->
            </div>
            <!-- /.box-body -->
         


        </div><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
         <strong>Copyright &copy; 2017 <a href="https://www.facebook.com/lambejeding" target="blank">Betron</a>.</strong> All rights
    reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <div class="pad">
          This is an example of the control sidebar.
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
    <script src="modul/dashboard/docs.js"></script>
  </body>
</html>


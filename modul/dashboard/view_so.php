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
            VIEW DATA TEKNIK
            <small>MMS</small>
          </h1>
         
        </div>

        <!-- Main content -->
        <div class="content body">




         
            
            <!-- /.box-header -->
            <div class="box-body">
   <?php 		  

   $edit = mysql_query("SELECT a.id_teknik,a.divisi,a.no_in_user,a.no_so,a.judul_pekerjaan,a.no_pkb,a.tgl_pkb,a.nominal,a.nama_pelaksana,a.nama_pelanggan,a.sbu,a.lain_lain,a.pemberi_kerja,a.layanan,a.progress_aktivasi,a.detail_progress,a.masa_berlaku_pekerjaan,a.kendala,a.detail_kendala,a.no_bai,a.tgl_bai,a.no_qc,a.tgl_qc,a.no_pkt,a.tgl_pkt,a.nominal_pkt,a.jenis_ba,a.no_bast, a.tgl_bast,a.rincian_bauk,a.no_bauk,a.tgl_bauk,a.rincian_bauk2,a.no_bauk2,a.tgl_bauk2,a.rincian_bauk3,a.no_bauk3,a.tgl_bauk3,a.rincian_bauk4,a.no_bauk4,a.tgl_bauk4,a.rincian_bauk5,a.no_bauk5,a.tgl_bauk5,a.rincian_bauk6,a.no_bauk6,a.tgl_bauk6,a.rincian_bauk7,a.no_bauk7,a.tgl_bauk7,a.rincian_bauk8,a.no_bauk8,a.tgl_bauk8,a.rincian_bauk9,a.no_bauk9,a.tgl_bauk9,a.rincian_bauk10,a.no_bauk10,a.tgl_bauk10,a.rincian_bauk11,a.no_bauk11,a.tgl_bauk11,a.rincian_bauk12,a.no_bauk12,a.tgl_bauk12,a.region,b.namafile AS file_so,c.namafile AS file_pkb,d.namafile AS file_bai,e.namafile AS file_qc,f.namafile AS file_pkt,g.namafile AS file_baps,h.namafile AS file_bauk,i.namafile AS file_bauk2,j.namafile AS file_bauk3,k.namafile AS file_bauk4,l.namafile AS file_bauk5,m.namafile AS file_bauk6,n.namafile AS file_bauk7,o.namafile AS file_bauk8,p.namafile AS file_bauk9,q.namafile AS file_bauk10,r.namafile AS file_bauk11,s.namafile AS file_bauk12
   
   FROM tbl_teknik a 
   LEFT JOIN tbl_doc_so b ON b.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_pkb c ON c.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bai d ON d.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_qc e ON e.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_pkt f ON f.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_baps g ON g.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk h ON h.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk2 i ON i.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk3 j ON j.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk4 k ON k.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk5 l ON l.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk6 m ON m.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk7 n ON n.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk8 o ON o.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk9 p ON p.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk10 q ON q.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk11 r ON r.id_teknik=a.id_teknik 
   LEFT JOIN tbl_doc_bauk12 s ON s.id_teknik=a.id_teknik 
   
   WHERE a.id_teknik='$_GET[id]' ");
    $r    = mysql_fetch_array($edit);
	
?>	
<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">View Data Teknik</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		<form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-editdata-teknik.html" onSubmit="return validasi(this)">
        <!-- /.box-header -->
        <div class="box-body" id="myForm">
		 <input type="hidden" name="id" value="<?php echo $r[id_teknik];?>" >
          <div class="row">
            <div class="col-md-6">
			<?php
			echo"<div class='form-group'>
                <label>*</label>
               <span class='form-control'>$r[divisi]</span>
              </div>";?>
			
			<div class="form-group" id="no_so22">
                  <label>No SO</label>
                  <span class="form-control" id="no_so"  ><?php echo $r[no_so]; ?></span>
                </div>
				
			<div class="form-group" id="no_so22">
                  <label>Dokumen SO</label>
             	<?php if($r[file_so]!=''){ ?>
				<span  class="form-control"><a href="file/file_so/<?php echo $r[file_so] ?>" target="blank" title="View Dokumen SO" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";}	?>
			</div>	
			
			<div class="form-group">
                  <label>Judul Pekerjaan</label>
                   <textarea class="form-control" rows="3" name="judul_pekerjaan" id="judul_pekerjaan" placeholder="Input ..." disabled><?php echo $r[judul_pekerjaan]; ?></textarea>
                </div>  
			 <div class="form-group">
                  <label>No. PKB/No PR</label>
                  <span class="form-control"  ><?php echo $r[no_pkb]; ?></span>
                </div>
				
			<div class="form-group" >
                  <label>Dokumen PKB</label>
             	<?php if($r[file_pkb]!=''){ ?>
				<span  class="form-control"><a href="file/file_pkb/<?php echo $r[file_pkb] ?>" target="blank" title="View Dokumen PKB" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			
			 <div class="form-group">
                <label>Tgl. PKB/Tgl. PR</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <span class="form-control pull-right" ><?php echo $r[tgl_pkb]; ?></span>
                </div>
                <!-- /.input group -->
              </div>
			<div class="form-group">
                  <label>Nominal</label>
                  <span class="form-control"> <?php
				$nominal = number_format ($r[nominal], 0, ',', '.');
				  echo $nominal; ?></span>
                </div>
			<div class="form-group">
                  <label>Nama Pelaksana Pekerjaan</label>
                  <span class="form-control"  ><?php echo $r[nama_pelaksana]; ?></span>
                </div>  
				<?php
			echo"<div class='form-group'>
                <label>Nama Pelanggan</label>
                 <span class='form-control'  > $r[nama_pelanggan]</span>
              </div>
			<div class='form-group'>
                <label>SBU</label>
                 <span class='form-control'  > $r[sbu]</span>
              </div>";
				?>
			  
			 <div class="form-group">
                  <label>Lain-lain</label>
                    <span class="form-control"  ><?php echo $r[lain_lain]; ?></span>
                </div>	
			<div class="form-group">
                <label>Nama PIC Pemberi Kerja</label>
				  <span class="form-control"  ><?php echo $r[pemberi_kerja]; ?></span>
              </div>	
			<div class="form-group">
                <label>Layanan</label>
                <span class="form-control"  ><?php echo $r[layanan]; ?></span>
              </div>	  
			 <div class="form-group" id="progress_aktivasi2">
                <label>Progress Aktivasi</label>
                 <span class="form-control"  ><?php echo $r[progress_aktivasi]; ?></span>
				<span  id="animasi" style="color:red;"></span>
              </div>	
			<div class="form-group">
                  <label>Detail Progress</label>
                  <textarea class="form-control" rows="7" name="detail_progress" id="detail_progress" placeholder="Input ..." disabled><?php echo $r[detail_progress]; ?></textarea>
                </div>  
				
			
				 <div class="form-group has-success"  id="rincian_baukk">
                  <label>Rincian BAUK</label>
                    <span class="form-control"  ><?php echo $r[rincian_bauk]; ?></span>
                </div>
			<div class="form-group has-success" id="no_baukk" >
                  <label>No BAUK</label>
                   <span class="form-control"  ><?php echo $r[no_bauk]; ?></span>
                </div>
				
			 <div class="form-group has-success" id="tgl_baukk" >
                <label>Tanggal BAUK</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <span class="form-control pull-right"  ><?php echo $r[tgl_bauk]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 
			 	
			<div class="form-group has-success"  id="doc_baukk" >
                  <label>Dokumen BAUK</label>
             	<?php if($r[file_bauk]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk/<?php echo $r[file_bauk] ?>" target="blank" title="View Dokumen BAUK" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			 
			    <div class="form-group has-error" id="rincian_bauk33" >
                  <label>Rincian BAUK 3</label>
                  <span class="form-control"  ><?php echo $r[rincian_bauk3]; ?></span>
                </div>
			<div class="form-group has-error" id="no_bauk33" >
                  <label>No BAUK 3</label>
                  <span class="form-control"  ><?php echo $r[no_bauk3]; ?></span>
                </div>
			 <div class="form-group has-error" id="tgl_bauk33">
                <label>Tanggal BAUK 3</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                   <span class="form-control pull-right"  ><?php echo $r[tgl_bauk3]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
			 	
			<div class="form-group has-error" id="doc_bauk33" >
                  <label>Dokumen BAUK 3</label>
             	<?php if($r[file_bauk3]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk3/<?php echo $r[file_bauk3] ?>" target="blank" title="View Dokumen BAUK 3" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			  
			    <div class="form-group has-warning" id="rincian_bauk55" >
                  <label>Rincian BAUK 5</label>
                   <span class="form-control"  ><?php echo $r[rincian_bauk5]; ?></span>
                </div>
			<div class="form-group has-warning" id="no_bauk55" >
                  <label>No BAUK 5</label>
                  <span class="form-control"  ><?php echo $r[no_bauk5]; ?></span>
                </div>
			 <div class="form-group has-warning" id="tgl_bauk55">
                <label>Tanggal BAUK 5</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <span class="form-control pull-right"  ><?php echo $r[tgl_bauk5]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
			  	
			<div class="form-group has-warning" id="doc_bauk55" >
                  <label>Dokumen BAUK 5</label>
             	<?php if($r[file_bauk5]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk5/<?php echo $r[file_bauk5] ?>" target="blank" title="View Dokumen BAUK 5" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			   
               <div class="form-group has-success" id="rincian_bauk77"  >
                  <label>Rincian BAUK 7</label>
                  <span class="form-control"  ><?php echo $r[rincian_bauk7]; ?></span>
                </div>
			<div class="form-group has-success" id="no_bauk77">
                  <label>No BAUK 7</label>
                  <span class="form-control"  ><?php echo $r[no_bauk7]; ?></span>
                </div>
			 <div class="form-group has-success" id="tgl_bauk77">
                <label>Tanggal BAUK 7</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                   <span class="form-control pull-right"  ><?php echo $r[tgl_bauk7]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
			  	
			  	
			<div class="form-group has-success" id="doc_bauk77" >
                  <label>Dokumen BAUK 7</label>
             	<?php if($r[file_bauk7]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk7/<?php echo $r[file_bauk7] ?>" target="blank" title="View Dokumen BAUK 7" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			 
			   <div class="form-group has-error" id="rincian_bauk99" >
                  <label>Rincian BAUK 9</label>
                  <span class="form-control"  ><?php echo $r[rincian_bauk9]; ?></span>
                </div>
			<div class="form-group has-error" id="no_bauk99" >
                  <label>No BAUK 9</label>
                   <span class="form-control"  ><?php echo $r[no_bauk9]; ?></span>
                </div>
			 <div class="form-group has-error" id="tgl_bauk99">
                <label>Tanggal BAUK 9</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <span class="form-control pull-right"  ><?php echo $r[tgl_bauk9]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
			  	
			<div class="form-group has-error" id="doc_bauk99" >
                  <label>Dokumen BAUK 9</label>
             	<?php if($r[file_bauk9]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk9/<?php echo $r[file_bauk9] ?>" target="blank" title="View Dokumen BAUK 9" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			   
			   <div class="form-group has-warning" id="rincian_bauk111" >
                  <label>Rincian BAUK 11</label>
                  <span class="form-control"  ><?php echo $r[rincian_bauk11]; ?></span>
                </div>
			<div class="form-group has-warning" id="no_bauk111" >
                  <label>No BAUK 11</label>
                   <span class="form-control"  ><?php echo $r[no_bauk11]; ?></span>
                </div>
			 <div class="form-group has-warning" id="tgl_bauk111">
                <label>Tanggal BAUK 11</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                   <span class="form-control pull-right"  ><?php echo $r[tgl_bauk11]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
			  	
			<div class="form-group has-warning" id="doc_bauk111" >
                  <label>Dokumen BAUK 11</label>
             	<?php if($r[file_bauk11]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk11/<?php echo $r[file_bauk11] ?>" target="blank" title="View Dokumen BAUK 11" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			 
             
              <!-- /.form-group -->
            </div>
			
			
            <!-- /.RIGHT SIDE -->
            <div class="col-md-6">
			
			<div class="form-group" id="no_in_user">
                  <label>No Internal User</label>
                  <span class="form-control"  ><?php echo $r[no_in_user]; ?></span>
                </div>
				
			 <div class="form-group">
                <label>Masa Berlaku Pekerjaan</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                 <span class="form-control pull-right"  ><?php echo $r[masa_berlaku_pekerjaan]; ?></span>
                </div>
                <!-- /.input group -->
              </div>
			  
			 <div class="form-group">
                <label>Kendala</label>
                <span class="form-control "  ><?php echo $r[kendala]; ?></span>
              </div>
			<div class="form-group">
                  <label>Detail Kendala</label>
                  <textarea class="form-control" rows="3" name="detail_kendala" id="detail_kendala" placeholder="Input ..." disabled><?php echo $r[detail_kendala]; ?> </textarea>
                </div>  
			  
              <div class="form-group">
                  <label>No BAI</label>
                 <span class="form-control "  ><?php echo $r[no_bai]; ?></span>
                </div>
				
			<div class="form-group" id="no_so22">
                  <label>Dokumen BAI</label>
             	<?php if($r[file_bai]!=''){ ?>
				<span  class="form-control"><a href="file/file_bai/<?php echo $r[file_bai] ?>" target="blank" title="View Dokumen BAI" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";}	?>
			</div>	
				
			 <div class="form-group">
                <label>Tanggal BAI</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                 <span class="form-control pull-right"  ><?php echo $r[tgl_bai]; ?></span>
                </div>
                <!-- /.input group -->
              </div>	
			
             <div class="form-group">
                  <label>No QC</label>
                  <span class="form-control "  ><?php echo $r[no_qc]; ?></span>
                </div>
				
			<div class="form-group" id="no_so22">
                  <label>Dokumen QC</label>
             	<?php if($r[file_qc]!=''){ ?>
				<span  class="form-control input-sm"><a href="file/file_qc/<?php echo $r[file_qc] ?>" target="blank" title="View Dokumen QC" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control input-sm' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";}	?>
			</div>	
				
			 <div class="form-group">
                <label>Tanggal QC</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                 <span class="form-control pull-right"  ><?php echo $r[tgl_qc]; ?></span>
                </div>
                <!-- /.input group -->
              </div>
			<div class="form-group">
                  <label>No PKT</label>
                 <span class="form-control "  ><?php echo $r[no_pkt]; ?></span>
                </div>
				
			<div class="form-group" id="no_so22">
                  <label>Dokumen PKT</label>
             	<?php if($r[file_pkt]!=''){ ?>
				<span  class="form-control input-sm"><a href="file/file_pkt/<?php echo $r[file_pkt] ?>" target="blank" title="View Dokumen PKT" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control input-sm' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";}	?>
			</div>	
				
			 <div class="form-group">
                <label>Tanggal PKT</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <span class="form-control pull-right"  ><?php echo $r[tgl_pkt]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 
			<div class="form-group">
                  <label>Nominal PKT</label>
                   <span class="form-control "  ><?php 
				   $nominalpkt = number_format ($r[nominal_pkt], 0, ',', '.');
				   echo $nominalpkt; ?></span>
                </div>  
			 <div class="form-group">
                <label>Jenis BA</label>
                <span class="form-control "  ><?php echo $r[jenis_ba]; ?></span>
              </div>  
				 <div class="form-group">
                  <label>No BAST/ BAPS</label>
                   <span class="form-control "  ><?php echo $r[no_bast]; ?></span>
                </div>
				
			<div class="form-group" id="no_so22">
                  <label>Dokumen BAST/ BAPS</label>
             	<?php if($r[file_baps]!=''){ ?>
				<span  class="form-control input-sm"><a href="file/file_baps/<?php echo $r[file_baps] ?>" target="blank" title="View Dokumen BAPS" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";}	?>
			</div>	
				
			 <div class="form-group">
                <label>Tanggal BAST/ BAPS</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                   <span class="form-control pull-right"  ><?php echo $r[tgl_bast]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
		
			  
			<div class="form-group has-warning" id="rincian_bauk22" >
                  <label>Rincian BAUK 2</label>
                   <span class="form-control "  ><?php echo $r[rincian_bauk2]; ?></span>
                </div>
			<div class="form-group has-warning" id="no_bauk22" >
                  <label>No BAUK 2</label>
                  <span class="form-control "  ><?php echo $r[no_bauk2]; ?></span>
                </div>
			 <div class="form-group has-warning"  id="tgl_bauk22">
                <label>Tanggal BAUK 2</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <span class="form-control pull-right"  ><?php echo $r[tgl_bauk2]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
			  	
			<div class="form-group has-warning" id="doc_bauk22" >
                  <label>Dokumen BAUK 2</label>
             	<?php if($r[file_bauk2]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk2/<?php echo $r[file_bauk2] ?>" target="blank" title="View Dokumen BAUK 2" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			   
			
			  
			   <div class="form-group has-success" id="rincian_bauk44" >
                  <label>Rincian BAUK 4</label>
                  <span class="form-control "  ><?php echo $r[rincian_bauk4]; ?></span>
                </div>
			<div class="form-group has-success" id="no_bauk44" >
                  <label>No BAUK 4</label>
                 <span class="form-control"  ><?php echo $r[no_bauk4]; ?></span>
                </div>
				
			 <div class="form-group has-success" id="tgl_bauk44">
                <label>Tanggal BAUK 4</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <span class="form-control pull-right"  ><?php echo $r[tgl_bauk4]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
			   	
			<div class="form-group has-success" id="doc_bauk44" >
                  <label>Dokumen BAUK 4</label>
             	<?php if($r[file_bauk4]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk4/<?php echo $r[file_bauk4] ?>" target="blank" title="View Dokumen BAUK 4" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			   
			
			   <div class="form-group has-error" id="rincian_bauk66" >
                  <label>Rincian BAUK 6</label>
                 <span class="form-control"  ><?php echo $r[rincian_bauk6]; ?></span>
                </div>
			<div class="form-group has-error" id="no_bauk66" >
                  <label>No BAUK 6</label>
                    <span class="form-control"  ><?php echo $r[no_bauk6]; ?></span>
                </div>
			 <div class="form-group has-error"  id="tgl_bauk66">
                <label>Tanggal BAUK 6</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                   <span class="form-control pull-right"  ><?php echo $r[tgl_bauk6]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
			   	
			<div class="form-group has-error" id="doc_bauk66" >
                  <label>Dokumen BAUK 6</label>
             	<?php if($r[file_bauk6]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk6/<?php echo $r[file_bauk6] ?>" target="blank" title="View Dokumen BAUK 6" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			   
			 
			   <div class="form-group has-warning" id="rincian_bauk88" >
                  <label>Rincian BAUK 8</label>
                   <span class="form-control"  ><?php echo $r[rincian_bauk8]; ?></span>
                </div>
			<div class="form-group has-warning" id="no_bauk88" >
                  <label>No BAUK 8</label>
                    <span class="form-control"  ><?php echo $r[no_bauk8]; ?></span>
                </div>
			 <div class="form-group has-warning" id="tgl_bauk88">
                <label>Tanggal BAUK 8</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <span class="form-control pull-right"  ><?php echo $r[tgl_bauk8]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
			  	
			<div class="form-group has-warning" id="doc_bauk88" >
                  <label>Dokumen BAUK 8</label>
             	<?php if($r[file_bauk8]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk8/<?php echo $r[file_bauk8] ?>" target="blank" title="View Dokumen BAUK 8" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			   
			
			   <div class="form-group has-success" id="rincian_bauk100" >
                  <label>Rincian BAUK 10</label>
                    <span class="form-control"  ><?php echo $r[rincian_bauk10]; ?></span>
                </div>
			<div class="form-group has-success" id="no_bauk100" >
                  <label>No BAUK 10</label>
                   <span class="form-control"  ><?php echo $r[no_bauk10]; ?></span>
                </div>
			 <div class="form-group has-success" id="tgl_bauk100">
                <label>Tanggal BAUK 10</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                   <span class="form-control pull-right"  ><?php echo $r[tgl_bauk10]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
			   	
			<div class="form-group has-success" id="doc_bauk100" >
                  <label>Dokumen BAUK 10</label>
             	<?php if($r[file_bauk10]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk10/<?php echo $r[file_bauk10] ?>" target="blank" title="View Dokumen BAUK 10" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			   
			 
			 
			   <div class="form-group has-error" id="rincian_bauk122" >
                  <label>Rincian BAUK 12</label>
                    <span class="form-control"  ><?php echo $r[rincian_bauk12]; ?></span>
                </div>
			<div class="form-group has-error" id="no_bauk122" >
                  <label>No BAUK 12</label>
                   <span class="form-control"  ><?php echo $r[no_bauk12]; ?></span>
                </div>
			 <div class="form-group has-error" id="tgl_bauk122">
                <label>Tanggal BAUK 12</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                   <span class="form-control pull-right"  ><?php echo $r[tgl_bauk12]; ?></span>
                </div>
                <!-- /.input group -->
              </div> 	
			  	
			<div class="form-group has-error" id="doc_bauk122" >
                  <label>Dokumen BAUK 12</label>
             	<?php if($r[file_bauk12]!=''){ ?>
				<span  class="form-control"><a href="file/file_bauk12/<?php echo $r[file_bauk12] ?>" target="blank" title="View Dokumen BAUK 12" ><span style="color:green;font-weight:bold;">View</span></a></span>
				<?php	
				}else{ echo"<span class='form-control' style='color:red;font-weight:bold;'>Dokumen Belum ada</span>";} ?>
			</div>
			  
			     
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class="box-footer">
                
               
              </div>
		</form>
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

<?php

$edit = mysql_query("SELECT * FROM tbl_teknik WHERE id_teknik='$_GET[id]'");
$r    = mysql_fetch_array($edit); 
if($r[layanan]=='Sewa & Jasa Pelayanan'){
?>
 <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
    
$(document).ready(function() {

	rincian_baukk.hidden = false;
    no_baukk.hidden = false;
	tgl_baukk.hidden = false;
	rincian_bauk22.hidden = false;
    no_bauk22.hidden = false;
	tgl_bauk22.hidden = false;
	rincian_bauk33.hidden = false;
    no_bauk33.hidden = false;
	tgl_bauk33.hidden = false;
	rincian_bauk44.hidden = false;
    no_bauk44.hidden = false;
	tgl_bauk44.hidden = false;
	rincian_bauk55.hidden = false;
    no_bauk55.hidden = false;
	tgl_bauk55.hidden = false;
	rincian_bauk66.hidden = false;
    no_bauk66.hidden = false;
	tgl_bauk66.hidden = false;
	rincian_bauk77.hidden = false;
    no_bauk77.hidden = false;
	tgl_bauk77.hidden = false;
	rincian_bauk88.hidden = false;
    no_bauk88.hidden = false;
	tgl_bauk88.hidden = false;
	rincian_bauk99.hidden = false;
    no_bauk99.hidden = false;
	tgl_bauk99.hidden = false;
	rincian_bauk100.hidden = false;
    no_bauk100.hidden = false;
	tgl_bauk100.hidden = false;
	rincian_bauk111.hidden = false;
    no_bauk111.hidden = false;
	tgl_bauk111.hidden = false;
	rincian_bauk122.hidden = false;
    no_bauk122.hidden = false;
	tgl_bauk122.hidden = false;
	doc_baukk.hidden = false;
	doc_bauk22.hidden = false;
	doc_bauk33.hidden = false;
	doc_bauk44.hidden = false;
	doc_bauk55.hidden = false;
	doc_bauk66.hidden = false;
	doc_bauk77.hidden = false;
	doc_bauk88.hidden = false;
	doc_bauk99.hidden = false;
	doc_bauk100.hidden = false;
	doc_bauk111.hidden = false;
	doc_bauk122.hidden = false;
	
	$('#layanan').change(function() { 
	var elem = document.getElementById("myForm");
	if(elem.layanan.value == "Aktivasi"){
	rincian_baukk.hidden = true;
    no_baukk.hidden = true;
	tgl_baukk.hidden = true;	
	rincian_bauk22.hidden = true;
    no_bauk22.hidden = true;
	tgl_bauk22.hidden = true;
	rincian_bauk33.hidden = true;
    no_bauk33.hidden = true;
	tgl_bauk33.hidden = true;
	rincian_bauk44.hidden = true;
    no_bauk44.hidden = true;
	tgl_bauk44.hidden = true;
	rincian_bauk55.hidden = true;
    no_bauk55.hidden = true;
	tgl_bauk55.hidden = true;
	rincian_bauk66.hidden = true;
    no_bauk66.hidden = true;
	tgl_bauk66.hidden = true;
	rincian_bauk77.hidden = true;
    no_bauk77.hidden = true;
	tgl_bauk77.hidden = true;
	rincian_bauk88.hidden = true;
    no_bauk88.hidden = true;
	tgl_bauk88.hidden = true;
	rincian_bauk99.hidden = true;
    no_bauk99.hidden = true;
	tgl_bauk99.hidden = true;
	rincian_bauk100.hidden = true;
    no_bauk100.hidden = true;
	tgl_bauk100.hidden = true;
	rincian_bauk111.hidden = true;
    no_bauk111.hidden = true;
	tgl_bauk111.hidden = true;
	rincian_bauk122.hidden = true;
    no_bauk122.hidden = true;
	tgl_bauk122.hidden = true;	
	doc_baukk.hidden = true;
	doc_bauk22.hidden = true;
	doc_bauk33.hidden = true;
	doc_bauk44.hidden = true;
	doc_bauk55.hidden = true;
	doc_bauk66.hidden = true;
	doc_bauk77.hidden = true;
	doc_bauk88.hidden = true;
	doc_bauk99.hidden = true;
	doc_bauk100.hidden = true;
	doc_bauk111.hidden = true;
	doc_bauk122.hidden = true;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});	
	}else if(elem.layanan.value == "Supply Material"){
			rincian_baukk.hidden = true;
			no_baukk.hidden = true;
			tgl_baukk.hidden = true;	
			rincian_bauk22.hidden = true;
			no_bauk22.hidden = true;
			tgl_bauk22.hidden = true;
			rincian_bauk33.hidden = true;
			no_bauk33.hidden = true;
			tgl_bauk33.hidden = true;
			rincian_bauk44.hidden = true;
			no_bauk44.hidden = true;
			tgl_bauk44.hidden = true;
			rincian_bauk55.hidden = true;
			no_bauk55.hidden = true;
			tgl_bauk55.hidden = true;
			rincian_bauk66.hidden = true;
			no_bauk66.hidden = true;
			tgl_bauk66.hidden = true;
			rincian_bauk77.hidden = true;
			no_bauk77.hidden = true;
			tgl_bauk77.hidden = true;
			rincian_bauk88.hidden = true;
			no_bauk88.hidden = true;
			tgl_bauk88.hidden = true;
			rincian_bauk99.hidden = true;
			no_bauk99.hidden = true;
			tgl_bauk99.hidden = true;
			rincian_bauk100.hidden = true;
			no_bauk100.hidden = true;
			tgl_bauk100.hidden = true;
			rincian_bauk111.hidden = true;
			no_bauk111.hidden = true;
			tgl_bauk111.hidden = true;
			rincian_bauk122.hidden = true;
			no_bauk122.hidden = true;
			tgl_bauk122.hidden = true;	
			doc_baukk.hidden = true;
			doc_bauk22.hidden = true;
			doc_bauk33.hidden = true;
			doc_bauk44.hidden = true;
			doc_bauk55.hidden = true;
			doc_bauk66.hidden = true;
			doc_bauk77.hidden = true;
			doc_bauk88.hidden = true;
			doc_bauk99.hidden = true;
			doc_bauk100.hidden = true;
			doc_bauk111.hidden = true;
			doc_bauk122.hidden = true;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog2.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}else  if(elem.layanan.value == "Sewa & Jasa Pelayanan"){
		
		rincian_baukk.hidden = false;
		no_baukk.hidden = false;
		tgl_baukk.hidden = false;
		rincian_bauk22.hidden = false;
		no_bauk22.hidden = false;
		tgl_bauk22.hidden = false;
		rincian_bauk33.hidden = false;
		no_bauk33.hidden = false;
		tgl_bauk33.hidden = false;
		rincian_bauk44.hidden = false;
		no_bauk44.hidden = false;
		tgl_bauk44.hidden = false;
		rincian_bauk55.hidden = false;
		no_bauk55.hidden = false;
		tgl_bauk55.hidden = false;
		rincian_bauk66.hidden = false;
		no_bauk66.hidden = false;
		tgl_bauk66.hidden = false;
		rincian_bauk77.hidden = false;
		no_bauk77.hidden = false;
		tgl_bauk77.hidden = false;
		rincian_bauk88.hidden = false;
		no_bauk88.hidden = false;
		tgl_bauk88.hidden = false;
		rincian_bauk99.hidden = false;
		no_bauk99.hidden = false;
		tgl_bauk99.hidden = false;
		rincian_bauk100.hidden = false;
		no_bauk100.hidden = false;
		tgl_bauk100.hidden = false;
		rincian_bauk111.hidden = false;
		no_bauk111.hidden = false;
		tgl_bauk111.hidden = false;
		rincian_bauk122.hidden = false;
		no_bauk122.hidden = false;
		tgl_bauk122.hidden = false;	
		doc_baukk.hidden = false;
		doc_bauk22.hidden = false;
		doc_bauk33.hidden = false;
		doc_bauk44.hidden = false;
		doc_bauk55.hidden = false;
		doc_bauk66.hidden = false;
		doc_bauk77.hidden = false;
		doc_bauk88.hidden = false;
		doc_bauk99.hidden = false;
		doc_bauk100.hidden = false;
		doc_bauk111.hidden = false;
		doc_bauk122.hidden = false;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog3.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}else  if(elem.layanan.value == ""){
		rincian_bauk22.hidden = true;
    no_bauk22.hidden = true;
	tgl_bauk22.hidden = true;
	rincian_bauk33.hidden = true;
    no_bauk33.hidden = true;
	tgl_bauk33.hidden = true;
	rincian_bauk44.hidden = true;
    no_bauk44.hidden = true;
	tgl_bauk44.hidden = true;
	rincian_bauk55.hidden = true;
    no_bauk55.hidden = true;
	tgl_bauk55.hidden = true;
	rincian_bauk66.hidden = true;
    no_bauk66.hidden = true;
	tgl_bauk66.hidden = true;
	rincian_bauk77.hidden = true;
    no_bauk77.hidden = true;
	tgl_bauk77.hidden = true;
	rincian_bauk88.hidden = true;
    no_bauk88.hidden = true;
	tgl_bauk88.hidden = true;
	rincian_bauk99.hidden = true;
    no_bauk99.hidden = true;
	tgl_bauk99.hidden = true;
	rincian_bauk100.hidden = true;
    no_bauk100.hidden = true;
	tgl_bauk100.hidden = true;
	rincian_bauk111.hidden = true;
    no_bauk111.hidden = true;
	tgl_bauk111.hidden = true;
	rincian_bauk122.hidden = true;
    no_bauk122.hidden = true;
	tgl_bauk122.hidden = true;
	doc_baukk.hidden = true;
	doc_bauk22.hidden = true;
	doc_bauk33.hidden = true;
	doc_bauk44.hidden = true;
	doc_bauk55.hidden = true;
	doc_bauk66.hidden = true;
	doc_bauk77.hidden = true;
	doc_bauk88.hidden = true;
	doc_bauk99.hidden = true;
	doc_bauk100.hidden = true;
	doc_bauk111.hidden = true;
	doc_bauk122.hidden = true;
	
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog4.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}
    });
});

</script>

<?php
}else{
?>

 <script type="text/javascript">
    
$(document).ready(function() {

	rincian_baukk.hidden = true;
    no_baukk.hidden = true;
	tgl_baukk.hidden = true;
	rincian_bauk22.hidden = true;
    no_bauk22.hidden = true;
	tgl_bauk22.hidden = true;
	rincian_bauk33.hidden = true;
    no_bauk33.hidden = true;
	tgl_bauk33.hidden = true;
	rincian_bauk44.hidden = true;
    no_bauk44.hidden = true;
	tgl_bauk44.hidden = true;
	rincian_bauk55.hidden = true;
    no_bauk55.hidden = true;
	tgl_bauk55.hidden = true;
	rincian_bauk66.hidden = true;
    no_bauk66.hidden = true;
	tgl_bauk66.hidden = true;
	rincian_bauk77.hidden = true;
    no_bauk77.hidden = true;
	tgl_bauk77.hidden = true;
	rincian_bauk88.hidden = true;
    no_bauk88.hidden = true;
	tgl_bauk88.hidden = true;
	rincian_bauk99.hidden = true;
    no_bauk99.hidden = true;
	tgl_bauk99.hidden = true;
	rincian_bauk100.hidden = true;
    no_bauk100.hidden = true;
	tgl_bauk100.hidden = true;
	rincian_bauk111.hidden = true;
    no_bauk111.hidden = true;
	tgl_bauk111.hidden = true;
	rincian_bauk122.hidden = true;
    no_bauk122.hidden = true;
	tgl_bauk122.hidden = true;
	doc_baukk.hidden = true;
	doc_bauk22.hidden = true;
	doc_bauk33.hidden = true;
	doc_bauk44.hidden = true;
	doc_bauk55.hidden = true;
	doc_bauk66.hidden = true;
	doc_bauk77.hidden = true;
	doc_bauk88.hidden = true;
	doc_bauk99.hidden = true;
	doc_bauk100.hidden = true;
	doc_bauk111.hidden = true;
	doc_bauk122.hidden = true;
	
	
	$('#layanan').change(function() { 
	var elem = document.getElementById("myForm");
	if(elem.layanan.value == "Aktivasi"){
	rincian_baukk.hidden = true;
    no_baukk.hidden = true;
	tgl_baukk.hidden = true;	
	rincian_bauk22.hidden = true;
    no_bauk22.hidden = true;
	tgl_bauk22.hidden = true;
	rincian_bauk33.hidden = true;
    no_bauk33.hidden = true;
	tgl_bauk33.hidden = true;
	rincian_bauk44.hidden = true;
    no_bauk44.hidden = true;
	tgl_bauk44.hidden = true;
	rincian_bauk55.hidden = true;
    no_bauk55.hidden = true;
	tgl_bauk55.hidden = true;
	rincian_bauk66.hidden = true;
    no_bauk66.hidden = true;
	tgl_bauk66.hidden = true;
	rincian_bauk77.hidden = true;
    no_bauk77.hidden = true;
	tgl_bauk77.hidden = true;
	rincian_bauk88.hidden = true;
    no_bauk88.hidden = true;
	tgl_bauk88.hidden = true;
	rincian_bauk99.hidden = true;
    no_bauk99.hidden = true;
	tgl_bauk99.hidden = true;
	rincian_bauk100.hidden = true;
    no_bauk100.hidden = true;
	tgl_bauk100.hidden = true;
	rincian_bauk111.hidden = true;
    no_bauk111.hidden = true;
	tgl_bauk111.hidden = true;
	rincian_bauk122.hidden = true;
    no_bauk122.hidden = true;
	tgl_bauk122.hidden = true;
	doc_baukk.hidden = true;
	doc_bauk22.hidden = true;
	doc_bauk33.hidden = true;
	doc_bauk44.hidden = true;
	doc_bauk55.hidden = true;
	doc_bauk66.hidden = true;
	doc_bauk77.hidden = true;
	doc_bauk88.hidden = true;
	doc_bauk99.hidden = true;
	doc_bauk100.hidden = true;
	doc_bauk111.hidden = true;
	doc_bauk122.hidden = true;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});	
	}else if(elem.layanan.value == "Supply Material"){
			rincian_baukk.hidden = true;
			no_baukk.hidden = true;
			tgl_baukk.hidden = true;	
			rincian_bauk22.hidden = true;
			no_bauk22.hidden = true;
			tgl_bauk22.hidden = true;
			rincian_bauk33.hidden = true;
			no_bauk33.hidden = true;
			tgl_bauk33.hidden = true;
			rincian_bauk44.hidden = true;
			no_bauk44.hidden = true;
			tgl_bauk44.hidden = true;
			rincian_bauk55.hidden = true;
			no_bauk55.hidden = true;
			tgl_bauk55.hidden = true;
			rincian_bauk66.hidden = true;
			no_bauk66.hidden = true;
			tgl_bauk66.hidden = true;
			rincian_bauk77.hidden = true;
			no_bauk77.hidden = true;
			tgl_bauk77.hidden = true;
			rincian_bauk88.hidden = true;
			no_bauk88.hidden = true;
			tgl_bauk88.hidden = true;
			rincian_bauk99.hidden = true;
			no_bauk99.hidden = true;
			tgl_bauk99.hidden = true;
			rincian_bauk100.hidden = true;
			no_bauk100.hidden = true;
			tgl_bauk100.hidden = true;
			rincian_bauk111.hidden = true;
			no_bauk111.hidden = true;
			tgl_bauk111.hidden = true;
			rincian_bauk122.hidden = true;
			no_bauk122.hidden = true;
			tgl_bauk122.hidden = true;	
			doc_baukk.hidden = true;
			doc_bauk22.hidden = true;
			doc_bauk33.hidden = true;
			doc_bauk44.hidden = true;
			doc_bauk55.hidden = true;
			doc_bauk66.hidden = true;
			doc_bauk77.hidden = true;
			doc_bauk88.hidden = true;
			doc_bauk99.hidden = true;
			doc_bauk100.hidden = true;
			doc_bauk111.hidden = true;
			doc_bauk122.hidden = true;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog2.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}else  if(elem.layanan.value == "Sewa & Jasa Pelayanan"){
		
		rincian_baukk.hidden = false;
		no_baukk.hidden = false;
		tgl_baukk.hidden = false;
		rincian_bauk22.hidden = false;
		no_bauk22.hidden = false;
		tgl_bauk22.hidden = false;
		rincian_bauk33.hidden = false;
		no_bauk33.hidden = false;
		tgl_bauk33.hidden = false;
		rincian_bauk44.hidden = false;
		no_bauk44.hidden = false;
		tgl_bauk44.hidden = false;
		rincian_bauk55.hidden = false;
		no_bauk55.hidden = false;
		tgl_bauk55.hidden = false;
		rincian_bauk66.hidden = false;
		no_bauk66.hidden = false;
		tgl_bauk66.hidden = false;
		rincian_bauk77.hidden = false;
		no_bauk77.hidden = false;
		tgl_bauk77.hidden = false;
		rincian_bauk88.hidden = false;
		no_bauk88.hidden = false;
		tgl_bauk88.hidden = false;
		rincian_bauk99.hidden = false;
		no_bauk99.hidden = false;
		tgl_bauk99.hidden = false;
		rincian_bauk100.hidden = false;
		no_bauk100.hidden = false;
		tgl_bauk100.hidden = false;
		rincian_bauk111.hidden = false;
		no_bauk111.hidden = false;
		tgl_bauk111.hidden = false;
		rincian_bauk122.hidden = false;
		no_bauk122.hidden = false;
		tgl_bauk122.hidden = false;	
		doc_baukk.hidden = false;
		doc_bauk22.hidden = false;
		doc_bauk33.hidden = false;
		doc_bauk44.hidden = false;
		doc_bauk55.hidden = false;
		doc_bauk66.hidden = false;
		doc_bauk77.hidden = false;
		doc_bauk88.hidden = false;
		doc_bauk99.hidden = false;
		doc_bauk100.hidden = false;
		doc_bauk111.hidden = false;
		doc_bauk122.hidden = false;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog3.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}else  if(elem.layanan.value == ""){
		rincian_bauk22.hidden = true;
    no_bauk22.hidden = true;
	tgl_bauk22.hidden = true;
	rincian_bauk33.hidden = true;
    no_bauk33.hidden = true;
	tgl_bauk33.hidden = true;
	rincian_bauk44.hidden = true;
    no_bauk44.hidden = true;
	tgl_bauk44.hidden = true;
	rincian_bauk55.hidden = true;
    no_bauk55.hidden = true;
	tgl_bauk55.hidden = true;
	rincian_bauk66.hidden = true;
    no_bauk66.hidden = true;
	tgl_bauk66.hidden = true;
	rincian_bauk77.hidden = true;
    no_bauk77.hidden = true;
	tgl_bauk77.hidden = true;
	rincian_bauk88.hidden = true;
    no_bauk88.hidden = true;
	tgl_bauk88.hidden = true;
	rincian_bauk99.hidden = true;
    no_bauk99.hidden = true;
	tgl_bauk99.hidden = true;
	rincian_bauk100.hidden = true;
    no_bauk100.hidden = true;
	tgl_bauk100.hidden = true;
	rincian_bauk111.hidden = true;
    no_bauk111.hidden = true;
	tgl_bauk111.hidden = true;
	rincian_bauk122.hidden = true;
    no_bauk122.hidden = true;
	tgl_bauk122.hidden = true;	
	doc_baukk.hidden = true;
	doc_bauk22.hidden = true;
	doc_bauk33.hidden = true;
	doc_bauk44.hidden = true;
	doc_bauk55.hidden = true;
	doc_bauk66.hidden = true;
	doc_bauk77.hidden = true;
	doc_bauk88.hidden = true;
	doc_bauk99.hidden = true;
	doc_bauk100.hidden = true;
	doc_bauk111.hidden = true;
	doc_bauk122.hidden = true;
	var layanan = $(this).val();
		$.ajax({
			type: 'GET',
			url: 'modul/teknik/addprog4.php',
			data: 'layanan=' + layanan, // Untuk data di MySQL dengan menggunakan kata kunci tsb
			dataType: 'html',
			beforeSend: function() {
				$('#animasi').html('<img src="images/loader3.gif"  width=15>');	
			},
			success: function(response) {
				$('#progress_aktivasi').html(response);
				animasi.hidden = true;
			}
		});		
	}
    });
	
});

</script>
<?php
}
?>


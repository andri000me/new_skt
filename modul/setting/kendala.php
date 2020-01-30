<?php
session_start();
?>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<script src="dist/sweetalert.min.js"></script>
<script type="text/javascript" src="js/pemisah_angka.js"></script>
<script src="js/jquery-1.8.3.min.js"></script>
 <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>  
<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}
</script>
 
<script type="text/javascript">
$(document).ready(function(){
    $(".tip-top").tooltip({
        placement : 'top'
    });
    $(".tip-right").tooltip({
        placement : 'right'
    });
    $(".tip-bottom").tooltip({
        placement : 'bottom'
    });
    $(".tip-left").tooltip({
        placement : 'left'
    });
});
</script>
<script type="text/javascript">
function validasi(form){
  if (form.nama_kendala.value == ""){
   sweetAlert("Oops...", "Nama Kendala harus di isi!", "error");
   form.nama_kendala.focus();
    return (false);
  }	 
   
 }
</script>



<?php


//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
if($cek==1 OR $_SESSION[leveluser]=='1'   ){

$base_url = $_SERVER['HTTP_HOST'];
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
$aksi="modul/setting/kendala_aksi.php";
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
   ?>
   
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>KENDALA</h1><small><span style="color:#727a71">Modul ini untuk update,create & delete pada field <b>Kendala</b> di module <b>Admin Teknik & Umum</b> </span></small>
      <ol class="breadcrumb">
        <li><a href="home.html"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?php echo"$hari_ini,"; ?>
							<?php echo tgl_indo(date('Y m d'));  ?>
							<?php echo "|";  ?>
							<span id="clock"><?php print date('H:i:s'); ?></span></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <!-- /.box -->

          <div class="box box-primary">
            <div class="box-header">
			
              <button type="button" class="btn btn-primary pull-left" onclick="location.href='<?php echo "tambahkendala.html";?>';"  style="margin-left: 5px;">
            <i class="fa fa-plus-square"></i> Tambah Data
          </button>
			
				 
            </div>
            <!-- /.box-header -->
			 <div class="box-body">
             <div class="table-responsive">
              <table id="example1" class="table  table-striped ">
            
			  <thead>
                <tr>
				  <th>No</th>
                  <th>Nama Kendala</th>
                  <th>Aktif</th>
                  <th></th>
				 
                </tr>
                </thead>
                <tbody>
				<?php 
				$tampil=mysql_query("SELECT * FROM tbl_kendala  ORDER BY id_kendala DESC");
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				$no1++;	
				 
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
				  <td><b><span data-toggle='tooltip' class='tip-top' data-original-title='$r[nama_kendala]'>$r[nama_kendala]</span></b></td>   
				  <td><span data-toggle='tooltip' class='tip-top' data-original-title='$r[aktif]'>$r[aktif]</span></td> 
				  
				  <td width='70px'><span class='label bg-gray disabled color-palette'>
				  <i class='fa fa-edit tip-top' data-original-title='Edit Data $r[nama_kendala]' onclick=\"location.href='editkendala-$r[id_kendala].html ';\"></i>
                  &nbsp;&nbsp;&nbsp;  <a class='fa fa-trash-o tip-top' data-original-title='Delete Data $r[id_kendala]'  href=javascript:confirmdelete('$aksi?module=kendala&act=hapus&id=$r[id_kendala]') ></a>
				 
                  ";
				  
				  echo"</span></td>
				  
                </tr>";
              
				}
			   ?>
               </tbody>
			  </table>
			  </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
	
	
 
<?php
    break;

  case "tambahdata":
  ?>
   <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Input Kendala</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		<form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambahkendala.html" onSubmit="return validasi(this)">
        <!-- /.box-header -->
        <div class="box-body" id="myForm">
		
          <div class="row">
            <div class="col-md-6">
		
			<div class="form-group" id="no_so22">
                  <label>Nama Kendala</label>
                  <input type="text" name="nama_kendala" class="form-control" placeholder="Input ..." id="nama_kendala">
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
                <a  class="btn btn-default" href="#" onclick="javascript:history.go(-1)">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
		</form>
      </div>
	<?php  		  
     break;
	 
 //HARUS DIRUBAH (setting email)
  case "editdata":
  
   $edit = mysql_query("SELECT * FROM tbl_kendala WHERE id_kendala='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Kendala</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>
		<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-editkendala.html' onSubmit='return validasi(this)'>
        <!-- /.box-header -->
		 <input type=hidden name=id value=$r[id_kendala]>
        <div class='box-body'>
		
          <div class='row'>
            <div class='col-md-6'>
			
			";?>
			<div class="form-group" id="no_in_user">
                  <label>Nama Kendala</label>
                  <input type="text" name="nama_kendala"  value="<?php echo $r[nama_kendala]; ?>" class="form-control" placeholder="Input ..."  id="nama_kendala">
                </div>
			 <div class="form-group">
			  <label>
                Aktif
                </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;
				<?php if($r[aktif]=='Y'){ ?>
				<label>
                  <input type="radio" name="aktif" class="flat-red" value="Y" checked>&nbsp;&nbsp;Y
                </label>&nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="aktif" class="flat-red" value="N">&nbsp;&nbsp;N
                </label>	
					
			<?php	}else{ ?>
                <label>
                  <input type="radio" name="aktif" class="flat-red" value="Y" >&nbsp;&nbsp;Y
                </label>&nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="aktif" class="flat-red" value="N" checked>&nbsp;&nbsp;N
                </label>
			<?php } ?>  
              </div>  	
				<?php
			echo"
              <!-- /.form-group -->
            </div>
		  <!-- /.col -->
            <div class='col-md-6'>
		    <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class='box-footer'>
                <a  class='btn btn-default' href='#'  onclick='javascript:history.go(-1)'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Save</button>
              </div>
		</form>
      </div>";
   
    break;  
   }
   }
  ?>


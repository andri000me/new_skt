<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<style>
  select{
    font-family: fontAwesome;
    font-weight: 900;

  }
</style>
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<script src="dist/sweetalert.min.js"></script>
<script type="text/javascript" src="js/pemisah_angka.js"></script>
<script src="js/jquery-1.8.3.min.js"></script>
<script>
function confirmdelete(delUrl) {
   if (confirm("Anda yakin ingin menghapus?")) {
      document.location = delUrl;
   }
}
</script>
<script type="text/javascript">
function validasi(form){
  if (form.id_main.value == ""){
   sweetAlert("Oops...", "Group Menu harus di isi!", "error");
   form.id_main.focus();
    return (false);
  }else if(form.nama_sub.value == ""){
   sweetAlert("Oops...", "Nama Menu harus di isi!", "error");
   form.nama_sub.focus();
    return (false);
  }else if(form.link_sub.value == ""){
   sweetAlert("Oops...", "Nama Link harus di isi!", "error");
   form.link_sub.focus();
    return (false);
  }/*else if(form.module_name.value == ""){
   sweetAlert("Oops...", "Nama Module harus di isi!", "error");
   form.module_name.focus();
    return (false);
  }*/
}
</script>





<?php
session_start();
//cek hak akses user
$cek=user_akses($_GET[module],$_SESSION[sessid]);
//var_dump($cek);exit;
//if($cek==1 OR $_SESSION[leveluser]=='1' ){
if(!empty($_SESSION['leveluser'])){  

$base_url = $_SERVER['HTTP_HOST'];
  $iden=mysql_fetch_array(mysql_query("SELECT * FROM identitas"));

$aksi="modul/module/aksi_module.php";
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
   ?>
   
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Module 
        
      </h1>
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
			 <?php
			 /*if ($_SESSION[leveluser]=='1'){*/
			 ?>
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambah-module.html ";?>';" value="Tambah Module" class="btn bg-purple btn-flat margin"/></h3>
			 <?php
			/* }else{
				echo""; 
			 }*/
			?>	
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
				  <th>No</th>
          <th>Nama Modul</th>
          <th>Direktori Modul</th>
				  <th>Keterangan</th>
          <th>Aktif</th>
          <th></th>
				 
                </tr>
                </thead>
                <tbody>
				<?php 
				$p      = new Paging;
				$batas  = 40;
				$posisi = $p->cariPosisi($batas);
				
				$tampil=mysql_query("SELECT* FROM module ORDER BY nama_module ASC ");
				
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
         $submenu=$r[id_submain]; 
				 $no1++;	
				
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
          <td>$r[nama_module]</td> 
				  <td>$r[dir_module]</td>
          <td>$r[ket_module]</td> 
          ";
          if($r[aktif] !='N'){
					echo" <td><span class='label label-success'>$r[aktif]</span></td>";  
				  }else{
					echo" <td><span class='label label-danger'>$r[aktif]</span></td>";    
				  }
          echo"
               <td width='70px' onmouseover=\"this.style.cursor='pointer'\"> $show &nbsp;&nbsp;&nbsp; <i class='fa fa-edit' title='edit $r[nama_module]' onclick=\"location.href='edit-module-$r[id_module].html';\"></i> &nbsp;&nbsp;&nbsp;";
				 /* if($_SESSION[leveluser]=='1'){*/
				  echo"<a class='fa fa-trash-o' title='delete $r[id_module]'  href=javascript:confirmdelete('$aksi?module=module&act=hapus&id_module=$r[id_module]') ></a>";
				  /*}else{
					  echo"";
				  }*/
				  echo"</td>
				  
                </tr>";
              
				}
			   ?>
                </tbody>
              </table>
            </div> </div>
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
 case "tambah":
  ?>
   <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Input Module</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		<form id="myForm" name="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-module.html" onSubmit="return validasi(this)">
        <!-- /.box-header -->
        <div class="box-body" id="myForm">
		
          <div class="row">
            <div class="col-md-6">
     
      <div class="form-group">
                  <label>Nama Module</label>
                  <input type="text" name="nama_module" id="nama_module" class="form-control" placeholder="Nama Module">
                </div>
      <div class="form-group">
                  <label>Direktori Module</label>
                  <input type="text" name="dir_module" id="dir_module" class="form-control" placeholder="Direktori Module">
                </div>
      <div class="form-group">
                  <label>Keterangan Module</label>
                  <input type="text" name="ket_module" id="ket_module" class="form-control" placeholder="Keterangan Module">
                </div>           
	                </br>
                   <!-- /.form-group -->
            </div>
		         <!-- /.RIGHT SIDE -->
            <div class="col-md-6">
			      <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class="box-footer">
                <a  class="btn btn-default" href="module.html">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
		</form>
      </div>
	<?php  		  
     break;
 
  case "edit":
  
    $edit = mysql_query("SELECT * FROM module WHERE id_module='$_GET[id_module]'");
    $r    = mysql_fetch_array($edit);
   
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Modul</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>";
		/*if($_SESSION[leveluser]=='1'){	*/		
			
		echo"<form id='myForm' name='myForm' method='POST'  enctype='multipart/form-data' action='aksi-edit-module.html' >
        <!-- /.box-header -->
		
        <div class='box-body'>
		
          <div class='row'>
            <div class='col-md-6'>
		  <div class='form-group'>
                  <label>Nama Module</label>
                   <input type='hidden' name='id_module'  value='$r[id_module]' >
                  <input type='text' name='nama_module' id='nama_module' value='$r[nama_module]' class='form-control' placeholder='Nama Module'>
                </div> 
			<div class='form-group'>
                  <label>Direktori Module<span style='color:red;'>*</span></label>
                  <input type='text' name='dir_module' id='dir_module' value='$r[dir_module]' class='form-control' placeholder='Direktori Module' >
                </div>
			<div class='form-group'>
                  <label>Keterangan Module</label>
                  <input type='text' name='ket_module' id='ket_module' value='$r[ket_module]' class='form-control' placeholder='Keterangan Modul'>
                </div>
              	
			";
		
			
		echo"	 <!-- radio -->
                <div class='form-group'>
				<label>Aktif</label>";
				 if ($r[aktif]=='N'){
				echo "
                  <div class='radio'>
                    <label>
                      <input type='radio' name='aktif'  value='N' checked>
                      N
                    </label>
                  </div>
                  <div class='radio'>
                    <label>
                      <input type='radio' name='aktif'  value='Y'>
                      Y
                    </label>
                  </div>";
                 }else{
					echo "
                  <div class='radio'>
                    <label>
                      <input type='radio' name='aktif'  value='N' >
                      N
                    </label>
                  </div>
                  <div class='radio'>
                    <label>
                      <input type='radio' name='aktif'  value='Y' checked>
                      Y
                    </label>
                  </div>"; 
				 } 
                echo"</div>
				 </br>
				<!-- /.form-group -->
            </div>
			
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class='box-footer'>
                <a  class='btn btn-default' href='module.html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
              </div>
		</form>";
	//	}
    echo"  </div>";
   
    break;  
	//edit password
  
   }
   }
  ?>


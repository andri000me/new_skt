
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
  if (form.ftTipe.value == ""){
   sweetAlert("Oops...", "Tipe harus di isi!", "error");
   form.ftTipe.focus();
    return (false);
  }else if (form.ftKeterangan.value == ""){
   sweetAlert("Oops...", "Keterangan harus di isi!", "error");
   form.ftKeterangan.focus();
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
       FORM TIPE NASABAH 
        
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
			// if ($_SESSION[leveluser]=='1'){
			 ?>
              <h3 class="box-title"><input type="button" onclick="location.href='<?php echo "tambah-tipe.html ";?>';" value="Tambah" class="btn bg-purple btn-flat margin"/></h3>
			 <?php
			 // }else{
				// echo""; 
			 // }
			?>	
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>No</th>
                  <th>Tipe</th>
                  <th>Keterangan</th>
                  <th>Status</th>
				  <th>Cabang</th>
				 
				   <th></th>
				 
                </tr>
                </thead>
                <tbody>
				<?php 
				$p      = new Paging;
				$batas  = 40;
				$posisi = $p->cariPosisi($batas);
				if($_SESSION[leveluser]=='1'){
				$tampil=mysql_query("SELECT * FROM tltipenasabah  ORDER BY ftTipe ");
				}else{
				$tampil=mysql_query("SELECT * FROM tltipenasabah  ORDER BY ftTipe ");
				}
				$no = $posisi+1;
				$no1 = 0;	
				while($r=mysql_fetch_array($tampil)){
				 $no1++;	
				
				echo"
                <tr>
				  <td><span class='label bg-black disabled color-palette'>$no1</span></td>
                  <td>$r[ftTipe]</td>
                  <td>$r[ftKeterangan]</td>";
				if($r[fnStatus]==0){
					echo"<td>Tidak Aktif</td>";
				}else if($r[fnStatus]==1){
					echo"<td>Aktif</td>";
				}		
				echo"  <td>$r[ftCabang]</td> 
				  
								 				  
                  <td width='70px' onmouseover=\"this.style.cursor='pointer'\"><span class='label bg-gray disabled color-palette'><i class='fa fa-edit' title='edit $r[ftTipe]' onclick=\"location.href='edit-tipe-$r[fnId].html';\"></i> &nbsp;&nbsp;&nbsp;  
				  ";
				//  if($_SESSION[leveluser]=='1'){
				  echo"<a class='fa fa-trash-o' title='delete $r[ftTipe]'  href=javascript:confirmdelete('aksi-delete-tipe-$r[fnId].html') ></a>";
				  // }else{
					 //  echo"";
				  // }
				  echo"</span></td>
				  
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
          <h3 class="box-title">Input Tipe</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           
          </div>
        </div>
		<form id="myForm" method="POST" enctype="multipart/form-data" action="aksi-tambah-tipe.html" onSubmit="return validasi(this)">
        <!-- /.box-header -->
        <div class="box-body" id="myForm">
		
          <div class="row">
            <div class="col-md-6">
			
			<div class="form-group" >
                  <label>Tipe<span style="color:red;">*</span></label>
                  <input type="text" name="ftTipe" class="form-control" placeholder="Input ..." id="ftTipe">
				  
                </div>
			
			 <div class="form-group">
                  <label>Keterangan<span style="color:red;">*</span></label>
                  <input type="text" name="ftKeterangan" id="ftKeterangan" class="form-control" placeholder="Input ...">
                </div>
			 
			<div class="form-group">
                  <label>Status<span style="color:red;">*</span></label>
				  <select class="form-control select2" style="width: 100%;" name="fnStatus" id="fnStatus">
				  <option value="1" selected>Aktif</option>
				  <option value="0">Tidak Aktif</option>
				  </select>
                  
                </div> 
			<div class="form-group">
                  <label>Cabang<span style="color:red;">*</span></label>
                  
                  
				  <?php		
				  $tampil=mysql_query("SELECT ftBranch_Code FROM tscompany_info WHERE aktif ='Y'");
				  $r=mysql_fetch_array($tampil);
				   echo "<input type='text' name='ftCabang' id='ftCabang' value='$r[ftBranch_Code]' class='form-control' placeholder='Input ...'' readonly>"; 
				   ?>
				 
                </div> 	</br>
			<div class="form-group " >
            
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
                <a  class="btn btn-default" href="tipe.html">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Save</button>
              </div>
		</form>
      </div>
	<?php  		  
     break;
 
 //HARUS DIRUBAH (setting email)
  case "edit":


   $edit = mysql_query("SELECT * FROM tltipenasabah WHERE fnId='$_GET[fnId]'");
    $r    = mysql_fetch_array($edit);
  echo"
  <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Edit Tipe</h3>

          <div class='box-tools pull-right'>
            <button type='button' class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
           
          </div>
        </div>";
			
			
		echo"<form id='form' method='POST'  enctype='multipart/form-data' action='aksi-edit-tipe.html' onSubmit='return validasi(this)'>
        <!-- /.box-header -->
		
        <div class='box-body'>
		 <input type=hidden name=id value=$r[fnId]>
          <div class='row'>
            <div class='col-md-6'>
			
			
			<div class='form-group' >
                  <label>Tipe<span style='color:red;'>*</span></label>
                  <input type='text' name='ftTipe' id='ftTipe' value='$r[ftTipe]' class='form-control' placeholder='Input ...' >
                </div>
				
			
			 <div class='form-group'>
                  <label>Keterangan<span style='color:red;'>*</span></label>
                  <input type='text' name='ftKeterangan' id='ftKeterangan' value='$r[ftKeterangan]' class='form-control' placeholder='Enter ...'>
                </div>
			
			<div class='form-group'>
                  <label>Status<span style='color:red;'>*</span></label>
                 <select class='form-control select2'  style='width: 100%;' name='fnStatus_edit' id='fnStatus_edit'>";
				 
				 if ($r[fnStatus]==''){
				 echo"<option  value='' selected>-- Pilih --</option>
					  <option  value='1'>Aktif</option>
					  <option  value='0'>Tidak Aktif</option>";}
				 
				 else if ($r[fnStatus]=='1'){
					echo"<option value='1' selected>Aktif</option>
						 <option value='0' >Tidak Aktif</option>";}
				 else if ($r[fnStatus]=='0'){
					echo"<option value='0' selected>Tidak Aktif</option>
						 <option value='1' >Aktif</option>";}	 
				
				  echo"</select>
                </div>
			
			     <div class='form-group'>
                  <label>Cabang<span style='color:red;'>*</span></label>";
                 $tampil=mysql_query("SELECT ftBranch_Code FROM tscompany_info WHERE aktif ='Y'");
          $r=mysql_fetch_array($tampil);
           echo "<input type='text' name='ftCabang' id='ftCabang' value='$r[ftBranch_Code]' class='form-control' placeholder='Input ...'' readonly> 
                </div>  
			
			
           
             
              <!-- /.form-group -->
            </div>
			
			
            <!-- /.col -->
            <div class='col-md-6'>
		
			
			  
			"; 
				
                echo"</div>
				
				<!-- /.form-group -->
            </div>
			
            <!-- /.col -->
          </div>
		  
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <!-- /.box-body -->
              <div class='box-footer'>
                <a  class='btn btn-default' href='tipe.html'>Cancel</a>
                <button type='submit' class='btn btn-info pull-right'>Update</button>
              </div>
		</form>";
		
    echo"  </div>";
   
    break;  
	//edit password
  
   }
   }
  ?>

